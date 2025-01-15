<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PacientesController extends Controller
{
    // Muestra la lista de pacientes de una carrera especifica
    public function index(Request $request)
    {
        $user = Auth::user();

        // Obtener el parámetro 'career' de la URL, si existe
        $career = $request->query('career');

        // Si existe el parámetro 'career', filtrar por esa carrera
        // Si no, obtener todos los pacientes
        $users = $career
            ? User::where('career', $career)->get()  // Filtrar por carrera si está presente
            : User::all();  // Obtener todos los usuarios si no hay filtro de carrera

        // Pasar los datos a la vista
        return view('pacientes.pacientes', compact('users', 'career', 'user'));
    }


    // Crear un nuevo patient
    public function create(Request $request)
    {
        $career = $request->query('career'); // Obtiene la carrera desde la url
        return view('pacientes.crear', compact('career'));
    }

    // Guarda los datos de un nuevo paciente en la base de datos
    public function store(Request $request)
{
    // Validación de los datos del formulario
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'controlNumber' => 'required|string|max:255|unique:users,controlNumber',
        'career' => 'required|string|max:255',
        'schoolCycle' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
    ]);

    // Crear un nuevo usuario
    $user = new User();
    $user->name = $request->name;
    $user->controlNumber = $request->controlNumber;
    $user->career = $request->career;
    $user->schoolCycle = $request->schoolCycle;
    $user->email = $request->email;
    $user->role = 'patient';

    // Generar contraseña personalizada (solo número de control)
    $generatedPassword = $request->controlNumber;

    // Cifrar la contraseña
    $user->password = Hash::make($generatedPassword);

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
        // Verificar si la imagen predeterminada existe
        // Si la imagen predeterminada no existe, se usa una imagen predeterminada genérica
        if (!file_exists(public_path("storage/{$defaultPhoto}"))) {
            $defaultPhoto = 'profiles/default.jpg'; // Imagen predeterminada genérica
        }

        // Asignar la ruta de la imagen predeterminada
        $photoPath = $defaultPhoto;
    }

    // Asignar la imagen al usuario
    $user->photo = $photoPath;

    // Guardar el usuario
    $user->save();

    // Redirigir con mensaje de éxito
    return redirect()->route('pacientes.index', ['career' => $user->career])
        ->with('success', 'Paciente registrado con éxito.');
}


    // Muestra un formulario para editar los datos de un paciente
    public function edit($patientId)
    {
        $user = user::findOrFail($patientId); // Busca el paciente por su id, si no existe, muestra error
        return view('pacientes.edit', compact('user')); // Manda los datos del paciente a la vista
    }

    // Actualiza los datos de un paciente en la base de datos
    public function update(Request $request, $id)
    {
        // Encuentra al usuario por su ID
        $user = User::findOrFail($id);

        // Validar los datos de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'controlNumber' => 'required|string|max:255|unique:users,controlNumber,' . $id,
            'career' => 'required|string|max:255',
            'schoolCycle' => 'required|string|max:255',
        ]);

        // Verifica si el controlNumber ha cambiado
        if ($user->controlNumber !== $request->controlNumber) {
            // Si ha cambiado, genera una nueva contraseña con el nombre y controlNumber
            $newPassword = $request->name[0] . $request->controlNumber; // Genera la contraseña combinando el primer carácter del nombre y el controlNumber
            $user->password = bcrypt($newPassword); // Actualiza la contraseña con la nueva
        }

        // Actualiza los otros campos del usuario
        $user->name = $request->name;
        $user->controlNumber = $request->controlNumber;
        $user->career = $request->career;
        $user->schoolCycle = $request->schoolCycle;

        // Guarda los cambios
        $user->save();

        // Redirige a la vista de pacientes con un mensaje de éxito
        return redirect()->route('pacientes.index', ['career' => $user->career])
            ->with('success', 'Paciente actualizado con éxito.');
    }



   // Elimina un paciente de la base de datos
    public function destroy(string $userId, Request $request)
    {
        // Busca el usuario por su id, si no existe, muestra error
        $user = User::findOrFail($userId);

        // Elimina el usuario
        $user->delete();

        // Regresa a la lista de usuarios de esa carrera con un mensaje de exito
        return redirect()
            ->route('pacientes.index', ['career' => $request->career]) // Mantiene el filtro de carrera
            ->with('success', 'Paciente eliminado con éxito.');
    }

    public function generateUsername($name)
{
    // Convierte el nombre a minúsculas y elimina espacios
    $baseUsername = Str::slug($name, ' ');

    // Verifica si el username ya existe
    $username = $baseUsername;
    $counter = 1;

    while (User::where('username', $username)->exists()) {
        // Si ya existe, agrega un número al final
        $username = $baseUsername . $counter;
        $counter++;
    }

    return $username;
}
}