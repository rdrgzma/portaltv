<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use willvincent\Feeds\Facades\FeedsFacade as Feeds;

class RegionalNewsService
{
protected array $feeds = [
    // --- Nacionais e Gerais ---
    'br' => 'https://g1.globo.com/rss/g1',
    'vc' => 'https://g1.globo.com/rss/g1/vc-no-g1',

    // --- Estados (Capitais/Geral) ---
    'ac' => 'https://g1.globo.com/rss/g1/ac/acre',
    'al' => 'https://g1.globo.com/rss/g1/al/alagoas',
    'ap' => 'https://g1.globo.com/rss/g1/ap/amapa',
    'am' => 'https://g1.globo.com/rss/g1/am/amazonas',
    'ba' => 'https://g1.globo.com/rss/g1/ba/bahia',
    'ce' => 'https://g1.globo.com/rss/g1/ceara',
    'df' => 'https://g1.globo.com/rss/g1/distrito-federal',
    'es' => 'https://g1.globo.com/rss/g1/espirito-santo',
    'go' => 'https://g1.globo.com/rss/g1/goias',
    'ma' => 'https://g1.globo.com/rss/g1/ma/maranhao',
    'mt' => 'https://g1.globo.com/rss/g1/mt/mato-grosso',
    'ms' => 'https://g1.globo.com/rss/g1/ms/mato-grosso-do-sul',
    'mg' => 'https://g1.globo.com/rss/g1/minas-gerais',
    'pa' => 'https://g1.globo.com/rss/g1/pa/para',
    'pb' => 'https://g1.globo.com/rss/g1/pb/paraiba',
    'pr' => 'https://g1.globo.com/rss/g1/pr/parana',
    'pe' => 'https://g1.globo.com/rss/g1/pernambuco',
    'pi' => 'https://g1.globo.com/rss/g1/pi/piaui',
    'rj' => 'https://g1.globo.com/rss/g1/rio-de-janeiro',
    'rn' => 'https://g1.globo.com/rss/g1/rn/rio-grande-do-norte',
    'rs' => 'https://g1.globo.com/rss/g1/rs/rio-grande-do-sul',
    'ro' => 'https://g1.globo.com/rss/g1/ro/rondonia',
    'rr' => 'https://g1.globo.com/rss/g1/rr/roraima',
    'sc' => 'https://g1.globo.com/rss/g1/sc/santa-catarina',
    'sp' => 'https://g1.globo.com/rss/g1/sao-paulo',
    'se' => 'https://g1.globo.com/rss/g1/se/sergipe',
    'to' => 'https://g1.globo.com/rss/g1/to/tocantins',

    // --- Minas Gerais (Regionais) ---
    'mg_centro_oeste' => 'https://g1.globo.com/rss/g1/mg/centro-oeste',
    'mg_grande_minas' => 'https://g1.globo.com/rss/g1/mg/grande-minas',
    'mg_sul_minas'    => 'https://g1.globo.com/rss/g1/mg/sul-de-minas',
    'mg_triangulo'    => 'https://g1.globo.com/rss/g1/minas-gerais/triangulo-mineiro',
    'mg_vales'        => 'https://g1.globo.com/rss/g1/mg/vales-mg',
    'mg_zona_da_mata' => 'https://g1.globo.com/rss/g1/mg/zona-da-mata',

    // --- São Paulo (Regionais) ---
    'sp_bauru'        => 'https://g1.globo.com/rss/g1/sp/bauru-marilia',
    'sp_campinas'     => 'https://g1.globo.com/rss/g1/sp/campinas-regiao',
    'sp_itapetininga' => 'https://g1.globo.com/rss/g1/sao-paulo/itapetininga-regiao',
    'sp_mogi'         => 'https://g1.globo.com/rss/g1/sp/mogi-das-cruzes-suzano',
    'sp_piracicaba'   => 'https://g1.globo.com/rss/g1/sp/piracicaba-regiao',
    'sp_prudente'     => 'https://g1.globo.com/rss/g1/sp/presidente-prudente-regiao',
    'sp_ribeirao'     => 'https://g1.globo.com/rss/g1/sp/ribeirao-preto-franca',
    'sp_rio_preto'    => 'https://g1.globo.com/rss/g1/sao-paulo/sao-jose-do-rio-preto-aracatuba',
    'sp_santos'       => 'https://g1.globo.com/rss/g1/sp/santos-regiao',
    'sp_sao_carlos'   => 'https://g1.globo.com/rss/g1/sp/sao-carlos-regiao',
    'sp_sorocaba'     => 'https://g1.globo.com/rss/g1/sao-paulo/sorocaba-jundiai',
    'sp_vale_paraiba' => 'https://g1.globo.com/rss/g1/sp/vale-do-paraiba-regiao',

    // --- Rio de Janeiro (Regionais) ---
    'rj_serrana'      => 'https://g1.globo.com/rss/g1/rj/regiao-serrana',
    'rj_lagos'        => 'https://g1.globo.com/rss/g1/rj/regiao-dos-lagos',
    'rj_norte'        => 'https://g1.globo.com/rss/g1/rj/norte-fluminense',
    'rj_sul_costa'    => 'https://g1.globo.com/rss/g1/rj/sul-do-rio-costa-verde',

    // --- Outros Regionais ---
    'pr_campos_gerais' => 'https://g1.globo.com/rss/g1/pr/campos-gerais-sul',
    'pr_oeste'         => 'https://g1.globo.com/rss/g1/pr/oeste-sudoeste',
    'pr_norte'         => 'https://g1.globo.com/rss/g1/pr/norte-noroeste',
    'pe_caruaru'       => 'https://g1.globo.com/rss/g1/pe/caruaru-regiao',
    'pe_petrolina'     => 'https://g1.globo.com/rss/g1/pe/petrolina-regiao',
];
public function getStates(): array
{
    $states = [
        'ac'               => 'Acre',
        'al'               => 'Alagoas',
        'ap'               => 'Amapá',
        'am'               => 'Amazonas',
        'ba'               => 'Bahia',
        'br'               => 'Brasil',
        'ce'               => 'Ceará',
        'df'               => 'Distrito Federal',
        'es'               => 'Espírito Santo',
        'go'               => 'Goiás',
        'ma'               => 'Maranhão',
        'mt'               => 'Mato Grosso',
        'ms'               => 'Mato Grosso do Sul',
        'mg'               => 'Minas Gerais',
        'mg_centro_oeste'  => 'MG - Centro-Oeste',
        'mg_grande_minas'  => 'MG - Grande Minas',
        'mg_sul_minas'     => 'MG - Sul de Minas',
        'mg_triangulo'     => 'MG - Triângulo Mineiro',
        'mg_vales'         => 'MG - Vales de Minas',
        'mg_zona_da_mata'  => 'MG - Zona da Mata',
        'pa'               => 'Pará',
        'pb'               => 'Paraíba',
        'pr'               => 'Paraná',
        'pr_campos_gerais' => 'PR - Campos Gerais e Sul',
        'pr_norte'         => 'PR - Norte e Noroeste',
        'pr_oeste'         => 'PR - Oeste e Sudoeste',
        'pe'               => 'Pernambuco',
        'pe_caruaru'       => 'PE - Caruaru e Região',
        'pe_petrolina'     => 'PE - Petrolina e Região',
        'pi'               => 'Piauí',
        'rj'               => 'Rio de Janeiro',
        'rj_lagos'         => 'RJ - Região dos Lagos',
        'rj_serrana'       => 'RJ - Região Serrana',
        'rj_norte'         => 'RJ - Norte Fluminense',
        'rj_sul_costa'     => 'RJ - Sul e Costa Verde',
        'rn'               => 'Rio Grande do Norte',
        'rs'               => 'Rio Grande do Sul',
        'ro'               => 'Rondônia',
        'rr'               => 'Roraima',
        'sc'               => 'Santa Catarina',
        'sp'               => 'São Paulo',
        'sp_bauru'         => 'SP - Bauru e Marília',
        'sp_campinas'      => 'SP - Campinas e Região',
        'sp_itapetininga'  => 'SP - Itapetininga e Região',
        'sp_mogi'          => 'SP - Mogi das Cruzes e Suzano',
        'sp_piracicaba'    => 'SP - Piracicaba e Região',
        'sp_prudente'      => 'SP - Prudente e Região',
        'sp_ribeirao'      => 'SP - Ribeirão Preto e Franca',
        'sp_rio_preto'     => 'SP - Rio Preto e Araçatuba',
        'sp_santos'        => 'SP - Santos e Região',
        'sp_sao_carlos'    => 'SP - São Carlos e Araraquara',
        'sp_sorocaba'      => 'SP - Sorocaba e Jundiaí',
        'sp_vale_paraiba'  => 'SP - Vale do Paraíba e Região',
        'se'               => 'Sergipe',
        'to'               => 'Tocantins',
        'vc'               => 'VC no G1',
    ];

    // Garante que a ordem alfabética seja aplicada aos valores (nomes exibidos)
    asort($states);

    return $states;
}

