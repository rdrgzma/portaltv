<?php

use App\Http\Controllers\Api\PlayerController;
use Illuminate\Support\Facades\Route;

Route::get('/webtv/current', [PlayerController::class, 'current']);
