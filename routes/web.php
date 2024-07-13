<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpeedController;


Route::get('/', [SpeedController::class, 'index'])->name('home');
Route::post('/api/data', [SpeedController::class, 'getApiData'])->name('api.data');
