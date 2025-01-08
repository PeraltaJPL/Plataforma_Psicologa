<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarioController extends Controller
{
    // Función para mostrar la vista del calendario
    public function index()
    {
        $user = Auth::user();
        return view('calendario.calendarioEventos', compact('user')); // Vista del calendario
    }

    // Función para mostrar el calendario personal
    public function eventos()
    {
        $user = Auth::user();

        return view('calendario.cEventos', compact('user')); // Vista el calendario
    }
}