    public function getNews(string $state, int $perPage = 10, int $page = 1): LengthAwarePaginator
    {
        $url   = $this->feeds[$state] ?? $this->feeds['rs'];
        $feed  = Feeds::make($url);
        $items = collect();
        $limitDate = Carbon::now()->subDays(2); // Limite de 2 dias atrás

        foreach ($feed->get_items() as $item) {
            $pubDate = Carbon::parse($item->get_date());

            // Se a notícia for mais antiga que 2 dias, pula
            if ($pubDate->isBefore($limitDate)) {
                continue;
            }

            $description = $item->get_description() ?? '';
            $fullContent = $item->get_content() ?? $description;
            $image       = $this->extractImage($description) ?? $this->extractImage($fullContent);

            // Source / Author
            $source = null;
            if ($itemSource = $item->get_source()) {
                $source = $itemSource->get_title();
            }
            if (! $source) {
                $source = $feed->get_title();
            }

            $items->push([
                'id'          => md5($item->get_permalink()),
                'title'       => $item->get_title(),
                'link'        => $item->get_permalink(),
                'description' => strip_tags($description),
                'full_content'=> strip_tags($fullContent),
                'date'        => Carbon::parse($item->get_date())->format('d/m/Y H:i'),
                'date_raw'    => $item->get_date(),
                'image'       => $image,
                'source'      => $source ?? 'G1',
                'author'      => $item->get_author()?->get_name(),
                'state'       => $state,
            ]);
        }

        return $this->paginateCollection($items, $perPage, $page);
    }

