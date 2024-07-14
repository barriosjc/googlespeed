<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpeedController;


Route::get('/', [SpeedController::class, 'index'])->name('obtener.metricas');
Route::post('/api/data', [SpeedController::class, 'getApiData'])->name('api.data');
Route::post('/metrics/save', [SpeedController::class, 'metrics_save'])->name('metrics.save');
Route::get('/listado/filtro', [SpeedController::class, 'list_filtro'])->name('listados.filtro');
Route::post('/listado/generar', [SpeedController::class, 'list_generar'])->name('listados.generar');