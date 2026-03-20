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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;900&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Outfit', sans-serif; }
        .bg-navy-dark { background-color: #0f172a; }
        .text-cyan-accent { color: #06b6d4; }
        .border-cyan-accent { border-color: #06b6d4; }
        .bg-cyan-accent { background-color: #06b6d4; }
    </style>
</head>

<body class="bg-slate-950 text-slate-100 flex flex-col min-h-screen">

    {{-- Header Premium --}}
    <header class="bg-navy-dark/95 backdrop-blur-md border-b border-slate-800 fixed top-0 left-0 w-full z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
            <a href="{{ route('home') }}" class="flex items-center gap-3 transition hover:scale-105">
                <img src="{{ asset('img/logo/logo.jpeg') }}" alt="Rede Nativos System" class="h-12 w-auto rounded-full border-2 border-cyan-accent shadow-[0_0_15px_rgba(6,182,212,0.3)]">
                <span class="hidden md:block font-black text-xl tracking-tighter text-white uppercase italic">
                    Rede <span class="text-cyan-accent">Nativos</span> System
                </span>
            </a>

            <nav class="hidden lg:flex gap-8 font-semibold text-sm uppercase tracking-widest text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-cyan-accent transition">Home</a>
                <a href="{{ route('sobre') }}" class="hover:text-cyan-accent transition">Sobre</a>
                <a href="{{ route('imoveis.index') }}" class="hover:text-cyan-accent transition">Imóveis</a>
                <a href="{{ route('noticias.index') }}" class="hover:text-cyan-accent transition">Notícias</a>
                <a href="{{ route('contato') }}" class="hover:text-cyan-accent transition">Contato</a>
            </nav>

            <div class="flex items-center gap-4">
                <a href="{{ route('contato') }}" class="bg-cyan-accent text-slate-950 px-6 py-2 rounded-full font-black text-xs uppercase tracking-tighter shadow-[0_0_20px_rgba(6,182,212,0.5)] hover:shadow-[0_0_30px_rgba(6,182,212,0.7)] transition duration-300">
                    Anuncie Aqui
                </a>
            </div>
        </div>
    </header>

    <main class="pt-20 flex-1">
        {{ $slot }}
    </main>

    {{-- Footer Premium --}}
    <footer class="bg-navy-dark border-t border-slate-800 py-16 mt-20">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-12">
            <div class="col-span-2">
                <img src="{{ asset('img/logo/logo.jpeg') }}" alt="Logo" class="h-20 w-auto rounded-full mb-6">
                <p class="text-slate-400 max-w-sm">
                    Líder em tecnologia e informação regional. Rede Nativos System, conectando você ao que há de mais importante.
                </p>
            </div>
            <div>
                <h4 class="text-cyan-accent font-bold uppercase mb-6 tracking-widest">Navegação</h4>
                <ul class="space-y-3 text-sm text-slate-500 font-medium">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Início</a></li>
                    <li><a href="{{ route('noticias.index') }}" class="hover:text-white transition">Notícias</a></li>
                    <li><a href="{{ route('imoveis.index') }}" class="hover:text-white transition">Imóveis</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-cyan-accent font-bold uppercase mb-6 tracking-widest">Legal</h4>
                <p class="text-slate-600 text-xs leading-relaxed">
                    © {{ date('Y') }} • Rede Nativos System.<br>
                    Todos os direitos reservados.
                </p>
            </div>
        </div>
    </footer>

</body>

</html>
