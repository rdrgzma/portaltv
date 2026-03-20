<x-layouts.portal title="Imóveis • Rede Nativos System">

    <div class="max-w-7xl mx-auto px-6 pt-10 pb-20">

        <h1 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white leading-tight mb-12 tracking-tighter uppercase italic text-center">
            Imóveis <span class="text-cyan-600 dark:text-cyan-500">Disponíveis</span>
        </h1>

        {{-- Filtros Modernos --}}
        <div class="bg-white dark:bg-slate-900 rounded-3xl p-8 mb-16 shadow-2xl border border-slate-200 dark:border-slate-800">
            <form action="{{ route('imoveis.index') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 items-end">
                    
                    <div class="col-span-1 md:col-span-4 lg:col-span-1">
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2 italic">Buscar Imóvel</label>
                        <input type="text" name="busca" value="{{ request('busca') }}" 
                            placeholder="Nome ou Cidade..." 
                            class="w-full p-4 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-cyan-500 outline-none transition font-medium">
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2 italic">Tipo</label>
                        <select name="tipo" class="w-full p-4 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-cyan-500 outline-none transition font-medium appearance-none">
                            <option value="">Todos os Tipos</option>
                            @foreach($tipos as $tipoOpcao)
                                <option value="{{ $tipoOpcao }}" {{ request('tipo') == $tipoOpcao ? 'selected' : '' }}>
                                    {{ $tipoOpcao }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2 italic">Quartos (Mín)</label>
                        <select name="quartos" class="w-full p-4 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-cyan-500 outline-none transition font-medium appearance-none">
                            <option value="">Qualquer</option>
                            <option value="1" {{ request('quartos') == '1' ? 'selected' : '' }}>1+</option>
                            <option value="2" {{ request('quartos') == '2' ? 'selected' : '' }}>2+</option>
                            <option value="3" {{ request('quartos') == '3' ? 'selected' : '' }}>3+</option>
                            <option value="4" {{ request('quartos') == '4' ? 'selected' : '' }}>4+</option>
                        </select>
                    </div>

                    <div class="flex space-x-4">
                        <div class="w-1/2">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2 italic">R$ Min</label>
                            <input type="number" name="preco_min" value="{{ request('preco_min') }}" placeholder="0" 
                                class="w-full p-4 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-cyan-500 outline-none transition font-medium">
                        </div>
                        <div class="w-1/2">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2 italic">R$ Max</label>
                            <input type="number" name="preco_max" value="{{ request('preco_max') }}" placeholder="Max" 
                                class="w-full p-4 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-cyan-500 outline-none transition font-medium">
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-between items-center border-t border-slate-100 dark:border-slate-800 pt-6">
                    <a href="{{ route('imoveis.index') }}" class="text-xs font-black uppercase tracking-widest text-slate-400 hover:text-red-500 transition">
                        Limpar Filtros
                    </a>
                    <button type="submit" class="bg-cyan-600 dark:bg-cyan-500 hover:bg-cyan-700 dark:hover:bg-cyan-400 text-white dark:text-slate-950 px-10 py-4 rounded-2xl font-black uppercase tracking-widest shadow-xl shadow-cyan-500/20 transition-all duration-300 transform hover:-translate-y-1">
                        Filtrar Imóveis
                    </button>
                </div>
            </form>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($imoveis as $imovel)
                <a href="{{ route('imoveis.show', $imovel->slug) }}"
                    class="block bg-white dark:bg-slate-900 rounded-[2rem] shadow-xl hover:shadow-2xl hover:border-cyan-500/50 transition-all duration-500 overflow-hidden group border border-slate-100 dark:border-slate-800">
                 
                        <div class="relative overflow-hidden aspect-[4/3]">
                            @if($imovel->capa)
                                <img src="{{ asset('storage/' . $imovel->capa->imagem) }}" 
                                    class="w-full h-full object-cover transition duration-700 group-hover:scale-110" 
                                    alt="{{ $imovel->titulo }}">
                            @else
                                <div class="w-full h-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-700">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4 bg-slate-900/90 backdrop-blur-md text-cyan-400 text-[10px] font-black uppercase px-3 py-1.5 rounded-full shadow-2xl border border-slate-700 tracking-[0.2em] italic">
                                {{ ucfirst($imovel->tipo) }}
                            </div>
                        </div>
    
                        <div class="p-6">
                            <h2 class="font-black text-xl text-slate-900 dark:text-white mb-2 truncate uppercase italic tracking-tighter">{{ $imovel->titulo }}</h2>
                            <p class="text-sm text-slate-500 font-medium mb-6 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $imovel->localizacao }}
                            </p>
    
                            <div class="flex justify-between items-center text-sm text-slate-600 dark:text-slate-100 border-t border-slate-50 dark:border-slate-800 pt-6">
                                <span class="font-black italic uppercase tracking-widest text-[10px]">{{ $imovel->quartos }} Quartos</span>
                                <span class="font-black text-cyan-600 dark:text-cyan-400 text-xl tracking-tighter">R$ {{ number_format($imovel->valor, 2, ',', '.') }}</span>
                            </div>
                        </div>
                </a>
            @empty
                <div class="col-span-3 text-center py-20">
                    <p class="text-xl font-bold text-slate-500 uppercase tracking-widest italic">Nenhum imóvel encontrado.</p>
                    <a href="{{ route('imoveis.index') }}" class="text-cyan-600 dark:text-cyan-500 font-black uppercase text-xs mt-4 inline-block hover:underline">Ver todos os imóveis</a>
                </div>
            @endforelse
        </div>

        <div class="mt-16">
            {{ $imoveis->links() }}
        </div>

    </div>

</x-layouts.portal>