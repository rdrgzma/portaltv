<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Rede Nativos System' }}</title>
    {{-- Impede que o G1 bloqueie a exibição da imagem no seu domínio --}}
    <meta name="referrer" content="no-referrer">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
</head>

<body class="bg-slate-50 text-slate-900 flex flex-col min-h-screen" x-data="{ mobileMenu: false }">

    {{-- Header Classic --}}
    <header class="bg-white/95 backdrop-blur-md border-b border-slate-200 fixed top-0 left-0 w-full z-50 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
            <a href="{{ route('home') }}" class="flex items-center gap-3 transition hover:scale-105">
                <img src="{{ asset('img/logo/logo.jpeg') }}" alt="Rede Nativos System" class="h-10 md:h-12 w-auto rounded-full border-2 border-cyan-600 shadow-lg">
                <span class="hidden sm:block font-black text-lg md:text-xl tracking-tighter text-slate-900 uppercase italic">
                    Rede <span class="text-cyan-600">Nativos</span> System
                </span>
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden lg:flex gap-8 font-semibold text-sm uppercase tracking-widest text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-cyan-600 transition">Home</a>
                <a href="{{ route('sobre') }}" class="hover:text-cyan-600 transition">Sobre</a>
                <a href="{{ route('imoveis.index') }}" class="hover:text-cyan-600 transition">Imóveis</a>
                <a href="{{ route('noticias.index') }}" class="hover:text-cyan-600 transition">Notícias</a>
                <a href="{{ route('contato') }}" class="hover:text-cyan-600 transition">Contato</a>
            </nav>

            <div class="flex items-center gap-4">
                <a href="{{ route('contato') }}" class="hidden sm:block bg-cyan-600 text-white px-6 py-2 rounded-full font-black text-xs uppercase tracking-tighter shadow-md hover:bg-cyan-700 transition duration-300">
                    Anuncie Aqui
                </a>

                {{-- Mobile Menu Button --}}
                <button @click="mobileMenu = true" class="lg:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-lg transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    {{-- Mobile Sidebar Menu --}}
    <template x-teleport="body">
        <div x-show="mobileMenu" class="fixed inset-0 z-[100] flex" x-cloak>
            {{-- Overlay --}}
            <div x-show="mobileMenu" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="mobileMenu = false" 
                 class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

            {{-- Sidebar --}}
            <div x-show="mobileMenu"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full"
                 class="relative ml-auto w-full max-w-xs h-full bg-white shadow-2xl flex flex-col p-8">
                
                <div class="flex items-center justify-between mb-12">
                    <span class="font-black text-xl italic uppercase tracking-tighter">Menu</span>
                    <button @click="mobileMenu = false" class="p-2 text-slate-400 hover:text-slate-900 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <nav class="flex flex-col gap-6 text-lg font-bold uppercase tracking-widest text-slate-600">
                    <a href="{{ route('home') }}" @click="mobileMenu = false" class="hover:text-cyan-600 transition">Início</a>
                    <a href="{{ route('sobre') }}" @click="mobileMenu = false" class="hover:text-cyan-600 transition">Sobre</a>
                    <a href="{{ route('imoveis.index') }}" @click="mobileMenu = false" class="hover:text-cyan-600 transition">Imóveis</a>
                    <a href="{{ route('noticias.index') }}" @click="mobileMenu = false" class="hover:text-cyan-600 transition">Notícias</a>
                    <a href="{{ route('contato') }}" @click="mobileMenu = false" class="hover:text-cyan-600 transition">Contato</a>
                </nav>

                <div class="mt-auto border-t border-slate-100 pt-8">
                    <a href="{{ route('contato') }}" class="block w-full text-center bg-cyan-600 text-white py-4 rounded-xl font-black uppercase text-sm shadow-lg shadow-cyan-600/20">
                        Anuncie Aqui
                    </a>
                </div>
            </div>
        </div>
    </template>

    <main class="pt-24 flex-1">
        {{ $slot }}
    </main>

    {{-- Footer Classic --}}
    <footer class="bg-white border-t border-slate-200 py-16 mt-20">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-12 text-center md:text-left">
            <div class="col-span-2 flex flex-col items-center md:items-start">
                <img src="{{ asset('img/logo/logo.jpeg') }}" alt="Logo" class="h-16 w-auto rounded-full mb-6 border border-slate-100 shadow-md">
                <p class="text-slate-500 max-w-sm">
                    Líder em tecnologia e informação regional. Rede Nativos System, conectando você ao que há de mais importante.
                </p>
            </div>
            <div>
                <h4 class="text-cyan-600 font-bold uppercase mb-6 tracking-widest">Navegação</h4>
                <ul class="space-y-3 text-sm text-slate-500 font-medium italic">
                    <li><a href="{{ route('home') }}" class="hover:text-cyan-600 transition">Início</a></li>
                    <li><a href="{{ route('noticias.index') }}" class="hover:text-cyan-600 transition">Notícias</a></li>
                    <li><a href="{{ route('imoveis.index') }}" class="hover:text-cyan-600 transition">Imóveis</a></li>
                    <li><a href="{{ route('sobre') }}" class="hover:text-cyan-600 transition">Sobre</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-cyan-600 font-bold uppercase mb-6 tracking-widest text-xs">© {{ date('Y') }} Rede Nativos</h4>
                <p class="text-slate-400 text-[10px] leading-relaxed">
                    Todos os direitos reservados.
                </p>
            </div>
        </div>
    </footer>

</body>
</html>