<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Services\WebTV\WebTVService;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// ADICIONE ESTE BLOCO:
Schedule::call(function (WebTVService $service) {
    $service->handleScheduler();
})->everyMinute();