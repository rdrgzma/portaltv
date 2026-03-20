@php
    $template  = \App\Models\Setting::getValue('template_choice', 'classic');
    $heroType  = \App\Models\Setting::getValue('hero_type', 'video');
    $heroImage = \App\Models\Setting::getValue('hero_image');
@endphp

<x-layouts.portal title="Rede Nativos System">

    <section class="max-w-7xl mx-auto py-10">

        <div class="flex flex-col lg:flex-row items-center lg:items-start justify-center px-6 gap-8">

            {{-- Propaganda esquerda --}}
            <div class="w-[160px] hidden xl:block flex-shrink-0">
                 <x-ads.banner tipo="banner_lateral_esquerda" class="h-[600px] rounded-xl shadow-lg border border-slate-800" />
            </div>

            {{-- Conteúdo Principal (Hero) --}}
            <div class="flex-1 w-full flex flex-col gap-8">
                
                @if($heroType === 'video')
                    <div class="w-full shadow-2xl rounded-2xl overflow-hidden border border-slate-800 bg-black aspect-video relative group">
                        <livewire:webtv-player />
                        <div class="absolute top-4 left-4 bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider animate-pulse">
                            No Ar
                        </div>
                    </div>
                @else
                    <div class="w-full shadow-2xl rounded-2xl overflow-hidden border border-slate-800 bg-slate-900 aspect-video relative group">
                        @if($heroImage)
                            <img src="{{ asset('storage/' . $heroImage) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="Destaque">
                        @else
                            <img src="{{ asset('img/hero_default.png') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="Rede Nativos System">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/20 to-transparent flex flex-col justify-end p-8">
                            <span class="text-cyan-400 font-black uppercase tracking-[0.3em] text-[10px] mb-3 animate-pulse">Conectando o Nordeste ao Futuro</span>
                            <h2 class="text-white text-3xl md:text-5xl font-black leading-tight max-w-2xl uppercase italic tracking-tighter drop-shadow-2xl">
                                Rede <span class="text-cyan-500">Nativos</span> System
                            </h2>
                            <p class="text-slate-400 text-sm mt-2 font-medium max-w-lg">
                                Sua fonte definitiva de informação, entretenimento e oportunidades regionais.
                            </p>
                        </div>
                    </div>
                @endif

                {{-- Banner horizontal interno --}}
                <div class="w-full h-[90px] rounded-xl overflow-hidden shadow-lg border border-slate-800">
                    <x-ads.banner tipo="banner_horizontal" />
                </div>
            </div>

            {{-- Propaganda direita --}}
            <div class="w-[160px] hidden xl:block flex-shrink-0">
                <x-ads.banner tipo="banner_lateral_direita" class="h-[600px] rounded-xl shadow-lg border border-slate-800" />
            </div>

        </div>

    </section>

    {{-- Seção de Notícias Regionais --}}
    @if(isset($noticiasRss) && $noticiasRss->count() > 0)
        <section class="max-w-7xl mx-auto px-6 mt-20">
            <div class="flex items-center justify-between mb-10 border-b border-slate-800 pb-4">
                <h2 class="text-3xl font-black uppercase tracking-tighter">
                    Notícias <span class="text-cyan-500">Regionais</span>
                </h2>
                <a href="{{ route('noticias.index') }}" class="text-xs font-bold uppercase tracking-widest text-slate-500 hover:text-cyan-500 transition">
                    Ver todas →
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach($noticiasRss as $rss)
                    <a href="{{ route('noticias.regional.show', ['state' => $rss->state, 'id' => $rss->rss_id]) }}" class="group bg-slate-900 border border-slate-800 rounded-3xl shadow-xl overflow-hidden transition-all duration-300 hover:border-cyan-500/50 hover:-translate-y-2 block">
                        <div class="relative h-56 overflow-hidden">
                            @if($rss->image)
                                <img src="{{ $rss->image }}" alt="{{ $rss->title }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" loading="lazy">
                            @else
                                <div class="w-full h-full bg-slate-800 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                </div>
                            @endif

                            @if($rss->destaque)
                                <span class="absolute top-4 left-4 inline-flex items-center gap-1 bg-cyan-500 text-slate-950 text-[10px] font-black px-3 py-1 rounded-full shadow-lg shadow-cyan-500/30 uppercase tracking-tighter">
                                    ⭐ Destaque
                                </span>
                            @endif

                            <span class="absolute top-4 right-4 bg-black/60 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1 rounded-full border border-white/10">
                                {{ strtoupper($rss->state) }}
                            </span>
                        </div>

                        <div class="p-6">
                            <p class="text-[10px] text-slate-500 mb-3 font-bold uppercase tracking-widest">
                                {{ html_entity_decode($rss->source) }} · {{ optional($rss->published_at)->format('d/m/Y H:i') }}
                            </p>
                            <h3 class="font-bold text-lg text-slate-100 group-hover:text-cyan-400 transition leading-tight line-clamp-3">
                                {{ $rss->title }}
                            </h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Imóveis --}}
    <section class="max-w-7xl mx-auto px-6 mt-32 mb-32">
        <div class="flex items-center justify-between mb-10 border-b border-slate-200 dark:border-slate-800 pb-4">
            <h2 class="text-3xl font-black uppercase tracking-tighter text-slate-900 dark:text-white">
                Oportunidades <span class="text-cyan-600 dark:text-cyan-500">Imobiliárias</span>
            </h2>
            <a href="{{ route('imoveis.index') }}" class="text-xs font-black uppercase tracking-widest text-slate-400 hover:text-cyan-600 dark:hover:text-cyan-500 transition italic">
                Ver todas →
            </a>
        </div>

        <div class="grid md:grid-cols-4 gap-8">
            @foreach($imoveis as $imovel)
                <a href="{{ route('imoveis.show', $imovel->slug) }}" class="group block">
                    <div class="relative h-56 overflow-hidden rounded-3xl shadow-xl transition-all duration-500 group-hover:shadow-cyan-500/30 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800">
                        @if($imovel->capa)
                            <img src="{{ asset('storage/' . $imovel->capa->imagem) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="{{ $imovel->titulo }}" loading="lazy">
                        @else
                            <div class="w-full h-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-700">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            </div>
                        @endif
                    </div>
                    
                    <h3 class="font-black mt-6 text-slate-900 dark:text-white group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition line-clamp-2 uppercase text-sm tracking-tighter italic">
                        {{ $imovel->titulo }}
                    </h3>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-500 mt-1">
                        {{ ucfirst($imovel->tipo) }} · R$ {{ number_format($imovel->valor, 2, ',', '.') }}
                    </p>
                </a>
            @endforeach
        </div>
    </section>

</x-layouts.portal>