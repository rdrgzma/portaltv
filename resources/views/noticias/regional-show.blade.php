<x-layouts.portal :title="$noticia->title . ' • Rede Nativos System'">

    <div class="max-w-4xl mx-auto pt-10 px-6 pb-20">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Início</a>
            <span>/</span>
            <a href="{{ route('noticias.index') }}" class="hover:text-blue-600 transition">Notícias</a>
            <span>/</span>
            <span class="text-gray-800 font-medium line-clamp-1">{{ $noticia->title }}</span>
        </nav>

        {{-- Badges: Região + Fonte --}}
        <div class="flex flex-wrap items-center gap-3 mb-6">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                📍 {{ $noticia->state_name }}
            </span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-gray-100 text-gray-600">
                📰 {{ html_entity_decode($noticia->source) }}
            </span>
            @if($noticia->author)
                <span class="inline-flex items-center gap-1.5 text-sm text-gray-500">
                    ✍️ {{ $noticia->author }}
                </span>
            @endif
            @if($noticia->published_at)
                <span class="inline-flex items-center gap-1.5 text-sm text-gray-500">
                    🗓️ {{ $noticia->published_at->format('d/m/Y \à\s H:i') }}
                </span>
            @endif
        </div>

        {{-- Título --}}
        <h1 class="text-3xl md:text-4xl font-black text-gray-900 leading-tight mb-6 tracking-tight">
            {{ $noticia->title }}
        </h1>

        <div class="h-1 w-20 rounded-full bg-blue-500 mb-8"></div>

        {{-- Imagem hero --}}
        @if($noticia->image)
            <div class="rounded-2xl overflow-hidden shadow-xl mb-8 aspect-video">
                <img
                    src="{{ $noticia->image }}"
                    alt="{{ $noticia->title }}"
                    class="w-full h-full object-cover"
                >
            </div>
        @endif

        {{-- Conteúdo --}}
        <div class="prose prose-lg max-w-none mb-10 text-gray-700 leading-relaxed">
            @if($noticia->full_content && $noticia->full_content !== $noticia->description)
                <p class="text-xl font-medium text-gray-800 mb-6 leading-relaxed">
                    {{ $noticia->description }}
                </p>
                <div class="whitespace-pre-line">{{ $noticia->full_content }}</div>
            @else
                <p class="text-lg">{{ $noticia->description }}</p>
            @endif
        </div>

        {{-- CTA para notícia original --}}
        <div class="flex items-center gap-3 p-5 rounded-2xl bg-blue-50 border border-blue-100 mb-12">
            <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-gray-600">
                Publicada por <strong>{{ html_entity_decode($noticia->source) }}</strong> ·
                <a
                    href="{{ $noticia->link }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="text-blue-600 hover:underline font-semibold"
                >Leia a matéria completa</a>
            </p>
        </div>

        {{-- Notícias Relacionadas (outras RSS publicadas) --}}
        @if($relacionadas->count() > 0)
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Outras Notícias Regionais</h2>

            <div class="grid md:grid-cols-3 gap-6">
                @foreach($relacionadas as $rel)
                    @php
                        $relUrl = route('noticias.regional.show', ['state' => $rel->state, 'id' => $rel->rss_id]);
                    @endphp
                    <a href="{{ $relUrl }}" class="group bg-white rounded-xl shadow hover:shadow-lg transition duration-300 overflow-hidden block">
                        <div class="h-40 overflow-hidden">
                            @if($rel->image)
                                <img src="{{ $rel->image }}" alt="{{ $rel->title }}"
                                     class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-300">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">{{ strtoupper($rel->state) }} · {{ html_entity_decode($rel->source) }}</p>
                            <h3 class="font-bold text-gray-800 group-hover:text-blue-600 transition line-clamp-2 text-sm leading-snug">
                                {{ $rel->title }}
                            </h3>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

    </div>

</x-layouts.portal>
