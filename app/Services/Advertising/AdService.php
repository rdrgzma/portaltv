<?php

namespace App\Services\Advertising;

use App\Models\Anuncio;
use App\Models\LogsExibicao;
use Illuminate\Support\Collection;

class AdService
{
    /**
     * Retorna anúncios ativos por tipo/local
     */
    public function getActiveAds(string $tipo): Collection
    {
        return Anuncio::where('tipo', $tipo)
            ->where('ativo', true)
            ->whereDate('inicio', '<=', now())
            ->whereDate('fim', '>=', now())
            ->orderByDesc('prioridade')
            ->get();
    }

    /**
     * Retorna um anúncio aleatório (respeitando prioridade)
     */
    public function getRandomAd(string $tipo): ?Anuncio
    {
        $ads = $this->getActiveAds($tipo);

        if ($ads->isEmpty()) {
            return null;
        }

        return $ads->shuffle()->first();
    }

    /**
     * Registra exibição do anúncio
     */
    public function logAdView(Anuncio $anuncio): void
    {
        LogsExibicao::create([
            'tipo'          => 'anuncio',
            'referencia_id' => $anuncio->id,
            'inicio'        => now(),
        ]);
    }

    /**
     * Finaliza log de exibição do anúncio
     */
    public function finishAdView(Anuncio $anuncio): void
    {
        LogsExibicao::where('tipo', 'anuncio')
            ->where('referencia_id', $anuncio->id)
            ->whereNull('fim')
            ->latest()
            ->first()?->update([
                'fim' => now(),
            ]);
    }

    /**
     * Retorna anúncio por local específico da tela
     * Ex: home_left, home_right, home_bottom
     */
    public function getAdByPlacement(string $placement): ?Anuncio
    {
        return Anuncio::where('tipo', $placement)
            ->where('ativo', true)
            ->whereDate('inicio', '<=', now())
            ->whereDate('fim', '>=', now())
            ->orderByDesc('prioridade')
            ->first();
    }
}