    /**
     * Busca um item específico pelo hash do link, dentro do feed do estado.
     */
    public function getNewsItem(string $state, string $id): ?array
    {
        $url  = $this->feeds[$state] ?? $this->feeds['rs'];
        $feed = Feeds::make($url);

        foreach ($feed->get_items() as $item) {
            if (md5($item->get_permalink()) === $id) {
                $description = $item->get_description() ?? '';
                $fullContent = $item->get_content() ?? $description;
                $image       = $this->extractImage($description) ?? $this->extractImage($fullContent);

                $source = null;
                if ($itemSource = $item->get_source()) {
                    $source = $itemSource->get_title();
                }
                if (! $source) {
                    $source = $feed->get_title();
                }

                return [
                    'id'           => md5($item->get_permalink()),
                    'title'        => $item->get_title(),
                    'link'         => $item->get_permalink(),
                    'description'  => strip_tags($description),
                    'full_content' => strip_tags($fullContent),
                    'date'         => Carbon::parse($item->get_date())->format('d/m/Y \à\s H:i'),
                    'image'        => $image,
                    'source'       => $source ?? 'G1',
                    'author'       => $item->get_author()?->get_name(),
                    'state'        => $state,
                    'state_name'   => $this->getStates()[$state] ?? strtoupper($state),
                ];
            }
        }

        return null;
    }

    /**
     * Apaga os arquivos de cache do SimplePie para o feed do estado.
     */
    public function clearCache(string $state): void
    {
        $cacheDir = config('feeds.cache.location', storage_path('framework/cache'));
        $url      = $this->feeds[$state] ?? $this->feeds['rs'];

        // SimplePie nomeia os arquivos de cache com MD5 da URL
        $prefix = md5($url);

        if (! File::isDirectory($cacheDir)) {
            return;
        }

        foreach (File::files($cacheDir) as $file) {
            if (str_starts_with($file->getFilename(), $prefix)) {
                File::delete($file->getPathname());
            }
        }
    }

    protected function extractImage(string $content): ?string
    {
        preg_match('/<img[^>]+src="([^">]+)"/', $content, $matches);
        return $matches[1] ?? null;
    }

    protected function paginateCollection(Collection $items, int $perPage, int $page): LengthAwarePaginator
    {
        return new LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }
}
