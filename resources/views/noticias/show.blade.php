<x-layouts.portal :title="$noticia->titulo . ' • Rede Nativos System'">

    <div class="max-w-4xl mx-auto pt-10 px-6">

        <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white leading-tight mb-6 tracking-tighter uppercase italic">
            {{ $noticia->titulo }}
        </h1>

        <p class="text-slate-500 mb-8 font-bold uppercase tracking-widest text-xs">
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

        <article class="prose prose-lg dark:prose-invert max-w-none mb-10 text-slate-700 dark:text-slate-100 leading-relaxed font-medium">
            {!! $noticia->conteudo !!}
        </article>

        {{-- NOTÍCIAS RELACIONADAS --}}
        @if(isset($relacionadas) && $relacionadas->count() > 0)
            <h2 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tighter mb-8 italic border-b border-slate-200 dark:border-slate-800 pb-4">
                Notícias <span class="text-cyan-600 dark:text-cyan-500">Relacionadas</span>
            </h2>

            <div class="grid md:grid-cols-3 gap-6">
                @foreach($relacionadas as $rel)
                    <a href="{{ route('noticias.show', $rel->slug) }}"
                        class="group bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-4 rounded-2xl shadow-xl hover:border-cyan-500/50 transition-all duration-300 block">
                        
                        <div class="overflow-hidden rounded-xl mb-4">
                            <img src="{{ $rel->image_url }}"
                                class="w-full h-40 object-cover transition duration-700 group-hover:scale-110" 
                                alt="{{ $rel->titulo }}">
                        </div>

                        <h3 class="font-bold text-slate-800 dark:text-slate-100 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition line-clamp-2 text-sm uppercase tracking-wider">
                            {{ $rel->titulo }}
                        </h3>
                    </a>
                @endforeach
            </div>
        @endif

    </div>

    <script>
        gsap.from("main", { opacity: 0, y: 30, duration: 0.8, ease: "power2.out" });
    </script>

</x-layouts.portal>