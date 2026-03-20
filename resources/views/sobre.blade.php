<x-layouts.portal title="Sobre • Rede Nativos System">

    <div class="max-w-5xl mx-auto px-6 pt-10 pb-20">

        <h1 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white leading-tight mb-8 tracking-tighter uppercase italic text-center">
            Sobre <span class="text-cyan-600 dark:text-cyan-500">Nós</span>
        </h1>

        <div class="relative rounded-3xl overflow-hidden shadow-2xl mb-12 border border-slate-200 dark:border-slate-800 group h-[300px] md:h-[350px]">
            <img src="{{ asset('img/sobre_nos.png') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-105" alt="Rede Nativos System - Sobre Nós">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/30 to-transparent flex flex-col justify-end p-10">
                <h2 class="text-3xl md:text-6xl font-black text-white uppercase italic tracking-tighter drop-shadow-2xl">
                    Rede <span class="text-cyan-500">Nativos</span> System
                </h2>
                <div class="h-1.5 w-32 bg-cyan-500 mt-2 rounded-full shadow-[0_0_15px_rgba(6,182,212,0.8)]"></div>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-12">
            <div class="md:col-span-2">
                <p class="text-xl leading-relaxed mb-8 text-slate-700 dark:text-slate-100 font-medium">
                    Somos a <span class="text-slate-900 dark:text-white font-black italic uppercase">Rede Nativos System</span>, uma plataforma de mídia regional focada no Nordeste brasileiro. Nossa missão é integrar informação, entretenimento e tecnologia para conectar pessoas e negócios.
                </p>

                <div class="space-y-8">
                    <section>
                        <h2 class="text-2xl font-black text-cyan-600 dark:text-cyan-500 uppercase tracking-widest mb-4 italic">Nossa Missão</h2>
                        <p class="text-slate-600 dark:text-slate-200 leading-relaxed">
                            Conectar pessoas, marcas e negócios por meio de uma WebTV inovadora, fundamentada em notícias regionais de qualidade e oportunidades imobiliárias sólidas.
                        </p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-black text-cyan-600 dark:text-cyan-500 uppercase tracking-widest mb-4 italic">Nossa Visão</h2>
                        <p class="text-slate-600 dark:text-slate-200 leading-relaxed">
                            Ser a maior referência regional em mídia digital e WebTV multi-plataforma, transformando a maneira como o Nordeste consome conteúdo digital.
                        </p>
                    </section>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 p-8 rounded-3xl h-fit shadow-xl">
                <h2 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-widest mb-6 italic border-b border-slate-100 dark:border-slate-800 pb-4">Nossos Valores</h2>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <span class="text-cyan-600 dark:text-cyan-500 font-bold mt-1 text-xs">◆</span>
                        <span class="text-slate-700 dark:text-slate-100 font-medium">Transparência Absoluta</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-cyan-600 dark:text-cyan-500 font-bold mt-1 text-xs">◆</span>
                        <span class="text-slate-700 dark:text-slate-100 font-medium">Inovação Tecnológica</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-cyan-600 dark:text-cyan-500 font-bold mt-1 text-xs">◆</span>
                        <span class="text-slate-700 dark:text-slate-100 font-medium">Responsabilidade Regional</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-cyan-600 dark:text-cyan-500 font-bold mt-1 text-xs">◆</span>
                        <span class="text-slate-700 dark:text-slate-100 font-medium">Compromisso com a Verdade</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>

</x-layouts.portal>