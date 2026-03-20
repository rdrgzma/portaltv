<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Rede Nativos System' }}</title>
    {{-- Impede que o G1 bloqueie a exibição da imagem no seu domínio --}}
    <meta name="referrer" content="no-referrer">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
</head>

<body class="bg-neutral-100 text-neutral-800">

    <header class="bg-white shadow-sm fixed top-0 left-0 w-full z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('img/logo/logo.jpeg') }}" alt="Rede Nativos System Logo" class="h-12 w-auto object-contain">
            </a>

            <nav class="hidden md:flex gap-6 font-medium">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('sobre') }}">Sobre</a>
                <a href="{{ route('imoveis.index') }}">Imóveis</a>
                <a href="{{ route('noticias.index') }}">Notícias</a>
                <a href="{{ route('contato') }}">Contato</a>
            </nav>

            <a href="{{ route('contato') }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg">
                Anuncie Aqui
            </a>
        </div>
    </header>

    <main class="pt-24">
        {{ $slot }}
    </main>

    <footer class="bg-neutral-900 text-white py-12 mt-20">
        <div class="max-w-7xl mx-auto px-6 flex flex-col items-center justify-center gap-6">
            <img src="{{ asset('img/logo/logo.jpeg') }}" alt="Rede Nativos System" class="h-16 w-auto object-contain shadow-2xl rounded-full">
            <p class="text-neutral-400 font-medium">© {{ date('Y') }} • Rede Nativos System</p>
        </div>
    </footer>

</body>

</html>