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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
</head>

<body class="bg-slate-50 text-slate-900 flex flex-col min-h-screen">

    {{-- Header Classic (Harmonized) --}}
    <header class="bg-white/95 backdrop-blur-md border-b border-slate-200 fixed top-0 left-0 w-full z-50 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
            <a href="{{ route('home') }}" class="flex items-center gap-3 transition hover:scale-105">
                <img src="{{ asset('img/logo/logo.jpeg') }}" alt="Rede Nativos System" class="h-12 w-auto rounded-full border-2 border-cyan-600 shadow-lg">
                <span class="hidden md:block font-black text-xl tracking-tighter text-slate-900 uppercase italic">
                    Rede <span class="text-cyan-600">Nativos</span> System
                </span>
            </a>

            <nav class="hidden lg:flex gap-8 font-semibold text-sm uppercase tracking-widest text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-cyan-600 transition">Home</a>
                <a href="{{ route('sobre') }}" class="hover:text-cyan-600 transition">Sobre</a>
                <a href="{{ route('imoveis.index') }}" class="hover:text-cyan-600 transition">Imóveis</a>
                <a href="{{ route('noticias.index') }}" class="hover:text-cyan-600 transition">Notícias</a>
                <a href="{{ route('contato') }}" class="hover:text-cyan-600 transition">Contato</a>
            </nav>

            <div class="flex items-center gap-4">
                <a href="{{ route('contato') }}" class="bg-cyan-600 text-white px-6 py-2 rounded-full font-black text-xs uppercase tracking-tighter shadow-md hover:bg-cyan-700 transition duration-300">
                    Anuncie Aqui
                </a>
            </div>
        </div>
    </header>

    <main class="pt-24 flex-1">
        {{ $slot }}
    </main>

    {{-- Footer Classic (Harmonized) --}}
    <footer class="bg-white border-t border-slate-200 py-16 mt-20">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-12">
            <div class="col-span-2">
                <img src="{{ asset('img/logo/logo.jpeg') }}" alt="Logo" class="h-20 w-auto rounded-full mb-6 border border-slate-100 shadow-md">
                <p class="text-slate-500 max-w-sm">
                    Líder em tecnologia e informação regional. Rede Nativos System, conectando você ao que há de mais importante.
                </p>
            </div>
            <div>
                <h4 class="text-cyan-600 font-bold uppercase mb-6 tracking-widest">Navegação</h4>
                <ul class="space-y-3 text-sm text-slate-500 font-medium">
                    <li><a href="{{ route('home') }}" class="hover:text-cyan-600 transition italic">Início</a></li>
                    <li><a href="{{ route('noticias.index') }}" class="hover:text-cyan-600 transition italic">Notícias</a></li>
                    <li><a href="{{ route('imoveis.index') }}" class="hover:text-cyan-600 transition italic">Imóveis</a></li>
                    <li><a href="{{ route('sobre') }}" class="hover:text-cyan-600 transition italic">Sobre</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-cyan-600 font-bold uppercase mb-6 tracking-widest">Legal</h4>
                <p class="text-slate-400 text-xs leading-relaxed">
                    © {{ date('Y') }} • Rede Nativos System.<br>
                    Todos os direitos reservados.
                </p>
            </div>
        </div>
    </footer>

</body>

</html>