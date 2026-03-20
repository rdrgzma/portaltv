<x-layouts.portal title="Portal WebTV">

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

{{-- Notícias --}}
<section class="max-w-7xl mx-auto px-6 mt-24">
    <h2 class="text-3xl font-bold text-center mb-10">Notícias</h2>

    <div class="grid md:grid-cols-4 gap-8">
        @foreach($noticias as $noticia)
            {{-- Abertura do link que estava faltando --}}
            <a href="{{ route('noticias.show', $noticia->slug) }}" class="group block">
                <div class="relative h-48 overflow-hidden rounded-xl shadow-md">
                    <img src="{{ $noticia->image_url }}" 
                         class="w-full h-full object-cover transition duration-500 group-hover:scale-110" 
                         alt="{{ $noticia->titulo }}"
                         loading="lazy">
                </div>
                <h3 class="font-bold mt-3 text-gray-800 group-hover:text-blue-600 transition line-clamp-2">
                    {{ $noticia->titulo }}
                </h3>
            </a>
        @endforeach
    </div>
</section>

    {{-- Imóveis --}}
    <section class="max-w-7xl mx-auto px-6 mt-32 mb-32">
        <h2 class="text-3xl font-bold text-center mb-10">Imóveis</h2>

        <div class="grid md:grid-cols-4 gap-8">
            @foreach($imoveis as $imovel)
                <a href="{{ route('imoveis.show', $imovel->slug) }}" class="bg-white p-4 rounded-xl shadow">
                        @if($imovel->capa)
                            <img src="{{ asset('storage/' . $imovel->capa->imagem) }}" >
                        @else
                        <img src="https://placehold.co/800x500">
                        @endif

                   
                    <h3 class="font-bold mt-2">{{ $imovel->titulo }}</h3>
                </a>
            @endforeach
        </div>
    </section>

</x-layouts.portal>