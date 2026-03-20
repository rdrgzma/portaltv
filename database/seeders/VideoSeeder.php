<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;
use App\Models\User;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        Video::create([
            'responsible_id' => $user->id,
            'responsible_type' => $user::class,
            'titulo' => 'Vídeo Institucional',
            'youtube_url' => 'https://www.youtube.com/watch?v=DyDfgMOUjCI',
            'youtube_video_id' => 'DyDfgMOUjCI',
            'aprovado' => true,
        ]);
    }
}

