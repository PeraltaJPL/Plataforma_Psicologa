<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function home(){
        // Obtener todas las notas
        $items = Note::all();

        // Fecha actual
        $today = Carbon::today();

        // Obtener eventos del día de hoy
        $todayEvents = Event::whereDate('start', $today)
            ->orderBy('start', 'asc')
            ->get();

        // Obtener los últimos 3 eventos (antes de hoy)
        $lastThreeEvents = Event::whereDate('start', '<', $today)
            ->orderBy('start', 'desc')
            ->take(3)
            ->get();

        // Obtener los próximos 3 eventos (después de hoy)
        $nextThreeEvents = Event::whereDate('start', '>', $today)
            ->orderBy('start', 'asc')
            ->take(3)
            ->get();

        // Usuario
        // $user = Auth::user();

        // Pasar las variables a la vista
        return view('Inicio.home', compact('items', 'todayEvents', 'lastThreeEvents', 'nextThreeEvents'));
    }
}
