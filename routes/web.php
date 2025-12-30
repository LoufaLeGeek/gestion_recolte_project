<?php

use App\Http\Controllers\Vente\VenteController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ProduitController;
use App\Http\Controllers\VarieteeController;

Route::get('/', function () {
    return view('app');
});


// Routes pour les produits (CRUD complet)
Route::resource('produits', ProduitController::class);


// Routes CRUD pour les variétés
Route::resource('varietees', VarieteeController::class);
