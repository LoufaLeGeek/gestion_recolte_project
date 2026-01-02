<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Vente\VenteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\VarieteeController;
use App\Http\Controllers\RecolteController;

Route::get('/', function () {
    return view('app');
});


// Routes pour les produits (CRUD complet)
Route::resource('produits', ProduitController::class);


// Routes CRUD pour les variétés
Route::resource('varietees', VarieteeController::class);



Route::get('/ventes', [VenteController::class, 'index'])->name('gestion-vente');

Route::resource('recoltes', RecolteController::class);


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/data', [DashboardController::class, 'data'])
    ->name('dashboard.data');


Route::get('/dashboard/ventes-data', [DashboardController::class, 'ventesData'])
    ->name('dashboard.ventes-data');
