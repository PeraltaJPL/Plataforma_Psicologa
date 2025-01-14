<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
    ]);

    $user = Auth::user();
    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->hasFile('photo')) {
        // Eliminar la foto anterior si existe
        if ($user->photo) {
            File::delete(public_path('storage/' . $user->photo));
        }
        // Guardar la nueva foto
        $photo = $request->file('photo')->store('profiles', 'public');
        $user->photo = $photo;
    } else {
        // Si no se sube una foto, asignar una imagen predeterminada basada en la inicial del nombre
        $initial = strtoupper(substr($request->name, 0, 1)); // Primera letra del nombre
        $defaultPhotoPath = "profiles/{$initial}.jpg"; // Ruta de la imagen predeterminada en storage

        // Verificar si la imagen predeterminada existe antes de asignarla
        if (File::exists(public_path('storage/' . $defaultPhotoPath))) {
            $user->photo = $defaultPhotoPath;
        }
    }

    $user->save();

    return redirect()->route('profile.show')->with('success', 'Perfil actualizado correctamente.');
}

    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        $user->password = Hash::make($request->password);
        $request->user()->save();

        return redirect()->route('profile.show')->with('success', 'Contraseña actualizada correctamente.');
    }
}
