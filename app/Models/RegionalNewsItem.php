<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RegionalNewsItem extends Model
{
    protected $table = 'regional_news_items';

    protected $fillable = [
        'rss_id',
        'state',
        'state_name',
        'title',
        'link',
        'description',
        'full_content',
        'image',
        'source',
        'author',
        'published_at',
        'destaque',
        'publicado',
    ];

    protected $casts = [
        'destaque'     => 'boolean',
        'publicado'    => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Cria ou atualiza o registro a partir de um array de dados RSS.
     */
    public static function syncFromRss(array $item): static
    {
        return static::updateOrCreate(
            ['rss_id' => $item['id']],
            [
                'state'        => $item['state'],
                'state_name'   => $item['state_name'] ?? strtoupper($item['state']),
                'title'        => $item['title'],
                'link'         => $item['link'],
                'description'  => $item['description'],
                'full_content' => $item['full_content'] ?? null,
                'image'        => $item['image'] ?? null,
                'source'       => $item['source'] ?? 'G1',
                'author'       => $item['author'] ?? null,
                'published_at' => isset($item['date_raw'])
                    ? Carbon::parse($item['date_raw'])
                    : now(),
            ]
        );
    }

    /** Scope: apenas publicados */
    public function scopePublicados($query)
    {
        return $query->where('publicado', true);
    }

    /** Scope: apenas destaques */
    public function scopeDestaques($query)
    {
        return $query->where('destaque', true);
    }
}
