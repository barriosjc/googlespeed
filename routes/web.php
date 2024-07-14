<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MetricsController;


Route::get('/', [MetricsController::class, 'index'])->name('obtener.metricas');
Route::post('/api/data', [MetricsController::class, 'getApiData'])->name('api.data');
Route::post('/metrics/save', [MetricsController::class, 'metrics_save'])->name('metrics.save');
Route::get('/listado/filtro', [MetricsController::class, 'list_filtro'])->name('listados.filtro');
Route::get('/listado/generar', [MetricsController::class, 'list_generar'])->name('listados.generar');