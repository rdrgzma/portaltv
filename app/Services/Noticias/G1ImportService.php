<?php

namespace App\Services\Noticias;

use App\Models\Noticia;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class G1ImportService
{
    public function importar(string $url, string $categoriaSlug)
    {
        try {
            $response = Http::withOptions(['verify' => false])->get($url);
            if (!$response->successful()) {
                Log::error("G1 RSS: Não foi possível acessar a URL: " . $url);
                return;
            }

            $xml = simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA);
            $importadas = 0;

            foreach ($xml->channel->item as $item) {
                $titulo = (string) $item->title;
                $link = (string) $item->link;

                // 1. Verifica se já existe
                if (Noticia::where('titulo', $titulo)->exists()) continue;

                // 2. Busca o HTML para extrair imagem e conteúdo completo
                $htmlResponse = Http::withOptions(['verify' => false])->get($link);
                if (!$htmlResponse->successful()) continue;
                $html = $htmlResponse->body();

                // 3. Extração da Imagem (OpenGraph)
                preg_match('/<meta property="og:image" content="([^"]+)"/', $html, $matches);
                $imagem = $matches[1] ?? null;

                // 4. Extração do Conteúdo (G1 usa classes content-text__container)
                preg_match_all('/<p class="content-text__container[^>]*>(.*?)<\/p>/s', $html, $paragraphs);
                
                $conteudoHtml = "";
                if (!empty($paragraphs[1])) {
                    foreach ($paragraphs[1] as $p) {
                        $texto = trim(strip_tags($p));
                        if (!empty($texto)) {
                            $conteudoHtml .= "<p class='mb-4 text-lg text-gray-700 leading-relaxed'>{$texto}</p>";
                        }
                    }
                }

                // Se não achou conteúdo no formato novo, tenta pegar a descrição do RSS
                if (empty($conteudoHtml)) {
                    $resumoRSS = strip_tags((string)$item->description);
                    $conteudoHtml = "<p class='mb-4'>{$resumoRSS}</p>";
                }

                // 5. Persistência no Banco (Usando seus campos exatos)
                // Verifique se o campo 'categoria' no banco aceita a string que você está enviando
// No seu G1ImportService.php, antes de Noticia::create:

// Garante que se não houver matches, a variável seja null e não "None"
$imagem = $matches[1] ?? null; 

Noticia::create([
    'titulo'       => $titulo,
    'slug'         => Str::slug($titulo) . '-' . rand(100, 999),
    'resumo'       => Str::limit(strip_tags((string)$item->description), 200),
    'conteudo'     => $conteudoHtml,
    'imagem'       => $imagem, // Agora salva null se não houver foto
    'categoria'    => $categoriaSlug,
    'ativo'        => true,
    'publicado_em' => now(),
]);

                $importadas++;
                if ($importadas >= 10) break; // Limite por execução para não travar
            }
            
            Log::info("Importação concluída: {$importadas} notícias da categoria {$categoriaSlug}");

        } catch (\Exception $e) {
            Log::error("Erro Crítico G1: " . $e->getMessage());
        }
    }
}