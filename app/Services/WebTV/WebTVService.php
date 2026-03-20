<?php

declare(strict_types=1);

namespace App\Services\WebTV;

use App\Models\Programacao;
use App\Models\LogsExibicao;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

final class WebTVService
{
    /**
     * Retorna a programação que deve estar no ar agora
     */
    public function getCurrentProgramacao(): ?Programacao
    {
        $now = now();

        return Programacao::query()
            ->with(['video'])
            ->where('inicio', '<=', $now)
            ->where('fim', '>=', $now)
            ->orderByDesc('inicio')
            ->first();
    }

    /**
     * Marca a programação como transmitindo e registra o log
     */
    public function startProgramacao(Programacao $programacao): void
    {
        DB::transaction(static function () use ($programacao): void {
            // Finaliza qualquer outra transmissão ativa
            Programacao::query()
                ->where('status', 'transmitindo')
                ->where('id', '!=', $programacao->id)
                ->update(['status' => 'finalizado']);

            $programacao->update([
                'status' => 'transmitindo',
            ]);

            LogsExibicao::query()->create([
                'tipo' => 'video',
                'referencia_id' => $programacao->video_id,
                'inicio' => now(),
            ]);
        });
    }

    /**
     * Finaliza uma programação e fecha o log correspondente
     */
    public function finishProgramacao(Programacao $programacao): void
    {
        $programacao->update(['status' => 'finalizado']);

        LogsExibicao::query()
            ->where('tipo', 'video')
            ->where('referencia_id', $programacao->video_id)
            ->whereNull('fim')
            ->latest()
            ->first()
            ?->update([
                'fim' => now(),
            ]);
    }

    /**
     * Obtém a próxima programação agendada
     */
    public function getNextProgramacao(): ?Programacao
    {
        return Programacao::query()
            ->where('status', 'agendado')
            ->where('inicio', '>=', now())
            ->orderByDesc('prioridade')
            ->orderBy('inicio')
            ->first();
    }

    /**
     * Orquestrador de transmissão (para o Scheduler)
     */
    public function handleScheduler(): void
    {
        $current = $this->getCurrentProgramacao();

        if ($current === null) {
            return;
        }

        if ($current->status !== 'transmitindo') {
            $this->startProgramacao($current);
            return;
        }

        if ($current->fim !== null && now()->greaterThanOrEqualTo($current->fim)) {
            $this->finishProgramacao($current);

            $next = $this->getNextProgramacao();
            if ($next !== null) {
                $this->startProgramacao($next);
            }
        }
    }
}