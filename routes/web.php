<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ProduitController;

Route::get('/', function () {
    return view('app');
});


// Routes pour les produits (CRUD complet)
Route::resource('produits', ProduitController::class);
