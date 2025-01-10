<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotasController extends Controller
{

    // Función para crear una nueva nota
    public function create()
    {
        $user = Auth::user();
        return view('notas.create', compact('user')); // Vista para el formulario de creación de nota
    }

    public function store(Request $request){
        $item = new Note();
        $item-> title = $request -> title;
        $item-> description = $request -> description;
        $item->save();
        return to_route('Inicio.home');
    }

    // Función para editar una nota
    public function edit($noteId)
    {
        $item = Note::find($noteId);
        return view('notas.edit', compact('item')); // Vista para editar una nota específica
    }

    public function update(Request $request, string $noteId)
    {





        $item = Note::find($noteId);
        $item->title = $request->title;
        $item-> description = $request -> description;
        $item->save();

        return to_route('Inicio.home');

    }

    public function destroy(string $noteId)
    {
        $item = Note::find($noteId);
        $item->delete();
        return to_route('Inicio.home');
    }
}
