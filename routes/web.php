<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VarieteeProduitController;

Route::get('/', function () {
    return view('app');
});



Route::resource('produit-varietee', VarieteeProduitController::class);





