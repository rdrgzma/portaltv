<x-layouts.portal title="Rede Nativos System">

{{-- Ajustei a altura para min-h-screen para evitar rolagem excessiva vazia --}}
    <section class="min-h-screen flex flex-col justify-between py-10">

        <div class="flex flex-1 items-start justify-center px-6 gap-6">

            {{-- Propaganda esquerda (160x600 px padrão) --}}
            <div class="w-[160px] hidden md:block">
                 <x-ads.banner tipo="banner_lateral_esquerda" class="h-[600px]" />
            </div>

            {{-- Player WebTV --}}
            <div class="flex-1 max-w-5xl w-full shadow-xl rounded-2xl overflow-hidden">
                <div class="relative w-full aspect-video bg-black">
                    <livewire:webtv-player />
                </div>
            </div>

            {{-- Propaganda direita (160x600 px padrão) --}}
            <div class="w-[160px] hidden md:block">
                <x-ads.banner tipo="banner_lateral_direita" class="h-[600px]" />
            </div>

        </div>

        {{-- Banner inferior (728x90 px padrão) --}}
        <div class="mt-10 px-6 flex justify-center">
            <div class="w-full max-w-[728px] h-[90px]">
                <x-ads.banner tipo="banner_horizontal" />
            </div>
        </div>

    </section>



{{-- Notícias Regionais (RSS publicadas pelo painel) --}}
@if(isset($noticiasRss) && $noticiasRss->count() > 0)
<section class="max-w-7xl mx-auto px-6 mt-20">
    <div class="flex items-center justify-between mb-10">
        <h2 class="text-3xl font-bold text-center">Notícias </h2>
        <a href="{{ route('noticias.index') }}" class="text-blue-600 hover:underline text-sm font-semibold">
            Ver todas →
        </a>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        @foreach($noticiasRss as $rss)
            <a href="{{ route('noticias.regional.show', ['state' => $rss->state, 'id' => $rss->rss_id]) }}" class="group bg-white rounded-2xl shadow-md hover:shadow-xl overflow-hidden transition duration-300 block">
                <div class="relative h-48 overflow-hidden">
                    @if($rss->image)
                        <img src="{{ $rss->image }}"
                             alt="{{ $rss->title }}"
                             class="w-full h-full object-cover transition duration-500 group-hover:scale-110"
                             loading="lazy">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center">
                            <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                    @endif

                    {{-- Badge de destaque --}}
                    @if($rss->destaque)
                        <span class="absolute top-2 left-2 inline-flex items-center gap-1 bg-amber-400 text-amber-900 text-[10px] font-black px-2.5 py-1 rounded-full shadow">
                            ⭐ Destaque
                        </span>
                    @endif

                    {{-- Badge de fonte/estado --}}
                    <span class="absolute top-2 right-2 bg-black/60 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">
                        {{ strtoupper($rss->state) }}
                    </span>
                </div>

                <div class="p-4">
                    <p class="text-[11px] text-gray-400 mb-1 font-semibold uppercase tracking-wide">
                        {{ html_entity_decode($rss->source) }} · {{ optional($rss->published_at)->format('d/m/Y H:i') }}
                    </p>
                    <h3 class="font-bold text-gray-800 group-hover:text-blue-600 transition line-clamp-3 leading-tight">
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
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-3xl font-bold text-center">Imóveis </h2>
            <a href="{{ route('imoveis.index') }}" class="text-blue-600 hover:underline text-sm font-semibold">
                Ver todas →
            </a>
        </div>

        <div class="grid md:grid-cols-4 gap-8">
            @foreach($imoveis as $imovel)
                <a href="{{ route('imoveis.show', $imovel->slug) }}" class="group block">
                    <div class="relative h-48 overflow-hidden rounded-xl shadow-md bg-gray-100">
                        @if($imovel->capa)
                            <img src="{{ asset('storage/' . $imovel->capa->imagem) }}" 
                                 class="w-full h-full object-cover transition duration-500 group-hover:scale-110"
                                 alt="{{ $imovel->titulo }}"
                                 loading="lazy">
                        @else
                            <img src="https://placehold.co/800x500" 
                                 class="w-full h-full object-cover transition duration-500 group-hover:scale-110"
                                 alt="Sem imagem"
                                 loading="lazy">
                        @endif
                        
                        {{-- Tag Opcional (se tiver preço/status no futuro, dá pra colocar aqui) --}}
                    </div>
                    
                    <h3 class="font-bold mt-3 text-gray-800 group-hover:text-blue-600 transition line-clamp-2">
                        {{ $imovel->titulo }}
                    </h3>
                </a>
            @endforeach
        </div>
    </section>

</x-layouts.portal>