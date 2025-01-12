<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class RegisterController extends Controller
{
    public function create()
    {

        return view('InicioSesion.register');
    }

    public function store(Request $request)
    {
       $request->validate([
    'name' => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', 'max:255'],
    'email' => 'required|string|email|max:255|unique:users',
    'password' => ['required', 'confirmed', Rules\Password::defaults()],

], [
    'name.required' => 'El campo de nombre es obligatorio.',
    'name.regex' => 'El nombre solo puede contener letras y no números.',
    'name.string' => 'El nombre debe ser una cadena de texto válida.',
    'name.max' => 'El nombre no puede exceder los 255 caracteres.',

    'email.required' => 'El campo de correo es obligatorio.',
    'email.string' => 'El correo debe ser una cadena de texto válida.',
    'email.email' => 'El correo debe tener un formato válido (ejemplo@dominio.com).',
    'email.max' => 'El correo no puede exceder los 255 caracteres.',
    'email.unique' => 'El correo ya está registrado, por favor utiliza otro.',

    'password.required' => 'La contraseña es obligatoria.',
    'password.confirmed' => 'Las contraseñas no coinciden.',


]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('Inicio.home')->with('success', 'Usuario registrado exitosamente.');
    }

    public function login()
    {
        return view('InicioSesion.inisioSesion');

    }

    public function loginPost(Request $request)
    {

        // Validar los datos de entrada con mensajes personalizados
    $validated = $request->validate([
        'email' => 'required|email|exists:users,email', // 'users' es el nombre de la tabla de usuarios
        'password' => 'required|min:6', // Asegúrate de que la contraseña tenga al menos 6 caracteres
    ], [
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'Por favor, ingresa un correo electrónico válido.',
        'email.exists' => 'Este correo electrónico no está registrado.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
    ]);

         // Comprobar las credenciales de usuario
    $user = \App\Models\User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        // Si las credenciales son correctas, loguear al usuario
        Auth::login($user);
        return redirect('/home')->with('success', 'Login exitoso');
    }

    // Si la contraseña es incorrecta
    return back()->withErrors([
        'password' => 'La contraseña es incorrecta.'
    ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
