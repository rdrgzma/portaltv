<x-layouts.portal :title="$noticia->titulo . ' • Rede Nativos System'">

    <div class="max-w-4xl mx-auto pt-10 px-6">

        <h1 class="text-4xl font-bold mb-4">
            {{ $noticia->titulo }}
        </h1>

        <p class="text-neutral-500 mb-6">
            Publicado em
            {{ optional($noticia->publicado_em)->format('d/m/Y') ?? $noticia->created_at->format('d/m/Y') }}
            — Por Redação WebTV
        </p>

        {{-- Imagem Principal usando o Accessor do Model --}}
        <div class="mb-8">
            <img src="{{ $noticia->image_url }}"
                class="rounded-xl shadow w-full object-cover" 
                alt="{{ $noticia->titulo }}">
        </div>

        <article class="prose max-w-none text-lg">
            {!! $noticia->conteudo !!}
        </article>

        {{-- NOTÍCIAS RELACIONADAS --}}
        @if(isset($relacionadas) && $relacionadas->count() > 0)
            <h2 class="text-2xl font-bold mt-16 mb-6">
                Notícias relacionadas
            </h2>

            <div class="grid md:grid-cols-3 gap-6">
                @foreach($relacionadas as $rel)
                    <a href="{{ route('noticias.show', $rel->slug) }}"
                        class="news-card bg-white p-4 rounded-xl shadow hover:scale-105 transition block">

                        <img src="{{ $rel->image_url }}"
                            class="rounded-lg mb-3 w-full h-40 object-cover" 
                            alt="{{ $rel->titulo }}">

                        <h3 class="font-bold line-clamp-2">
                            {{ $rel->titulo }}
                        </h3>

                        @if($rel->resumo)
                            <p class="text-sm opacity-70 mt-1 line-clamp-2">
                                {{ $rel->resumo }}
                            </p>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif

    </div>

    <script>
        gsap.from("main", { opacity: 0, y: 30, duration: 0.8, ease: "power2.out" });
    </script>

</x-layouts.portal>