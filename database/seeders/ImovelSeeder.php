<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Imovel;
use App\Models\ImovelImagem;
use Illuminate\Support\Str;

class ImovelSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 8; $i++) {
            $imovel = Imovel::create([
                'titulo' => "Imóvel {$i}",
                'slug' => Str::slug("Imóvel {$i}"),
                'descricao' => 'Descrição completa do imóvel.',
                'tipo' => 'Casa',
                'valor' => rand(250000, 850000),
                'quartos' => rand(2, 4),
                'banheiros' => rand(1, 3),
                'garagem' => rand(1, 2),
                'area' => rand(80, 200),
                'localizacao' => 'Centro',
                'destaque' => $i <= 4,
                'ativo' => true,
            ]);

            ImovelImagem::create([
                'imovel_id' => $imovel->id,
                'imagem' => 'https://placehold.co/800x500',
                'ordem' => 1,
            ]);
        }
    }
}

