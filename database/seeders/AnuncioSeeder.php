<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anuncio;

class AnuncioSeeder extends Seeder
{
    public function run(): void
    {
        Anuncio::create([
            'anunciante_id' => 1,
            'tipo' => 'banner_horizontal',
            'arquivo' => 'https://placehold.co/1200x280?text=Banner+Horizontal',
            'link' => 'https://google.com',
            'inicio' => now()->subDay(),
            'fim' => now()->addDays(30),
            'prioridade' => 10,
            'ativo' => true,
        ]);
    }
}
