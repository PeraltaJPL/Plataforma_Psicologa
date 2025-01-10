<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Estado del usuario actualizado.');
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|string|in:admin,user,patient',
        ]);
    
        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'Rol del usuario actualizado.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
    


    // public function create()
    // {
    //     return view('usuarios.crear');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:8|confirmed',
    //     ]);

    //     User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'role' => 'psychologist', // Por defecto, se crean psicólogos
    //     ]);

    //     return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito.');
    // }

    // public function edit($id)
    // {
    //     $usuario = User::findOrFail($id);
    //     return view('usuarios.edit', compact('usuario'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $usuario = User::findOrFail($id);

    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,' . $id,
    //     ]);

    //     $usuario->update([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //     ]);

    //     return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito.');
    // }

    // public function destroy($id)
    // {
    //     $usuario = User::findOrFail($id);
    //     $usuario->delete();

    //     return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado con éxito.');
    // }
}

