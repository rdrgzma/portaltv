<?php

namespace App\Services\WebTV;

use App\Models\Programacao;
use App\Models\LogsExibicao;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class WebTVService
{
    /**
     * Retorna a programação que deve estar no ar agora
     */
    public function getCurrentProgramacao(): ?Programacao
    {
        $now = Carbon::now();

        return Programacao::with('video')
                ->where('inicio', '<=', $now)
                ->where('fim', '>=', $now) // Pega o que está no intervalo de tempo
                ->orderBy('inicio', 'desc') // Em caso de conflito, pega o que começou por último
                ->first();
    }

    /**
     * Marca a programação como transmitindo
     */
    public function startProgramacao(Programacao $programacao): void
    {
        DB::transaction(function () use ($programacao) {
            // Finaliza qualquer outra transmissão
            Programacao::where('status', 'transmitindo')
                ->where('id', '!=', $programacao->id)
                ->update(['status' => 'finalizado']);

            $programacao->update([
                'status' => 'transmitindo',
            ]);

            LogsExibicao::create([
                'tipo'          => 'video',
                'referencia_id' => $programacao->video_id,
                'inicio'        => now(),
            ]);
        });
    }

    /**
     * Finaliza uma programação
     */
    public function finishProgramacao(Programacao $programacao): void
    {
        $programacao->update(['status' => 'finalizado']);

        LogsExibicao::where('tipo', 'video')
            ->where('referencia_id', $programacao->video_id)
            ->whereNull('fim')
            ->latest()
            ->first()?->update([
                'fim' => now(),
            ]);
    }

    /**
     * Obtém o próximo vídeo da grade
     */
    public function getNextProgramacao(): ?Programacao
    {
        return Programacao::where('status', 'agendado')
            ->where('inicio', '>=', now())
            ->orderByDesc('prioridade')
            ->orderBy('inicio')
            ->first();
    }

    /**
     * Verifica e executa a troca automática (usar no Scheduler)
     */
    public function handleScheduler(): void
    {
        $current = $this->getCurrentProgramacao();

        if (!$current) {
            return;
        }

        if ($current->status !== 'transmitindo') {
            $this->startProgramacao($current);
            return;
        }

        if ($current->fim && now()->greaterThanOrEqualTo($current->fim)) {
            $this->finishProgramacao($current);

            if ($next = $this->getNextProgramacao()) {
                $this->startProgramacao($next);
            }
        }
    }
}