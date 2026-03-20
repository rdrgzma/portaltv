<?php

namespace App\Http\Controllers;

use App\Models\Imovel;
use Illuminate\Http\Request;

class ImovelController 
{
    public function index(Request $request)
    {
        $query = Imovel::where('ativo', true)->with('imagens');

        // Filtro por Texto (Título ou Localização)
        $query->when($request->filled('busca'), function ($q) use ($request) {
            $termo = '%' . $request->busca . '%';
            $q->where(function ($subQ) use ($termo) {
                $subQ->where('titulo', 'like', $termo)
                     ->orWhere('localizacao', 'like', $termo);
            });
        });

        // Filtro por Tipo (Ex: Casa, Apartamento)
        $query->when($request->filled('tipo'), function ($q) use ($request) {
            $q->where('tipo', $request->tipo);
        });

        // Filtro por Quartos (Mínimo)
        $query->when($request->filled('quartos'), function ($q) use ($request) {
            $q->where('quartos', '>=', $request->quartos);
        });

        // Filtro de Preço (Mínimo e Máximo)
        $query->when($request->filled('preco_min'), fn($q) => $q->where('valor', '>=', $request->preco_min));
        $query->when($request->filled('preco_max'), fn($q) => $q->where('valor', '<=', $request->preco_max));

        // Ordenação
        $imoveis = $query->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString(); // Mantém os filtros ao paginar

        // (Opcional) Pegar lista única de tipos existentes para o select
        $tipos = Imovel::where('ativo', true)->distinct()->pluck('tipo');

        return view('imoveis.index', compact('imoveis', 'tipos'));
    }

    public function show(string $slug)
    {
        $imovel = Imovel::where('slug', $slug)
            ->where('ativo', true)
            ->with('imagens')
            ->firstOrFail();

        return view('imoveis.show', compact('imovel'));
    }
}