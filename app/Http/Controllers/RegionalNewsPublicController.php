<?php

namespace App\Http\Controllers;

use App\Models\RegionalNewsItem;
use App\Services\RegionalNewsService;

class RegionalNewsPublicController
{
    public function show(string $state, string $id)
    {
        // 1. Tenta buscar no banco (já salvo pelo admin)
        $item = RegionalNewsItem::where('rss_id', $id)->first();

        // 2. Se não estiver no banco, busca no RSS e monta o array
        if (! $item) {
            $data = app(RegionalNewsService::class)->getNewsItem($state, $id);
            abort_if(is_null($data), 404);

            // Converte para objeto compatível com a view
            $noticia = (object) [
                'title'        => $data['title'],
                'link'         => $data['link'],
                'description'  => $data['description'],
                'full_content' => $data['full_content'],
                'image'        => $data['image'],
                'source'       => $data['source'] ?? 'G1',
                'author'       => $data['author'],
                'published_at' => isset($data['date_raw'])
                    ? \Carbon\Carbon::parse($data['date_raw'])
                    : null,
                'state'        => $state,
                'state_name'   => $data['state_name'] ?? strtoupper($state),
            ];
        } else {
            // Converte o Model para objeto compatível com a view
            $noticia = (object) [
                'title'        => $item->title,
                'link'         => $item->link,
                'description'  => $item->description,
                'full_content' => $item->full_content,
                'image'        => $item->image,
                'source'       => $item->source,
                'author'       => $item->author,
                'published_at' => $item->published_at,
                'state'        => $item->state,
                'state_name'   => $item->state_name,
            ];
        }

        // Notícias relacionadas: outras RSS publicadas, exceto a atual
        $relacionadas = RegionalNewsItem::publicados()
            ->where('rss_id', '!=', $id)
            ->orderByDesc('destaque')
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        return view('noticias.regional-show', compact('noticia', 'relacionadas'));
    }
}
