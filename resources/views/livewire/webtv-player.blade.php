<div class="absolute inset-0 bg-black overflow-hidden rounded-2xl" 
     wire:poll.10s="checkProgramacao">
    
    @if($videoUrl)
        {{-- 
            Usamos wire:key com o ID do vídeo para garantir que o Livewire 
            só recrie o iframe quando o vídeo realmente mudar.
        --}}
        <iframe 
            wire:key="video-{{ $currentVideoId }}"
            class="w-full h-full object-cover"
            src="{{ $videoUrl }}" 
            title="{{ $titulo }}"
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
            referrerpolicy="strict-origin-when-cross-origin"
            allowfullscreen>
        </iframe>

        {{-- Barra de título (Opcional) --}}
        <div class="absolute top-0 left-0 w-full p-4 bg-gradient-to-b from-black/80 to-transparent pointer-events-none opacity-0 hover:opacity-100 transition-opacity duration-300">
            <h3 class="text-white font-bold text-sm drop-shadow-md">
                <span class="text-red-500 mr-2">● AO VIVO</span> {{ $titulo }}
            </h3>
        </div>
    @else
        {{-- Tela de espera quando não há nada na grade --}}
        <div class="w-full h-full flex flex-col items-center justify-center text-white bg-slate-900">
            <div class="animate-pulse flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mb-4 opacity-50">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.15c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
                <span class="text-xl font-bold">Fora do Ar</span>
                <span class="text-sm text-gray-400 mt-2">Aguardando programação...</span>
            </div>
        </div>
    @endif
</div>

<script>
    var player;
    var currentVideoId = null;
    var checkInterval;

    // 1. Carrega a API do YouTube Assincronamente
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // 2. Função chamada quando a API está pronta
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('tv-player', {
            height: '100%',
            width: '100%',
            playerVars: {
                'playsinline': 1,
                'controls': 0,     // Esconde controles
                'disablekb': 1,    // Desativa teclado
                'fs': 0,           // Desativa fullscreen nativo
                'rel': 0,          // Sem vídeos relacionados
                'modestbranding': 1,
                'mute': 1,          // Começa mudo para permitir autoplay
                'autoplay': 1,
                'origin': window.location.origin
            },
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerReady(event) {
        // Assim que o player nasce, pergunta ao servidor o que tocar
        syncTV();
        // E continua perguntando a cada 5 segundos
        checkInterval = setInterval(syncTV, 5000);
    }

    function onPlayerStateChange(event) {
        // Se o vídeo acabar, força o sync imediato para o próximo
        if (event.data === YT.PlayerState.ENDED) {
            syncTV();
        }
    }

    // 3. O Cérebro da Operação
    function syncTV() {
        fetch('/api/webtv/now')
            .then(response => response.json())
            .then(data => {
                const offlineScreen = document.getElementById('offline-screen');

                if (data.status === 'offline') {
                    // Mostra tela de fora do ar
                    if (currentVideoId !== 'OFFLINE') {
                        player.stopVideo();
                        offlineScreen.classList.remove('hidden');
                        offlineScreen.classList.add('flex');
                        currentVideoId = 'OFFLINE';
                    }
                    return;
                }

                // Estamos ONLINE, esconde a tela preta
                offlineScreen.classList.add('hidden');
                offlineScreen.classList.remove('flex');

                // Lógica de Troca de Vídeo
                if (currentVideoId !== data.video_id) {
                    console.log('Trocando canal para:', data.titulo);
                    currentVideoId = data.video_id;
                    
                    // Carrega o novo vídeo já no segundo certo (seek_seconds)
                    player.loadVideoById({
                        'videoId': data.video_id,
                        'startSeconds': data.seek_seconds
                    });
                } else {
                    // Vídeo é o mesmo, vamos verificar apenas se a sincronia desviou muito
                    // (Ex: usuário pausou a net caiu e voltou)
                    let playerTime = player.getCurrentTime();
                    let serverTime = data.seek_seconds;
                    let diff = Math.abs(playerTime - serverTime);

                    // Se a diferença for maior que 5 segundos, resincroniza
                    if (diff > 5) {
                        console.log('Ressincronizando tempo...');
                        player.seekTo(serverTime, true);
                    }
                }
            })
            .catch(err => console.error('Erro na TV:', err));
    }
</script>