<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Services\WebTV\WebTVService;
use Illuminate\Http\JsonResponse;

final class PlayerController
{
    public function __construct(
        private readonly WebTVService $webTVService
    ) {}

    /**
     * Retorna a programação atual para o frontend do player
     */
    public function current(): JsonResponse
    {
        $current = $this->webTVService->getCurrentProgramacao();

        if ($current === null) {
            return response()->json([
                'status' => 'offline',
                'message' => 'Nenhuma programação no ar no momento.',
                'data' => null,
            ]);
        }

        $video = $current->video;
        
        // Cálculo do tempo de início (Seek To)
        // Se a programação começou às 14:00 e agora são 14:05, o seek é 300 segundos.
        $now = now();
        $inicio = $current->inicio;
        $seekTo = $now->getTimestamp() - $inicio->getTimestamp();

        return response()->json([
            'status' => 'online',
            'data' => [
                'id' => $video->id,
                'titulo' => $video->titulo,
                'youtube_url' => $video->youtube_url,
                'youtube_video_id' => $video->youtube_video_id,
                'duracao' => $video->duracao,
                'inicio_programacao' => $inicio->toIso8601String(),
                'fim_programacao' => $current->fim?->toIso8601String(),
                'seek_to' => (int) $seekTo,
                'next_update_at' => $current->fim?->toIso8601String(),
            ],
        ]);
    }
}
