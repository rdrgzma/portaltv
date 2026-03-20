<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\WebTV\WebTVService;
use Carbon\Carbon;

class WebtvPlayer extends Component
{
    public $videoUrl = null;
    public $titulo = '';
    public $currentVideoId = null;

    public function mount(WebTVService $service)
    {
        $this->updatePlayerState($service);
    }

    // Esta função é chamada automaticamente pelo wire:poll
    public function checkProgramacao(WebTVService $service)
    {
        $programacao = $service->getCurrentProgramacao();

        // Se não houver programação, limpa o player
        if (!$programacao) {
            if ($this->currentVideoId !== null) {
                $this->resetPlayer();
            }
            return;
        }

        // Se o vídeo for o mesmo que já está tocando, NÃO FAZ NADA.
        // Isso impede que o iframe recarregue e corte o vídeo.
        if ($programacao->video->youtube_video_id === $this->currentVideoId) {
            return;
        }

        // Se o vídeo mudou, atualiza o estado
        $this->updatePlayerState($service);
    }

    private function updatePlayerState(WebTVService $service)
    {
        $programacao = $service->getCurrentProgramacao();

        if ($programacao && $programacao->video) {
            $this->currentVideoId = $programacao->video->youtube_video_id;
            $this->titulo = $programacao->video->titulo;

            // Lógica de "Sincronia de Tempo Real"
            // Calcula quantos segundos já passaram desde o início agendado
            $inicio = Carbon::parse($programacao->inicio);
            $agora = Carbon::now();
            $segundosPassados = abs($agora->diffInSeconds($inicio));

            // Monta a URL com autoplay e o tempo exato de início (?start=)
            $this->videoUrl = "https://www.youtube.com/embed/{$this->currentVideoId}?start={$segundosPassados}&autoplay=1&mute=1&controls=1&rel=0&modestbranding=1&showinfo=0";
        } else {
            $this->resetPlayer();
        }
    }

    private function resetPlayer()
    {
        $this->currentVideoId = null;
        $this->videoUrl = null;
        $this->titulo = 'Fora do Ar';
    }

    public function render()
    {
        return view('livewire.webtv-player');
    }
}