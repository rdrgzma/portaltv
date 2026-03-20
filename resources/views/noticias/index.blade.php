<x-layouts.portal title="Notícias">

 

    {{-- Notícias Regionais (RSS publicadas pelo painel) --}}
    @if(isset($noticiasRss) && $noticiasRss->count() > 0)
    <div class="max-w-7xl mx-auto px-6 mt-16 mb-16">
        <div class="flex items-center gap-3 mb-8">
            <div class="h-8 w-1.5 rounded-full bg-blue-600"></div>
            <h2 class="text-2xl font-bold text-gray-900">Notícias Regionais</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach($noticiasRss as $rss)
                <a href="{{ route('noticias.regional.show', ['state' => $rss->state, 'id' => $rss->rss_id]) }}"
                   class="group bg-white rounded-xl shadow hover:shadow-lg transition duration-300 flex flex-col overflow-hidden">
                    <div class="relative h-48 overflow-hidden">
                        @if($rss->image)
                            <img src="{{ $rss->image }}" alt="{{ $rss->title }}"
                                 class="w-full h-full object-cover transition duration-500 group-hover:scale-110" loading="lazy">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                        @endif
                        @if($rss->destaque)
                            <span class="absolute top-2 left-2 bg-amber-400 text-amber-900 text-[10px] font-black px-2.5 py-1 rounded-full shadow">⭐ Destaque</span>
                        @endif
                        <span class="absolute top-2 right-2 bg-blue-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-full">{{ strtoupper($rss->state) }}</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <p class="text-xs text-gray-400 mb-2 font-semibold">{{ html_entity_decode($rss->source) }} · {{ optional($rss->published_at)->format('d/m/Y H:i') }}</p>
                        <h3 class="font-bold text-lg text-gray-800 group-hover:text-blue-600 transition line-clamp-3 leading-snug flex-1">{{ $rss->title }}</h3>
                        @if($rss->description)
                            <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ $rss->description }}</p>
                        @endif
                        <span class="mt-4 text-blue-600 text-sm font-semibold flex items-center gap-1">
                            Ler notícia original
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    @endif

</x-layouts.portal>
