<?php

use App\Http\Controllers\Api\CurrenciesController;
use App\Http\Controllers\Api\RateConversionController;
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

Route::prefix('currencies')->group(function () {
    Route::get('/', [CurrenciesController::class, 'index']); // Lista de divisas
    Route::get('/rate-conversion', [RateConversionController::class, 'convert']); // Conversión de divisas
});
