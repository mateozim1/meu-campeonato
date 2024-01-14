<?php

use App\Http\Controllers\CampeonatoController;
use App\Http\Controllers\TimeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('time')->group(function () {
    Route::get('/getAll', [TimeController::class, 'getAll']);
    Route::post('/create', [TimeController::class, 'create']);
    Route::put('/update/{id}', [TimeController::class, 'update']);
    Route::delete('/delete/{id}', [TimeController::class, 'delete']);
});
// Route::resource('time', TimeController::class);

Route::prefix('campeonato')->group(function () {
    Route::get('/listarHistorico', [CampeonatoController::class, 'listarHistorico']);
    Route::post('/simularCampeonato', [CampeonatoController::class, 'simularCampeonato']);
});
