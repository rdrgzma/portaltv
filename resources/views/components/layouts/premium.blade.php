<!DOCTYPE html>
<html lang="pt-BR" class="dark">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Rede Nativos System' }}</title>
    <meta name="referrer" content="no-referrer">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        navy: {
                            dark: '#0f172a',
                        },
                        cyan: {
                            accent: '#06b6d4',
                        }
                    }
                }
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;900&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>

<body class="bg-slate-950 text-slate-100 flex flex-col min-h-screen" x-data="{ mobileMenu: false }">

    {{-- Header Premium --}}
    <header class="bg-[#0f172a]/95 backdrop-blur-md border-b border-white/5 fixed top-0 left-0 w-full z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
            <a href="{{ route('home') }}" class="flex items-center gap-3 transition hover:scale-105">
                <img src="{{ asset('img/logo/logo.jpeg') }}" alt="Rede Nativos System" class="h-10 md:h-12 w-auto rounded-full border-2 border-[#06b6d4] shadow-[0_0_15px_rgba(6,182,212,0.3)]">
                <span class="hidden sm:block font-black text-lg md:text-xl tracking-tighter text-white uppercase italic">
                    Rede <span class="text-[#06b6d4]">Nativos</span> System
                </span>
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden lg:flex gap-8 font-semibold text-sm uppercase tracking-widest text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-[#06b6d4] transition">Home</a>
                <a href="{{ route('sobre') }}" class="hover:text-[#06b6d4] transition">Sobre</a>
                <a href="{{ route('imoveis.index') }}" class="hover:text-[#06b6d4] transition">Imóveis</a>
                <a href="{{ route('noticias.index') }}" class="hover:text-[#06b6d4] transition">Notícias</a>
                <a href="{{ route('contato') }}" class="hover:text-[#06b6d4] transition">Contato</a>
            </nav>

            <div class="flex items-center gap-4">
                <a href="{{ route('contato') }}" class="hidden sm:block bg-[#06b6d4] text-slate-950 px-6 py-2 rounded-full font-black text-xs uppercase tracking-tighter shadow-[0_0_20px_rgba(6,182,212,0.4)] hover:shadow-[0_0_30px_rgba(6,182,212,0.6)] transition duration-300">
                    Anuncie Aqui
                </a>

                {{-- Mobile Button --}}
                <button @click="mobileMenu = true" class="lg:hidden p-2 text-slate-300 hover:text-white rounded-lg hover:bg-white/5 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    {{-- Mobile Sidebar Menu Premium --}}
    <template x-teleport="body">
        <div x-show="mobileMenu" class="fixed inset-0 z-[100] flex" x-cloak>
            {{-- Overlay --}}
            <div x-show="mobileMenu" 
                 x-transition:enter="transition duration-300 ease-out" 
                 x-transition:enter-start="opacity-0" 
                 x-transition:enter-end="opacity-100" 
                 x-transition:leave="transition duration-200 ease-in" 
                 x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0"
                 @click="mobileMenu = false" 
                 class="fixed inset-0 bg-slate-950/80 backdrop-blur-md"></div>

            {{-- Sidebar --}}
            <div x-show="mobileMenu"
                 x-transition:enter="transition duration-300 ease-out transform" 
                 x-transition:enter-start="translate-x-full" 
                 x-transition:enter-end="translate-x-0" 
                 x-transition:leave="transition duration-200 ease-in transform" 
                 x-transition:leave-start="translate-x-0" 
                 x-transition:leave-end="translate-x-full"
                 class="relative ml-auto w-full max-w-xs h-full bg-[#0f172a] shadow-2xl flex flex-col p-10 border-l border-white/5">
                
                <div class="flex items-center justify-between mb-16">
                    <span class="font-black text-2xl italic uppercase tracking-tighter text-[#06b6d4]">MENU</span>
                    <button @click="mobileMenu = false" class="p-2 text-slate-500 hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <nav class="flex flex-col gap-8 text-xl font-bold uppercase tracking-[0.2em] text-slate-400">
                    <a href="{{ route('home') }}" @click="mobileMenu = false" class="hover:text-white transition">Início</a>
                    <a href="{{ route('sobre') }}" @click="mobileMenu = false" class="hover:text-white transition">Sobre</a>
                    <a href="{{ route('imoveis.index') }}" @click="mobileMenu = false" class="hover:text-white transition">Imóveis</a>
                    <a href="{{ route('noticias.index') }}" @click="mobileMenu = false" class="hover:text-white transition">Notícias</a>
                    <a href="{{ route('contato') }}" @click="mobileMenu = false" class="hover:text-white transition">Contato</a>
                </nav>

                <div class="mt-auto pt-10 border-t border-white/5">
                    <a href="{{ route('contato') }}" class="block w-full text-center bg-[#06b6d4] text-slate-950 py-4 rounded-full font-black uppercase text-sm shadow-[0_0_20px_rgba(6,182,212,0.3)]">
                        Anuncie Aqui
                    </a>
                </div>
            </div>
        </div>
    </template>

    <main class="pt-20 flex-1">
        {{ $slot }}
    </main>

    {{-- Footer Premium --}}
    <footer class="bg-[#0f172a] border-t border-white/5 py-16 mt-20">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-12 text-center md:text-left">
            <div class="col-span-2 flex flex-col items-center md:items-start">
                <img src="{{ asset('img/logo/logo.jpeg') }}" alt="Logo" class="h-20 w-auto rounded-full mb-6 shadow-xl border border-white/5">
                <p class="text-slate-500 max-w-sm">
                    Líder em tecnologia e informação regional. Rede Nativos System, conectando você ao que há de mais importante.
                </p>
            </div>
            <div>
                <h4 class="text-[#06b6d4] font-bold uppercase mb-6 tracking-widest text-sm">Navegação</h4>
                <ul class="space-y-4 text-sm text-slate-500 font-medium italic">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Início</a></li>
                    <li><a href="{{ route('noticias.index') }}" class="hover:text-white transition">Notícias</a></li>
                    <li><a href="{{ route('imoveis.index') }}" class="hover:text-white transition">Imóveis</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-xs text-slate-600 uppercase tracking-widest">© {{ date('Y') }} Rede Nativos</h4>
            </div>
        </div>
    </footer>

</body>
</html>
