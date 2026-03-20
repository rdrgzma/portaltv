<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Noticia extends Model
{
    protected $fillable = [
        'titulo',
        'slug',
        'resumo',
        'conteudo',
        'imagem',
        'destaque',
        'ativo',
        'publicado_em',
        'categoria',
    ];

    protected $casts = [
        'destaque'     => 'boolean',
        'ativo'        => 'boolean',
        'publicado_em' => 'datetime',
    ];

    /**
     * Define como a URL da imagem é gerada.
     * Acessado na View como $noticia->image_url
     */
protected function imageUrl(): Attribute
{
    return Attribute::make(
        get: function () {
            // Verifica se está vazio ou se o crawler salvou a string "None"
            if (empty($this->imagem) || $this->imagem === 'None') {
                return 'https://placehold.co/600x400?text=Portal+WebTV';
            }

            // Se for link externo do G1, retorna a URL pura
            if (str_starts_with($this->imagem, 'http')) {
                return $this->imagem;
            }

            // Se for upload local (Filament), retorna a URL do storage
            return \Illuminate\Support\Facades\Storage::url($this->imagem);
        },
    );
}

    protected static function booted()
    {
        static::creating(function ($noticia) {
            // Garante que o slug seja gerado se estiver vazio
            if (!$noticia->slug) {
                $noticia->slug = Str::slug($noticia->titulo);
            }
        });
    }
}

