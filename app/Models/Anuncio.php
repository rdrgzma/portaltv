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
        'youtube_url',
        'exibir_midia',   // 'arquivo' | 'youtube'
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

    /**
     * Retorna o tipo de mídia que deve ser EXIBIDA, respeitando a escolha do usuário:
     * - 'arquivo' → exibir o arquivo enviado (pode ser 'video' ou 'imagem')
     * - 'youtube' → exibir o iframe do YouTube
     */
    public function tipoMidia(): ?string
    {
        $escolha = $this->exibir_midia ?? 'arquivo';

        if ($escolha === 'youtube' && $this->youtube_url) {
            return 'youtube';
        }

        if ($this->arquivo) {
            $ext = strtolower(pathinfo($this->arquivo, PATHINFO_EXTENSION));
            if (in_array($ext, ['mp4', 'webm', 'ogg'])) {
                return 'video';
            }
            return 'imagem';
        }

        // Fallback: se não tiver arquivo mas tiver youtube, usa youtube
        if ($this->youtube_url) {
            return 'youtube';
        }

        return null;
    }

    public function isVideo(): bool   { return $this->tipoMidia() === 'video'; }
    public function isImagem(): bool  { return $this->tipoMidia() === 'imagem'; }
    public function isYoutube(): bool { return $this->tipoMidia() === 'youtube'; }

    /** Extrai o ID do vídeo do YouTube (suporta youtu.be, watch?v= e /embed/) */
    public function youtubeVideoId(): ?string
    {
        if (!$this->youtube_url) return null;

        preg_match(
            '/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
            $this->youtube_url,
            $matches
        );

        return $matches[1] ?? null;
    }

    /**
     * URL de embed do YouTube.
     * Corrigido para evitar Erro 153:
     * - Removido 'origin' (causa erro em domínios .test ou sem SSL)
     * - Removido 'showinfo' (descontinuado)
     * - Adicionado 'playlist' igual ao ID para o loop nativo funcionar
     */
    public function youtubeEmbedUrl(): ?string
    {
        $id = $this->youtubeVideoId();
        if (!$id) return null;

        // Parâmetros mínimos e mais seguros para evitar conflitos (Erro 153)
        $params = [
            'autoplay'       => 1,
            'mute'           => 1,
            'loop'           => 1,
            'playlist'       => $id,
            'enablejsapi'    => 1, // Útil para o player carregar corretamente
        ];

        return "https://www.youtube.com/embed/{$id}?" . http_build_query($params);
    }
}
