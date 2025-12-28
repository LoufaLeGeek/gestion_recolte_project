<?php

namespace App\Http\Controllers\Vente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    public function index()
    {
        return view("vente.index");
    }
}
