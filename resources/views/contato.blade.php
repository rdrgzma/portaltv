<x-layouts.portal title="Contato • Rede Nativos System">
    <div class="max-w-6xl mx-auto px-6 pt-10 pb-20">
        @php
            $whatsapp = \App\Models\Setting::getValue('contact_whatsapp', '(00) 00000-0000');
            $pure_whatsapp = preg_replace('/\D/', '', $whatsapp);
            $email = \App\Models\Setting::getValue('contact_email', 'contato@redenativossystem.com.br');
        @endphp

        <h1 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white leading-tight mb-12 tracking-tighter uppercase italic text-center">
            Fale <span class="text-cyan-600 dark:text-cyan-500">Conosco</span>
        </h1>

        <div class="grid lg:grid-cols-2 gap-16">

            {{-- FORMULÁRIO --}}
            <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-800">
                <h2 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tighter mb-8 italic">Envie sua <span class="text-cyan-600 dark:text-cyan-500">Mensagem</span></h2>
                
                <form class="space-y-6">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Nome Completo</label>
                        <input type="text" placeholder="Seu nome" class="w-full p-4 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-cyan-500 outline-none transition">
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">E-mail</label>
                            <input type="email" placeholder="seu@email.com" class="w-full p-4 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-cyan-500 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Telefone</label>
                            <input type="text" placeholder="(00) 00000-0000" class="w-full p-4 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-cyan-500 outline-none transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Mensagem</label>
                        <textarea placeholder="Como podemos ajudar?" rows="5" class="w-full p-4 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-cyan-500 outline-none transition"></textarea>
                    </div>

                    <button type="submit" class="bg-cyan-600 dark:bg-cyan-500 hover:bg-cyan-700 dark:hover:bg-cyan-400 text-white dark:text-slate-950 w-full py-4 rounded-2xl font-black uppercase tracking-widest shadow-lg shadow-cyan-500/20 transition-all duration-300 transform hover:-translate-y-1">
                        Enviar Mensagem
                    </button>
                </form>
            </div>

            {{-- INFORMAÇÕES --}}
            <div class="flex flex-col justify-center">
                <h2 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tighter mb-8 italic">Canais de <span class="text-cyan-600 dark:text-cyan-500">Atendimento</span></h2>

                <div class="space-y-8 mb-10">
                    <a href="https://wa.me/{{ $pure_whatsapp }}" target="_blank" class="flex items-start gap-4 group">
                        <div class="p-3 rounded-2xl bg-cyan-100 dark:bg-cyan-500/10 text-cyan-600 dark:text-cyan-500 transition-colors group-hover:bg-cyan-500 group-hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-black text-slate-900 dark:text-white uppercase tracking-widest text-xs mb-1">WhatsApp / Telefone</h4>
                            <p class="text-slate-600 dark:text-slate-100 font-medium">{{ $whatsapp }}</p>
                        </div>
                    </a>

                    <a href="mailto:{{ $email }}" class="flex items-start gap-4 group">
                        <div class="p-3 rounded-2xl bg-cyan-100 dark:bg-cyan-500/10 text-cyan-600 dark:text-cyan-500 transition-colors group-hover:bg-cyan-500 group-hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-black text-slate-900 dark:text-white uppercase tracking-widest text-xs mb-1">E-mail Oficial</h4>
                            <p class="text-slate-600 dark:text-slate-100 font-medium">{{ $email }}</p>
                        </div>
                    </a>
                </div>

                <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-800 h-64">
                    <iframe src="https://maps.google.com/maps?q=Recife&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        class="w-full h-full grayscale hover:grayscale-0 transition-all duration-700" loading="lazy">
                    </iframe>
                    <div class="absolute inset-0 pointer-events-none border-2 border-cyan-500/20 rounded-3xl"></div>
                </div>
            </div>

        </div>

    </div>

</x-layouts.portal>