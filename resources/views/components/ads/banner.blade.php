{{-- resources/views/components/ads/banner.blade.php --}}
@if($anuncio)
    <div class="w-full h-full {{ $class }}">

        @php $tipoMidia = $anuncio->tipoMidia(); @endphp

        {{-- ──────────────────────────────────────────────────────────────
             YOUTUBE: Uso do Iframe padrão sugerido pela plataforma
        ─────────────────────────────────────────────────────────────── --}}
        @if($tipoMidia === 'youtube')
            <div class="relative w-full h-full overflow-hidden rounded-lg shadow-sm bg-black">
                <iframe
                    src="{{ $anuncio->youtubeEmbedUrl() }}"
                    class="absolute inset-0 w-full h-full"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen
                    title="Publicidade"
                ></iframe>
                {{-- Overlay invisível para forçar que o clique leve ao link do anúncio se houver --}}
                @if($anuncio->link)
                    <a href="{{ $anuncio->link }}" target="_blank" class="absolute inset-0 z-10"></a>
                @endif
            </div>

        {{-- ──────────────────────────────────────────────────────────────
             VÍDEO: Mídia local
        ─────────────────────────────────────────────────────────────── --}}
        @elseif($tipoMidia === 'video')
            <a href="{{ $anuncio->link ?? '#' }}" target="_blank" rel="nofollow" class="block w-full h-full group">
                <video
                    src="{{ asset('storage/' . $anuncio->arquivo) }}"
                    autoplay
                    loop
                    muted
                    playsinline
                    class="w-full h-full object-cover rounded-lg shadow-sm"
                ></video>
            </a>

        {{-- ──────────────────────────────────────────────────────────────
             IMAGEM: Banner estático
        ─────────────────────────────────────────────────────────────── --}}
        @elseif($tipoMidia === 'imagem')
            <a href="{{ $anuncio->link ?? '#' }}" target="_blank" rel="nofollow" class="block w-full h-full group">
                <img
                    src="{{ asset('storage/' . $anuncio->arquivo) }}"
                    alt="Publicidade"
                    class="w-full h-full object-cover rounded-lg shadow-sm group-hover:opacity-90 transition"
                >
            </a>

        @else
            <div class="w-full h-full bg-gray-100/10 flex items-center justify-center text-gray-500 text-[10px] border border-dashed border-gray-700 rounded-lg uppercase tracking-widest font-bold">
                Espaço Publicitário
            </div>
        @endif

    </div>
@else
    <div class="w-full h-full bg-gray-100/10 flex items-center justify-center text-gray-500 text-[10px] border border-dashed border-gray-700 rounded-lg uppercase tracking-widest font-bold">
        Espaço Publicitário
    </div>
@endif