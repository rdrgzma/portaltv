<x-layouts.portal title="Notícias">

 

    <div class="max-w-7xl mx-auto px-6 pt-10 pb-20">

        <h1 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white leading-tight mb-12 tracking-tighter uppercase italic text-center">
            Últimas <span class="text-cyan-600 dark:text-cyan-500">Notícias</span>
        </h1>

        {{-- Notícias Regionais (RSS publicadas pelo painel) --}}
        @if(isset($noticiasRss) && $noticiasRss->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($noticiasRss as $rss)
                    <a href="{{ route('noticias.regional.show', ['state' => $rss->state, 'id' => $rss->rss_id]) }}"
                       class="group bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-[2rem] shadow-xl hover:shadow-2xl hover:border-cyan-500/50 transition-all duration-500 overflow-hidden block flex flex-col h-full">
                        
                        <div class="relative h-56 overflow-hidden">
                            @if($rss->image)
                                <img src="{{ $rss->image }}" alt="{{ $rss->title }}"
                                     class="w-full h-full object-cover transition duration-700 group-hover:scale-110" loading="lazy">
                            @else
                                <div class="w-full h-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-700">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                            @endif
                            @if($rss->destaque)
                                <span class="absolute top-4 left-4 bg-cyan-500 text-slate-950 text-[10px] font-black px-3 py-1.5 rounded-full shadow-lg shadow-cyan-500/30 uppercase tracking-tighter">⭐ Destaque</span>
                            @endif
                            <span class="absolute top-4 right-4 bg-slate-900/90 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1 rounded-full border border-white/10 uppercase tracking-widest">{{ strtoupper($rss->state) }}</span>
                        </div>

                        <div class="p-8 flex-1 flex flex-col">
                            <p class="text-[10px] text-slate-400 dark:text-slate-500 mb-4 font-black uppercase tracking-widest">{{ html_entity_decode($rss->source) }} · {{ optional($rss->published_at)->format('d/m/Y H:i') }}</p>
                            <h3 class="font-black text-xl text-slate-900 dark:text-white group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition line-clamp-3 leading-tight uppercase italic tracking-tighter mb-4 flex-1">{{ $rss->title }}</h3>
                            
                            @if($rss->description)
                                <p class="text-sm text-slate-600 dark:text-slate-200 line-clamp-3 mb-6 font-medium leading-relaxed">{{ $rss->description }}</p>
                            @endif

                            <div class="mt-auto flex items-center gap-2 text-cyan-600 dark:text-cyan-500 text-xs font-black uppercase tracking-widest group-hover:gap-4 transition-all">
                                Ler notícia completa
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

</x-layouts.portal>
