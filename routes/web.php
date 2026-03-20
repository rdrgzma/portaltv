<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\ImovelController;
use App\Services\WebTV\WebTVService;
use Illuminate\Support\Facades\Route;

use App\Models\Programacao;
use Carbon\Carbon;


Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/sobre', fn() => view('sobre'))->name('sobre');
Route::get('/contato', fn() => view('contato'))->name('contato');

Route::get('/noticias', [NoticiaController::class,'index'])->name('noticias.index');
Route::get('/noticias/{slug}', [NoticiaController::class,'show'])->name('noticias.show');

Route::get('/imoveis', [ImovelController::class,'index'])->name('imoveis.index');
Route::get('/imoveis/{slug}', [ImovelController::class,'show'])->name('imoveis.show');

Route::get('/api/webtv/now', function (WebTVService $service) {
    $programacao = $service->getCurrentProgramacao();

    if (!$programacao) {
        return response()->json(['status' => 'offline']);
    }

    // Calcula exatamente onde o vídeo deveria estar (em segundos)
    $inicio = \Carbon\Carbon::parse($programacao->inicio);
    $agora = now();
    $seekSeconds = $agora->diffInSeconds($inicio);

    return response()->json([
        'status' => 'online',
        'video_id' => $programacao->video->youtube_video_id,
        'titulo' => $programacao->video->titulo,
        'seek_seconds' => $seekSeconds, // Ponto exato onde a TV está
    ]);
});

Route::get('/debug-tv', function () {
    $now = Carbon::now();
    
    // Busca qualquer programação que DEVERIA estar no ar agora
    $prog = Programacao::where('inicio', '<=', $now)
        ->where('fim', '>=', $now)
        ->first();

    return [
        'hora_servidor_atual' => $now->format('Y-m-d H:i:s'),
        'timezone_config' => config('app.timezone'),
        'timezone_banco' => config('database.connections.mysql.timezone') ?? 'padrao',
        'existe_programacao_agora?' => $prog ? 'SIM' : 'NÃO',
        'detalhes_programacao' => $prog,
        'proximas_programacoes' => Programacao::where('inicio', '>', $now)->take(3)->get()
    ];
});

// Adicione isto no routes/web.php temporariamente
Route::get('/testar-cron', function () {
    // Tenta rodar o agendador manualmente
    $exitCode = \Illuminate\Support\Facades\Artisan::call('schedule:run');
    return 'Comando rodou! Código de saída: ' . $exitCode . ' (Verifique o output no laravel.log se houver erros)';
});