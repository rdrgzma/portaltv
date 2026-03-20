<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo; // Added this line
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'responsible_id', // Changed from user_id
        'responsible_type', // Added this line
        'titulo',
        'youtube_url',
        'youtube_video_id',
        'duracao',
        'aprovado',
        'ativo',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'aprovado' => 'boolean',
            'ativo' => 'boolean',
            'duracao' => 'integer',
        ];
    }

    /* ================= RELACIONAMENTOS ================= */

    public function responsible(): MorphTo
    {
        return $this->morphTo();
    }

    public function programacoes(): HasMany
    {
        return $this->hasMany(Programacao::class);
    }
}

