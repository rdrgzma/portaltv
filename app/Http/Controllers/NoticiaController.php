<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController 
{
    public function index(Request $request)
    {
        $query = Noticia::where('ativo', true);

        // Filtro por Categoria
        $query->when($request->filled('categoria'), function ($q) use ($request) {
            $q->where('categorias', $request->categoria);
        });

        // (Opcional) Filtro por Texto (Título) caso queira buscar também
        $query->when($request->filled('busca'), function ($q) use ($request) {
            $q->where('titulo', 'like', '%' . $request->busca . '%');
        });

        $noticias = $query->orderByDesc('publicado_em')
            ->paginate(9)
            ->withQueryString(); // Mantém o filtro na paginação

        return view('noticias.index', compact('noticias'));
    }

    public function show(string $slug)
    {
        $noticia = Noticia::where('slug', $slug)
            ->where('ativo', true)
            ->firstOrFail();

        $relacionadas = Noticia::where('ativo', true)
            ->where('id', '!=', $noticia->id)
            // Tenta pegar da mesma categoria, se não tiver, pega geral
            ->where(function($q) use ($noticia) {
                $q->where('categorias', $noticia->categorias)
                  ->orWhereNull('categoria');
            })
            ->latest()
            ->limit(3)
            ->get();

        return view('noticias.show', compact('noticia', 'relacionadas'));
    }
}
