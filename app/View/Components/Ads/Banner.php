<?php

namespace App\View\Components\Ads;

use App\Models\Anuncio;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Banner extends Component
{
    public ?Anuncio $anuncio;

    public function __construct(
        public string $tipo,
        public string $class = ''
    ) {
        // Busca um anúncio aleatório que esteja ativo e dentro do prazo
        $this->anuncio = Anuncio::where('tipo', $this->tipo)
            ->where('ativo', true)
            ->whereDate('inicio', '<=', now())
            ->whereDate('fim', '>=', now())
            ->inRandomOrder() // Rotaciona os banners
            ->first();
    }

    public function render(): View|Closure|string
    {
        return view('components.ads.banner');
    }
}
