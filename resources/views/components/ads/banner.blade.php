@if($anuncio)
    <div class="w-full h-full {{ $class }}">
        <a href="{{ $anuncio->link ?? '#' }}" target="_blank" rel="nofollow" class="block w-full h-full">
            <img 
                src="{{ asset('storage/' . $anuncio->arquivo) }}" 
                alt="Publicidade"
                class="w-full h-full object-cover rounded-lg shadow-sm hover:opacity-90 transition"
            >
        </a>
    </div>
@else
    {{-- Placeholder opcional para quando não houver anúncios --}}
     <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 text-xs border rounded">
        Espaço Publicitário
    </div> 
@endif