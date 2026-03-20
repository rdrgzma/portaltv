<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Programacao;

class ProgramacaoSeeder extends Seeder
{
    public function run(): void
    {
        Programacao::create([
            'video_id' => 1,
            'inicio' => now()->subMinutes(5),
            'fim' => now()->addMinutes(30),
            'status' => 'agendado',
            'prioridade' => 10,
        ]);
    }
}

