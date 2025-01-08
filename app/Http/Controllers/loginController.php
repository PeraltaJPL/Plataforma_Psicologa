<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Muestra la vista de login
    public function login()
    {
        return view('InicioSesion.inisioSesion');
    }

    // Procesa el inicio de sesión
    public function attempt(Request $request)
    {
        // Obtiene las credenciales del formulario
        $credentials = $request->only('email', 'password');

        // Verifica las credenciales
        if (Auth::attempt($credentials)) {
            // Si las credenciales son correctas, se regenera la sesión
            $request->session()->regenerate();

            // Verifica si el usuario tiene el rol 'patient'
            $user = Auth::user();
            if ($user->role === 'patient') {
                // Si el rol es 'patient', redirige a /listaTests
                return redirect('/listaTests');
            }

            // Si no es un paciente, redirige al home
            return redirect()->route('Inicio.home');
        }

        // Si no coinciden las credenciales, regresa con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales no son válidas.',
        ]);
    }
}
