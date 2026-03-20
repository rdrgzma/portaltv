<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Anuncio extends Model
{
    protected $fillable = [
        'anunciante_id',
        'tipo',
        'arquivo',
        'link',
        'inicio',
        'fim',
        'prioridade',
        'ativo',
    ];

    protected $casts = [
        'inicio' => 'date',
        'fim'    => 'date',
        'ativo'  => 'boolean',
    ];

    public function anunciante(): BelongsTo
    {
        return $this->belongsTo(Anunciante::class);
    }
}
