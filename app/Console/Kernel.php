<?php

namespace App\Console;

use App\Services\WebTV\WebTVService;
use Illuminate\Console\Scheduling\Schedule;

protected function schedule(Schedule $schedule): void
{
    $schedule->call(function () {
        app(WebTVService::class)->handleScheduler();
    })->everyMinute();
}
