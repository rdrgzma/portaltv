<x-layouts.portal title="Contato • Portal WebTV">

    <div class="max-w-5xl mx-auto px-6 pt-10">

        <h1 class="text-4xl font-bold mb-6 text-center">
            Fale Conosco
        </h1>

        <div class="grid md:grid-cols-2 gap-10">

            {{-- FORMULÁRIO --}}
            <form class="bg-white p-6 rounded-xl shadow space-y-4">
                <input type="text" placeholder="Nome" class="w-full p-3 rounded-lg border">

                <input type="email" placeholder="E-mail" class="w-full p-3 rounded-lg border">

                <input type="text" placeholder="Telefone" class="w-full p-3 rounded-lg border">

                <textarea placeholder="Mensagem" rows="5" class="w-full p-3 rounded-lg border"></textarea>

                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white w-full py-3 rounded-xl">
                    Enviar Mensagem
                </button>
            </form>

            {{-- INFORMAÇÕES --}}
            <div>
                <h2 class="text-2xl font-bold mb-4">Informações</h2>

                <p class="mb-2">
                    <strong>WhatsApp:</strong> (51) 99999-9999
                </p>
                <p class="mb-2">
                    <strong>Email:</strong> contato@portalwebtv.com
                </p>
                <p class="mb-4">
                    <strong>Endereço:</strong> Rua Exemplo, 123 — Centro
                </p>

                <iframe src="https://maps.google.com/maps?q=Porto%20Alegre&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    class="w-full h-64 rounded-xl shadow" loading="lazy">
                </iframe>
            </div>

        </div>

    </div>

</x-layouts.portal>