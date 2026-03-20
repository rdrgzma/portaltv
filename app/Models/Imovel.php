<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Imovel extends Model
{
    protected $fillable = [
        'titulo',
        'slug',
        'descricao',
        'tipo',
        'valor',
        'quartos',
        'banheiros',
        'garagem',
        'area',
        'localizacao',
        'youtube_url',
        'destaque',
        'ativo',
    ];

    protected $casts = [
        'valor'    => 'decimal:2',
        'destaque' => 'boolean',
        'ativo'    => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($imovel) {
            $imovel->slug = Str::slug($imovel->titulo);
        });
    }

    public function getCapaAttribute()
{
    // Retorna a imagem de ordem 1 ou a primeira imagem encontrada
    return $this->imagens->firstWhere('ordem', 1) ?? $this->imagens->first();
}

    /* ================= RELACIONAMENTOS ================= */

    public function imagens(): HasMany
    {
        return $this->hasMany(ImovelImagem::class);
    }
}
