<x-layouts.portal title="Notícias">

    {{-- Definimos as categorias diretamente aqui na View --}}
    @php
        $categorias = [
            'politica'       => 'Política',
            'esportes'       => 'Esportes',
            'entretenimento' => 'Entretenimento',
            'tecnologia'     => 'Tecnologia',
            'saude'          => 'Saúde',
            'negocios'       => 'Negócios',
            'curiosidades'   => 'Curiosidades',
            'geral'          => 'Geral',
        ];
    @endphp

    <div class="max-w-7xl mx-auto px-6 py-10">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
            <h1 class="text-4xl font-bold text-gray-900">Últimas Notícias</h1>

            <form action="{{ route('noticias.index') }}" method="GET" class="w-full md:w-auto">
                <div class="relative">
                    <select name="categoria" onchange="this.form.submit()" 
                        class="w-full md:w-64 bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-lg focus:outline-none focus:border-blue-500 shadow-sm cursor-pointer">
                        
                        <option value="">Todas as Categorias</option>
                        
                        @foreach($categorias as $slug => $label)
                            <option value="{{ $slug }}" {{ request('categoria') === $slug ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach

                    </select>
                </div>
            </form>
        </div>

        <div class="grid md:grid-cols-3 gap-10">
            @forelse($noticias as $noticia)
                <a href="{{ route('noticias.show', $noticia->slug) }}" class="group bg-white rounded-xl shadow hover:shadow-lg transition duration-300 flex flex-col h-full overflow-hidden">
                    
                    <div class="relative h-56 overflow-hidden">
                        @if($noticia->imagem)
<img src="{{ $noticia->image_url }}" 
     class="w-full h-full object-cover transition duration-500 group-hover:scale-110" 
     alt="{{ $noticia->titulo }}">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                Sem Imagem
                            </div>
                        @endif

                        @if($noticia->categoria && isset($categorias[$noticia->categoria]))
                            <span class="absolute top-3 right-3 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                                {{ $categorias[$noticia->categoria] }}
                            </span>
                        @endif
                    </div>
                    
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="text-xs text-gray-500 mb-2 flex items-center gap-2">
                            <span>{{ $noticia->publicado_em ? $noticia->publicado_em->format('d/m/Y') : 'Data n/d' }}</span>
                        </div>

                        <h2 class="font-bold text-xl mb-3 text-gray-800 leading-tight group-hover:text-blue-600 transition">
                            {{ $noticia->titulo }}
                        </h2>
                        
                        <p class="text-gray-600 text-sm line-clamp-3 mb-4 flex-1">
                            {{ $noticia->resumo }}
                        </p>
                        
                        <div class="text-blue-600 font-semibold text-sm mt-auto flex items-center">
                            Ler matéria completa 
                            <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-3 py-16 text-center bg-gray-50 rounded-xl border border-dashed border-gray-300">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    <p class="text-gray-500 text-lg font-medium">Nenhuma notícia encontrada nesta categoria.</p>
                    <a href="{{ route('noticias.index') }}" class="text-blue-600 hover:underline mt-2 inline-block font-semibold">Ver todas as notícias</a>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $noticias->links() }}
        </div>
    </div>
</x-layouts.portal>