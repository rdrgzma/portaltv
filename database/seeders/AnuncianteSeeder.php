<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anunciante;

class AnuncianteSeeder extends Seeder
{
    public function run(): void
    {
        Anunciante::create([
            'nome' => 'Empresa Exemplo',
            'email' => 'contato@empresa.com',
            'telefone' => '(51) 99999-9999',
        ]);
    }
}

