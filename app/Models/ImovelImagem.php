<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImovelImagem extends Model
{
    protected $table = 'imovel_imagems';

    protected $fillable = [
        'imovel_id',
        'imagem',
        'ordem',
    ];

    public function imovel(): BelongsTo
    {
        return $this->belongsTo(Imovel::class);
    }
}
