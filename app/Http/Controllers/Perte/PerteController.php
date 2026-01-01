<?php

namespace App\Http\Controllers\Perte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerteController extends Controller
{
    public function index()
    {
        return view("perte-invendue.index");
    }
}
