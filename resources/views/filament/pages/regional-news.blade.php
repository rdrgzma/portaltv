<x-filament-panels::page>
    {{-- Filtro de Região --}}
    <div class="p-6 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl shadow-sm">
        {{ $this->form }}
    </div>

    {{-- Lista de Notícias --}}
    <div class="mt-8">
        @if ($news && $news->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($news as $item)
                    @php
                        $detailUrl  = url('/admin/regional-news-show') . '?' . http_build_query(['state' => $item['state'], 'id' => $item['id']]);
                        $dbItem     = $saved[$item['id']] ?? null;
                        $isDestaque = $dbItem?->destaque ?? false;
                        $isPublic   = $dbItem?->publicado ?? false;
                    @endphp
                    <article class="flex flex-col bg-white dark:bg-gray-900 rounded-3xl overflow-hidden border border-gray-100 dark:border-gray-800 shadow-[0_4px_20px_-1px_rgba(0,0,0,0.1)] hover:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.15)] transition-all duration-500 hover:-translate-y-2 group cursor-pointer">

                        {{-- Badges de estado no topo do card --}}
                        @if ($isDestaque || $isPublic)
                        <div class="flex gap-2 px-4 pt-3">
                            @if ($isDestaque)
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300">
                                    ⭐ Destaque
                                </span>
                            @endif
                            @if ($isPublic)
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300">
                                    ✅ Publicado
                                </span>
                            @endif
                        </div>
                        @endif

                        {{-- Imagem --}}
                        <a href="{{ $detailUrl }}" class="block relative h-60 overflow-hidden {{ ($isDestaque || $isPublic) ? 'mt-2' : '' }}">
                            @if ($item['image'])
                                <img
                                    src="{{ $item['image'] }}"
                                    alt="{{ $item['title'] }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-gray-300 dark:text-gray-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </a>

                        {{-- Conteúdo --}}
                        <div class="flex-1 flex flex-col p-6">
                            <div class="flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-primary-600 dark:text-primary-400 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                                    <path fill-rule="evenodd" d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z" clip-rule="evenodd" />
                                </svg>
                                {{ $item['date'] }}
                            </div>

                            <h3 class="flex-1 text-xl font-extrabold leading-tight text-gray-900 dark:text-white mb-4 line-clamp-3 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors duration-300">
                                <a href="{{ $detailUrl }}" class="block">
                                    {{ $item['title'] }}
                                </a>
                            </h3>

                            <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-3 mb-5 leading-relaxed">
                                {{ $item['description'] }}
                            </p>

                            {{-- Toggles: Destaque + Publicar --}}
                            <div class="flex gap-2 mb-5">
                                <button
                                    wire:click="toggleDestaque('{{ $item['id'] }}', '{{ $item['state'] }}')"
                                    wire:loading.attr="disabled"
                                    class="flex-1 inline-flex items-center justify-center gap-1.5 py-2 px-3 text-xs font-bold rounded-xl border-2 transition-all duration-200
                                        {{ $isDestaque
                                            ? 'bg-amber-50 border-amber-400 text-amber-700 dark:bg-amber-900/30 dark:border-amber-500 dark:text-amber-300'
                                            : 'bg-white border-gray-200 text-gray-500 hover:border-amber-400 hover:text-amber-600 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:border-amber-500' }}"
                                    title="{{ $isDestaque ? 'Remover destaque' : 'Destacar notícia' }}"
                                >
                                    <span>⭐</span>
                                    {{ $isDestaque ? 'Destacado' : 'Destacar' }}
                                </button>

                                <button
                                    wire:click="togglePublicado('{{ $item['id'] }}', '{{ $item['state'] }}')"
                                    wire:loading.attr="disabled"
                                    class="flex-1 inline-flex items-center justify-center gap-1.5 py-2 px-3 text-xs font-bold rounded-xl border-2 transition-all duration-200
                                        {{ $isPublic
                                            ? 'bg-emerald-50 border-emerald-400 text-emerald-700 dark:bg-emerald-900/30 dark:border-emerald-500 dark:text-emerald-300'
                                            : 'bg-white border-gray-200 text-gray-500 hover:border-emerald-400 hover:text-emerald-600 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:border-emerald-500' }}"
                                    title="{{ $isPublic ? 'Despublicar' : 'Publicar no site' }}"
                                >
                                    <span>{{ $isPublic ? '✅' : '📢' }}</span>
                                    {{ $isPublic ? 'Publicado' : 'Publicar' }}
                                </button>
                            </div>

                            {{-- Botões de navegação --}}
                            <div class="mt-auto flex items-center justify-between gap-3">
                                <a
                                    href="{{ $detailUrl }}"
                                    class="inline-flex items-center gap-2 py-2.5 px-5 text-sm font-bold text-white bg-primary-600 hover:bg-primary-700 rounded-full shadow-lg shadow-primary-500/30 transition-all duration-300 hover:scale-105 active:scale-95"
                                >
                                    Ver Detalhes
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                        <path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 5.29a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.96H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a
                                    href="{{ $item['link'] }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center gap-1 text-xs text-gray-400 hover:text-primary-500 transition-colors"
                                    title="Abrir notícia original"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                                        <path fill-rule="evenodd" d="M4.25 5.5a.75.75 0 0 0-.75.75v8.5c0 .414.336.75.75.75h8.5a.75.75 0 0 0 .75-.75v-4a.75.75 0 0 1 1.5 0v4A2.25 2.25 0 0 1 12.75 17h-8.5A2.25 2.25 0 0 1 2 14.75v-8.5A2.25 2.25 0 0 1 4.25 4h5a.75.75 0 0 1 0 1.5h-5Z" clip-rule="evenodd" />
                                        <path fill-rule="evenodd" d="M6.194 12.753a.75.75 0 0 0 1.06.053L16.5 4.44v2.81a.75.75 0 0 0 1.5 0v-4.5a.75.75 0 0 0-.75-.75h-4.5a.75.75 0 0 0 0 1.5h2.553l-9.056 8.194a.75.75 0 0 0-.053 1.06Z" clip-rule="evenodd" />
                                    </svg>
                                    Original
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Paginação --}}
            <div class="mt-12">
                {{ $news->links() }}
            </div>

        @else
            {{-- Estado Vazio --}}
            <div class="relative bg-white dark:bg-gray-900 rounded-3xl p-20 overflow-hidden border border-gray-100 dark:border-gray-800 shadow-xl">
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-primary-500/5 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 bg-primary-500/5 rounded-full blur-3xl"></div>

                <div class="relative flex flex-col items-center max-w-sm mx-auto text-center">
                    <div class="flex items-center justify-center w-24 h-24 bg-primary-50 dark:bg-primary-900/30 rounded-full mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-primary-500 dark:text-primary-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                        </svg>
                    </div>

                    <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-3 tracking-tight">
                        Sem notícias hoje
                    </h2>
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed">
                        Ainda não há atualizações para esta região hoje. Tente novamente mais tarde ou selecione outra região.
                    </p>
                </div>
            </div>
        @endif
    </div>

    @push('styles')
    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    @endpush
</x-filament-panels::page>
