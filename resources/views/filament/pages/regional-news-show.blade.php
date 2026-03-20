<x-filament-panels::page>
    @if (isset($article))
        {{-- Botão Voltar --}}
        <div class="mb-6">
            <a
                href="{{ url()->previous() }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-200"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd" d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z" clip-rule="evenodd" />
                </svg>
                Voltar para Notícias de {{ $article['state_name'] }}
            </a>
        </div>

        <article class="max-w-4xl mx-auto">

            {{-- Hero Image --}}
            @if ($article['image'])
                <div class="relative rounded-3xl overflow-hidden mb-8 shadow-2xl aspect-video">
                    <img
                        src="{{ $article['image'] }}"
                        alt="{{ $article['title'] }}"
                        class="w-full h-full object-cover"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                </div>
            @endif

            {{-- Metadata strip --}}
            <div class="flex flex-wrap items-center gap-4 mb-6">
                {{-- Fonte --}}
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-primary-100 dark:bg-primary-900/40 text-primary-700 dark:text-primary-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                        <path d="M3.75 3A1.75 1.75 0 0 0 2 4.75v3.26a3.235 3.235 0 0 1 1.75-.51h12.5c.644 0 1.245.188 1.75.51V6.75A1.75 1.75 0 0 0 16.25 5h-4.836a.25.25 0 0 1-.177-.073L9.823 3.513A1.75 1.75 0 0 0 8.586 3H3.75ZM3.75 9A1.75 1.75 0 0 0 2 10.75v4.5c0 .966.784 1.75 1.75 1.75h12.5A1.75 1.75 0 0 0 18 15.25v-4.5A1.75 1.75 0 0 0 16.25 9H3.75Z" />
                    </svg>
                    {{ $article['source'] }}
                </span>

                {{-- Estado --}}
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                        <path fill-rule="evenodd" d="m9.69 18.933.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 0 0 .281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 1 0 3 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 0 0 2.273 1.765 11.842 11.842 0 0 0 .818.425l.028.013.006.003ZM10 11.25a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5Z" clip-rule="evenodd" />
                    </svg>
                    {{ $article['state_name'] }}
                </span>

                {{-- Data --}}
                <span class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z" clip-rule="evenodd" />
                    </svg>
                    Publicado em {{ $article['date'] }}
                </span>

                {{-- Autor --}}
                @if ($article['author'])
                    <span class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 0 0-13.074.003Z" />
                        </svg>
                        {{ $article['author'] }}
                    </span>
                @endif
            </div>

            {{-- Título --}}
            <h1 class="text-3xl md:text-4xl font-black text-gray-900 dark:text-white leading-tight mb-6 tracking-tight">
                {{ $article['title'] }}
            </h1>

            {{-- Divisor --}}
            <div class="h-1 w-20 rounded-full bg-primary-500 mb-8"></div>

            {{-- Conteúdo --}}
            <div class="prose prose-lg dark:prose-invert max-w-none mb-10">
                @if ($article['full_content'] && $article['full_content'] !== $article['description'])
                    <p class="text-lg text-gray-700 dark:text-gray-300 font-medium leading-relaxed mb-6">
                        {{ $article['description'] }}
                    </p>
                    <div class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">
                        {{ $article['full_content'] }}
                    </div>
                @else
                    <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
                        {{ $article['description'] }}
                    </p>
                @endif
            </div>

            {{-- CTA - Link para notícia original --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 p-6 rounded-2xl bg-gray-50 dark:bg-gray-800/60 border border-gray-200 dark:border-gray-700">
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                        Leia a matéria completa na fonte original
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Publicada por <strong>{{ $article['source'] }}</strong>
                    </p>
                </div>
                <a
                    href="{{ $article['link'] }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-6 py-3 text-sm font-bold text-white bg-primary-600 hover:bg-primary-700 rounded-xl shadow-lg shadow-primary-500/30 transition-all duration-300 hover:scale-105 active:scale-95 whitespace-nowrap"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M4.25 5.5a.75.75 0 0 0-.75.75v8.5c0 .414.336.75.75.75h8.5a.75.75 0 0 0 .75-.75v-4a.75.75 0 0 1 1.5 0v4A2.25 2.25 0 0 1 12.75 17h-8.5A2.25 2.25 0 0 1 2 14.75v-8.5A2.25 2.25 0 0 1 4.25 4h5a.75.75 0 0 1 0 1.5h-5Z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M6.194 12.753a.75.75 0 0 0 1.06.053L16.5 4.44v2.81a.75.75 0 0 0 1.5 0v-4.5a.75.75 0 0 0-.75-.75h-4.5a.75.75 0 0 0 0 1.5h2.553l-9.056 8.194a.75.75 0 0 0-.053 1.06Z" clip-rule="evenodd" />
                    </svg>
                    Acessar Notícia Original
                </a>
            </div>

        </article>
    @endif
</x-filament-panels::page>
