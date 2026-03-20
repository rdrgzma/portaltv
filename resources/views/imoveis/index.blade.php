<x-layouts.portal title="Imóveis • Rede Nativos System">

    <div class="max-w-7xl mx-auto px-6 pt-10">

        <h1 class="text-4xl font-bold text-center mb-10">
            Imóveis Disponíveis
        </h1>

        <div class="bg-gray-100 rounded-2xl p-6 mb-12 shadow-sm">
            <form action="{{ route('imoveis.index') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    
                    <div class="col-span-1 md:col-span-4 lg:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
                        <input type="text" name="busca" value="{{ request('busca') }}" 
                            placeholder="Nome ou Cidade..." 
                            class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                        <select name="tipo" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            <option value="">Todos</option>
                            @foreach($tipos as $tipoOpcao)
                                <option value="{{ $tipoOpcao }}" {{ request('tipo') == $tipoOpcao ? 'selected' : '' }}>
                                    {{ $tipoOpcao }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quartos (Mín)</label>
                        <select name="quartos" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            <option value="">Qualquer</option>
                            <option value="1" {{ request('quartos') == '1' ? 'selected' : '' }}>1+</option>
                            <option value="2" {{ request('quartos') == '2' ? 'selected' : '' }}>2+</option>
                            <option value="3" {{ request('quartos') == '3' ? 'selected' : '' }}>3+</option>
                            <option value="4" {{ request('quartos') == '4' ? 'selected' : '' }}>4+</option>
                        </select>
                    </div>

                    <div class="flex space-x-2">
                        <div class="w-1/2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">R$ Min</label>
                            <input type="number" name="preco_min" value="{{ request('preco_min') }}" placeholder="0" 
                                class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm">
                        </div>
                        <div class="w-1/2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">R$ Max</label>
                            <input type="number" name="preco_max" value="{{ request('preco_max') }}" placeholder="Max" 
                                class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm">
                        </div>
                    </div>
                </div>

                <div class="mt-4 flex justify-between items-center border-t border-gray-200 pt-4">
                    <a href="{{ route('imoveis.index') }}" class="text-sm text-gray-500 hover:text-red-500 underline">
                        Limpar Filtros
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition shadow font-semibold">
                        Filtrar Resultados
                    </button>
                </div>
            </form>
        </div>
        <div class="grid md:grid-cols-3 gap-10">
            @forelse($imoveis as $imovel)
                <a href="{{ route('imoveis.show', $imovel->slug) }}"
                    class="block bg-white rounded-xl shadow hover:scale-105 transition overflow-hidden group">
                 
                    <div class="relative overflow-hidden">
                        @if($imovel->capa)
                            <img src="{{ asset('storage/' . $imovel->capa->imagem) }}" 
                                class="h-64 w-full object-cover transition duration-500 group-hover:scale-110" 
                                alt="{{ $imovel->titulo }}">
                        @else
                            <img src="https://placehold.co/800x500" 
                                class="h-64 w-full object-cover transition duration-500 group-hover:scale-110" 
                                alt="{{ $imovel->titulo }}">
                        @endif
                        <div class="absolute top-2 right-2 bg-blue-600 text-white text-xs px-2 py-1 rounded shadow">
                            {{ $imovel->tipo }}
                        </div>
                    </div>

                    <div class="p-4">
                        <h2 class="font-bold text-lg mb-1 truncate">{{ $imovel->titulo }}</h2>
                        <p class="text-sm text-gray-500 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $imovel->localizacao }}
                        </p>

                        <div class="flex justify-between items-center text-sm text-gray-600 mt-4 border-t pt-2">
                            <span>{{ $imovel->quartos }} quartos</span>
                            <span class="font-bold text-blue-600 text-lg">R$ {{ number_format($imovel->preco, 2, ',', '.') }}</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-3 text-center py-20 text-gray-500">
                    <p class="text-xl">Nenhum imóvel encontrado com estes filtros.</p>
                    <a href="{{ route('imoveis.index') }}" class="text-blue-600 hover:underline mt-2 inline-block">Ver todos os imóveis</a>
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $imoveis->links() }}
        </div>

    </div>

</x-layouts.portal>