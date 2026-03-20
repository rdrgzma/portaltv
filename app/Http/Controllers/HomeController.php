<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Imovel;

class HomeController 
{
    public function index()
    {
        $noticias = Noticia::where('ativo', true)
            ->orderByDesc('publicado_em')
            ->limit(8)
            ->get();

        $imoveis = Imovel::where('ativo', true)
            ->where('destaque', true)
            ->with('imagens')
            ->limit(8)
            ->get();

        return view('home', compact('noticias', 'imoveis'));
    }
}
