<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AutoestimaTestController;
use App\Http\Controllers\TestsController;
use App\Http\Controllers\BaseTestController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\GruposController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordController;

Route::middleware('guest')->group(function(){
    //Rutas para el registro
    Route::get('/register', [RegisterController::class, 'create'])->name('InicioSesion.register');
    Route::post('/register', [RegisterController::class, 'store']);

    //Rutas para el login y el logout
    Route::post('/loginPost', [RegisterController::class, 'loginPost'])->name('login.attempt'); // Autenticación Login
    Route::get('/', [RegisterController::class, 'login'])->name('login');


    Route::get('/password/forgot', [PasswordController::class, 'showForgotForm'])->name('password.forgot');
    Route::post('/password/forgot', [PasswordController::class, 'sendResetLink'])->name('password.email');
    Route::get('password/reset/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [PasswordController::class, 'reset'])->name('password.update');


});

//Ruta para cerrar sesion
Route::get('/logout', [RegisterController::class, 'logout'])->name('logout');

//Rutas para el perfil
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

//Controlador para la gestión de usuarios
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [UsuariosController::class, 'index'])->name('users.index');
    Route::post('/users/{id}/toggle-status', [UsuariosController::class, 'toggleStatus'])->name('users.toggleStatus');
    Route::post('/users/{id}/update-role', [UsuariosController::class, 'updateRole'])->name('users.updateRole');
    Route::delete('/users/{id}', [UsuariosController::class, 'destroy'])->name('users.destroy');
});

    // Rutas para el Lista de los test
Route::middleware(['auth'])->group(function () {
    // Ruta de inicio


    //Ruta para los test
    Route::get('/tests/{id}', [BaseTestController::class, 'show'])->name('tests.show'); // Mostrar el test
    Route::post('/tests/{id}', [AutoestimaTestController::class, 'submit'])->name('tests.submit');
    Route::get('/listaTests', [BaseTestController::class, 'index'])->name('listaTests.aplicacionTest');
    Route::get('/tests/{id}/results', [BaseTestController::class, 'showResults'])->name('tests.TestResults'); // Mostrar resultados del test
    
    // Ruta para ver los resultados de los tests
    // Route::get('/test-results/{id}', [ResultController::class, 'show'])->name('testResults.show');
    Route::get('/tests/results/{id}/psychologist', [BaseTestController::class, 'showResultsPsychologist'])->name('tests.resultsPsicologist');
    Route::get('/test-results/search', [ResultController::class, 'search'])->name('testResults.search');
    Route::delete('/listaTests/{resultId}', [BaseTestController::class, 'destroy'])->name('listaTests.destroy');

});

// Grupo de rutas protegidas por middleware (auth)
// Route::middleware(['auth', 'admin'])->group(function () {
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/home', [HomeController::class, 'home'])->name('Inicio.home'); // Ruta de inicio

    // Rutas para el calendario
    Route::controller(FullCalendarController::class)->group(function () {
        Route::get('calendario', 'index')->name('calendario.index');
        Route::get('events', 'events')->name('fullcalendar.events');
        Route::post('events/add', 'add')->name('fullcalendar.events.add');
        Route::put('events/update', 'update')->name('fullcalendar.events.update');
        Route::delete('events/destroy', 'destroy')->name('fullcalendar.events.destroy');
    });

    // Rutas para notas
    Route::get('/notas/create', [NotasController::class, 'create'])->name('notas.create');
    Route::post('/store', [NotasController::class, 'store'])->name('store');
    Route::get('/notas/edit/{noteId}', [NotasController::class, 'edit'])->name('notas.edit');
    Route::put('/update/{noteId}', [NotasController::class, 'update'])->name('update');
    Route::delete('/destroy/{noteId}', [NotasController::class, 'destroy'])->name('destroy');

    // Ruta para la lista de grupos
    Route::get('/grupos', [GruposController::class, 'GruposL'])->name('pacientes.grupos');

// Pacientes
Route::prefix('pacientes')->group(function () {
    // Mostrar la lista de pacientes, filtrada por carrera si el parámetro 'career' está presente
    Route::get('/', [PacientesController::class, 'index'])->name('pacientes.index');

    // Mostrar el formulario para agregar un paciente
    Route::get('/crear', [PacientesController::class, 'create'])->name('pacientes.create');

    // Guardar un nuevo paciente
    Route::post('/', [PacientesController::class, 'store'])->name('pacientes.store');

    // Mostrar el formulario para editar un paciente
    Route::get('/edit/{patientId}', [PacientesController::class, 'edit'])->name('pacientes.edit');

    // Actualizar los datos de un paciente
    Route::put('/{patientId}', [PacientesController::class, 'update'])->name('pacientes.update');

    // Eliminar un paciente
    Route::delete('/{patientId}', [PacientesController::class, 'destroy'])->name('pacientes.destroy');
});



});
