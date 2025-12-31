<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecolteController;

Route::get('/', function () {
    return view('app');
});

Route::resource('recoltes', RecolteController::class);
