<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plano extends Model
{
    protected $fillable = [
        'nome',
        'valor',
        'limite_videos',
        'limite_imoveis',
        'limite_anuncios',
        'ativo',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
        'ativo' => 'boolean',
    ];

    public function pagamentos(): HasMany
    {
        return $this->hasMany(Pagamento::class);
    }

    public function usuarios(): HasMany
    {
        return $this->hasMany(User::class);
    }
}

