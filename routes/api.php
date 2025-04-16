<?php

use App\Http\Controllers\BoissonController;
use App\Http\Controllers\EntreeStockController;
use App\Http\Controllers\StockageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('boissons', [BoissonController::class, 'createBoisson']);
Route::post('typeboissons', [BoissonController::class, 'createTypeBoisson']);
Route::post('entree_stocks', [EntreeStockController::class, 'createEntreeBoisson']);
Route::post('stocks', [StockageController::class, 'updateStockBoisson']);

Route::get('boissons', [BoissonController::class, 'listBoisson']);
Route::get('typeboissons', [BoissonController::class, 'listTypeBoisson']);
