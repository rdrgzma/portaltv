<x-layouts.portal :title="$imovel->titulo">
    <div class="max-w-6xl mx-auto px-6">

        <h1 class="text-4xl font-bold mb-6">{{ $imovel->titulo }}</h1>

        <div class="grid md:grid-cols-2 gap-6">
            @foreach ($imovel->imagens as $imagem)
                <img src="{{ asset('storage/' . $imagem->imagem) }}" class="rounded-xl shadow"> 
                
            @endforeach
                
        </div>
        <section class="mt-10">
            <h2 class="text-2xl font-bold mb-3">Descrição</h2>
            <p>{{ $imovel->descricao }}</p>
        </section>
        <section class="mt-10">
            <h2 class="text-2xl font-bold mb-3">Detalhes</h2>
            <ul class="list-disc list-inside">
                <li><strong>Tipo:</strong> {{ $imovel->tipo }}</li>
                <li><strong>Quartos:</strong> {{ $imovel->quartos }}</li>
                <li><strong>Banheiros:</strong> {{ $imovel->banheiros }}</li>
                <li><strong>Garagens:</strong> {{ $imovel->garagem }}</li>
                <li><strong>Localização:</strong> {{ $imovel->localizacao }}</li>
                <li><strong>Preço:</strong> R$ {{ number_format($imovel->preco, 2, ',', '.') }}</li>
            </ul>

        <section class="mt-10 text-center">
            <a href="https://wa.me/55SEUNUMERO" class="bg-green-600 text-white px-10 py-4 rounded-xl">
                Falar no WhatsApp
            </a>
        </section>

    </div>
</x-layouts.portal>