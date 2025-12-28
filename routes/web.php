<?php

use App\Http\Controllers\Vente\VenteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});


Route::get('/ventes', [VenteController::class, 'index'])->name('gestion-vente');
