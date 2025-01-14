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
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validación para la imagen
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
    
            'photo.image' => 'La imagen debe ser un archivo de imagen válido.',
            'photo.mimes' => 'La imagen debe ser un archivo de tipo jpeg, png, jpg, gif o svg.',
            'photo.max' => 'La imagen no puede exceder los 2048 kilobytes.',
        ]);
    
        // Obtener la primera letra del nombre en mayúsculas
        $initial = strtoupper(substr($request->name, 0, 1));
    
        // Ruta de la imagen predeterminada basada en la inicial
        $defaultPhoto = "profiles/{$initial}.jpg"; // Asumiendo que tienes imágenes en storage/app/public/profiles
    
        // Verificar si se ha subido una imagen
        if ($request->hasFile('photo')) {
            // Guardar la imagen en el disco
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/profiles', $photoName);
    
            // Asignar la ruta de la imagen a la variable
            $photoPath = 'profiles/' . $photoName;
        } else {
            // Asignar la ruta de la imagen predeterminada
            $photoPath = $defaultPhoto;
        }
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $photoPath, // Asignar la ruta de la imagen
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
