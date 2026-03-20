<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'titulo',
        'youtube_url',
        'youtube_video_id',
        'duracao',
        'aprovado',
        'ativo',
    ];

    protected $casts = [
        'aprovado' => 'boolean',
        'ativo'    => 'boolean',
    ];

    /* ================= RELACIONAMENTOS ================= */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function programacoes(): HasMany
    {
        return $this->hasMany(Programacao::class);
    }
}

