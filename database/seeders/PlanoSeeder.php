<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plano;

class PlanoSeeder extends Seeder
{
    public function run(): void
    {
        Plano::insert([
            [
                'nome' => 'WebTV Básico',
                'valor' => 99.90,
                'limite_videos' => 5,
                'ativo' => true,
            ],
            [
                'nome' => 'WebTV Premium',
                'valor' => 199.90,
                'limite_videos' => 20,
                'ativo' => true,
            ],
        ]);
    }
}
