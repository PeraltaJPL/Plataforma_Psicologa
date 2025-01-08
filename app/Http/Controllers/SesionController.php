<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SesionController extends Controller
{

    public function sesion()
    {
        return view('InicioSesion.inisioSesion');
    }
}
