<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testsController extends Controller
{

    public function lTests()
    {
        return view('listaTests.aplicacionTest'); 
    }
}