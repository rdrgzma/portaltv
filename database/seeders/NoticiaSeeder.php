<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Noticia;
use Illuminate\Support\Str;

class NoticiaSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 12; $i++) {
            Noticia::create([
                'titulo' => "Notícia Exemplo {$i}",
                'slug' => Str::slug("Notícia Exemplo {$i}"),
                'resumo' => 'Resumo curto da notícia para listagem.',
                'conteudo' => '<p>Conteúdo completo da notícia.</p>',
                'imagem' => 'https://placehold.co/800x450',
                'ativo' => true,
                'publicado_em' => now()->subDays($i),
            ]);
        }
    }
}
