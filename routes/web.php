<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Perte\PerteController;
use App\Http\Controllers\Stock\StockController;
use App\Http\Controllers\Vente\VenteController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\VarieteeController;
use App\Http\Controllers\RecolteController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('dashboard');
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
Route::get('/stocks', [StockController::class, 'index'])->name('gestion-stock');
Route::get('/pertes', [PerteController::class, 'index'])->name('gestion-perte');



Route::get('/dashboard/ventes-data', [DashboardController::class, 'ventesData'])
    ->name('dashboard.ventes-data');


Route::get('/dashboard/ventes-varietees', [DashboardController::class, 'ventesParVarietee']);


Route::get('/dashboard/ventes-recoltes', [DashboardController::class, 'ventesEtRecoltes'])
    ->name('dashboard.ventes-recoltes');



Route::get('/dashboard/pertes-data', [DashboardController::class, 'PertesData'])
->name('dashboard.pertes-data');