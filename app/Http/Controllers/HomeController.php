<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Imovel;
use App\Models\RegionalNewsItem;

class HomeController
{
    public function index()
    {
        // Notícias editoriais (cadastradas no painel)
        $noticias = Noticia::where('ativo', true)
            ->orderByDesc('publicado_em')
            ->limit(8)
            ->get();

        // Notícias RSS publicadas pelo painel (destaques primeiro)
        $noticiasRss = RegionalNewsItem::publicados()
            ->orderByDesc('destaque')
            ->orderByDesc('published_at')
            ->limit(6)
            ->get();

        $imoveis = Imovel::where('ativo', true)
            ->where('destaque', true)
            ->with('imagens')
            ->limit(8)
            ->get();

        return view('home', compact('noticias', 'noticiasRss', 'imoveis'));
    }
}
