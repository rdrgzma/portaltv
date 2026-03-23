{{-- resources/views/components/ads/banner.blade.php --}}
@if($anuncio)
    <div class="w-full h-full {{ $class }}">
        <a href="{{ $anuncio->link ?? '#' }}" target="_blank" rel="nofollow" class="block w-full h-full">
            @if($anuncio->isVideo())
                <video 
                    src="{{ asset('storage/' . $anuncio->arquivo) }}" 
                    autoplay 
                    loop 
                    muted 
                    playsinline
                    class="w-full h-full object-cover rounded-lg shadow-sm"
                ></video>
            @else
                <img 
                    src="{{ asset('storage/' . $anuncio->arquivo) }}" 
                    alt="Publicidade"
                    class="w-full h-full object-cover rounded-lg shadow-sm hover:opacity-90 transition"
                >
            @endif
        </a>
    </div>
@else
    <div class="w-full h-full bg-gray-100/10 flex items-center justify-center text-gray-500 text-[10px] border border-dashed border-gray-700 rounded-lg uppercase tracking-widest font-bold">
        Espaço Publicitário
    </div> 
@endif