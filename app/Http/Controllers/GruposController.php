<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GruposController extends Controller
{

    public function GruposL()
    {
        $user = Auth::user();
        // Pasa las variables a la vista
        return view('pacientes.grupos', compact('user'));
    }
}
