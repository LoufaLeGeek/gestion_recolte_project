<?php

use App\Http\Controllers\Perte\PerteController;
use App\Http\Controllers\Stock\StockController;
use App\Http\Controllers\Vente\VenteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("app");
})->name("test");

Route::get('/ventes', [VenteController::class, 'index'])->name('gestion-vente');
Route::get('/stocks', [StockController::class, 'index'])->name('gestion-stock');
Route::get('/pertes', [PerteController::class, 'index'])->name('gestion-perte');
