<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Programacao extends Model
{
    protected $fillable = [
        'video_id',
        'inicio',
        'fim',
        'status',
        'prioridade',
    ];

    protected $casts = [
        'inicio' => 'datetime',
        'fim'    => 'datetime',
    ];

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
}
