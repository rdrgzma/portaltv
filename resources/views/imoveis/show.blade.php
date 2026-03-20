<x-layouts.portal :title="$imovel->titulo">
    <div class="max-w-6xl mx-auto px-6 pt-10 pb-20">
        @php
            $whatsapp = \App\Models\Setting::getValue('contact_whatsapp', '(00) 00000-0000');
            $pure_whatsapp = preg_replace('/\D/', '', $whatsapp);
        @endphp

        <h1 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white leading-tight mb-12 tracking-tighter uppercase italic">
            {{ $imovel->titulo }}
        </h1>

        <div class="grid md:grid-cols-2 gap-8 mb-16">
            @foreach ($imovel->imagens as $imagem)
                <div class="relative rounded-3xl overflow-hidden shadow-xl border border-slate-200 dark:border-slate-800">
                    <img src="{{ asset('storage/' . $imagem->imagem) }}" class="w-full h-auto object-cover hover:scale-105 transition duration-700" alt="{{ $imovel->titulo }}"> 
                </div>
            @endforeach
        </div>

        <div class="grid lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2 space-y-12">
                <section>
                    <h2 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tighter mb-4 italic border-l-4 border-cyan-500 pl-4">Descrição</h2>
                    <p class="text-slate-600 dark:text-slate-100 text-lg leading-relaxed">{{ $imovel->descricao }}</p>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tighter mb-6 italic border-l-4 border-cyan-500 pl-4">Especificações</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                        <div class="bg-white dark:bg-slate-900 p-4 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
                            <span class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Tipo</span>
                            <span class="text-slate-900 dark:text-slate-100 font-bold">{{ ucfirst($imovel->tipo) }}</span>
                        </div>
                        <div class="bg-white dark:bg-slate-900 p-4 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
                            <span class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Quartos</span>
                            <span class="text-slate-900 dark:text-slate-100 font-bold">{{ $imovel->quartos }}</span>
                        </div>
                        <div class="bg-white dark:bg-slate-900 p-4 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
                            <span class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Banheiros</span>
                            <span class="text-slate-900 dark:text-slate-100 font-bold">{{ $imovel->banheiros }}</span>
                        </div>
                        <div class="bg-white dark:bg-slate-900 p-4 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
                            <span class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Garagens</span>
                            <span class="text-slate-900 dark:text-slate-100 font-bold">{{ $imovel->garagem }}</span>
                        </div>
                        <div class="bg-white dark:bg-slate-900 p-4 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm col-span-2">
                            <span class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Localização</span>
                            <span class="text-slate-900 dark:text-slate-100 font-bold">{{ $imovel->localizacao }}</span>
                        </div>
                    </div>
                </section>
            </div>

            <div class="space-y-6">
                {{-- Card de Investimento (Destaque) --}}
                <div class="bg-slate-950 dark:bg-white p-8 rounded-[2rem] shadow-2xl text-center border-4 border-cyan-500/20">
                    <span class="block text-cyan-500 dark:text-cyan-600 text-xs font-black uppercase tracking-[0.3em] mb-3">Valor do Investimento</span>
                    <h3 class="text-white dark:text-slate-900 text-4xl font-black italic tracking-tighter mb-8 leading-none">
                        R$ {{ number_format($imovel->valor, 2, ',', '.') }}
                    </h3>
                    
                    <a href="https://wa.me/{{ $pure_whatsapp }}?text=Olá! Tenho interesse no imóvel: {{ $imovel->titulo }}" 
                       target="_blank"
                       class="inline-flex items-center justify-center gap-3 bg-cyan-600 dark:bg-cyan-500 hover:bg-cyan-700 dark:hover:bg-cyan-400 text-white dark:text-slate-950 w-full py-5 rounded-2xl font-black uppercase tracking-widest shadow-xl shadow-cyan-500/40 transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        Tenho Interesse
                    </a>
                </div>
            </div>
        </div>

    </div>
</x-layouts.portal>