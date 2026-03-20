<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\RegionalNewsItem;
use Illuminate\Http\Request;

class NoticiaController
{
    public function index(Request $request)
    {
        $query = Noticia::where('ativo', true);

        $query->when($request->filled('categoria'), function ($q) use ($request) {
            $q->where('categoria', $request->categoria);
        });

        $query->when($request->filled('busca'), function ($q) use ($request) {
            $q->where('titulo', 'like', '%' . $request->busca . '%');
        });

        $noticias = $query->orderByDesc('publicado_em')
            ->paginate(9)
            ->withQueryString();

        // Notícias RSS publicadas (destaques primeiro)
        $noticiasRss = RegionalNewsItem::publicados()
            ->orderByDesc('destaque')
            ->orderByDesc('published_at')
            ->limit(9)
            ->get();

        return view('noticias.index', compact('noticias', 'noticiasRss'));
    }

    public function show(string $slug)
    {
        $noticia = Noticia::where('slug', $slug)
            ->where('ativo', true)
            ->firstOrFail();

        $relacionadas = Noticia::where('ativo', true)
            ->where('id', '!=', $noticia->id)
            ->where(function ($q) use ($noticia) {
                $q->where('categoria', $noticia->categoria)
                  ->orWhereNull('categoria');
            })
            ->latest()
            ->limit(3)
            ->get();

        return view('noticias.show', compact('noticia', 'relacionadas'));
    }
}
