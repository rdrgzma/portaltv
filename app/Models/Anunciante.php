<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anunciante extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'telefone',
    ];

    public function anuncios(): HasMany
    {
        return $this->hasMany(Anuncio::class);
    }
}

