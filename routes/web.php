<?php

// use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\loginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AutoestimaTestController;

Route::get('/', [loginController::class, 'login'])->name('login.show'); // Ruta de login
Route::post('/login', [loginController::class, 'attempt'])->name('login.attempt'); // Autenticacion Login
Route::get('/home', [HomeController::class, 'home'])->name('Inicio.home'); // Ruta de inicio


//Rutas para el INCIO DE SESION
use App\Http\Controllers\SesionController;
Route::get('/InicioSesion', [SesionController::class, 'sesion'])->name('InicioSesion.inisioSesion');

//Rutas para el Lista de los test
use App\Http\Controllers\testsController;
// Route::get('/listaTests', [testsController::class, 'lTests'])->name('listaTests.aplicacionTest');


//Rutas del test de Tipos de aprendizajes
use App\Http\Controllers\BaseTestController;
Route::get('/tests/{id}', [BaseTestController::class, 'show'])->name('tests.show'); // Mostrar el test
Route::post('/tests/{id}', [AutoestimaTestController::class, 'submit'])->name('tests.submit');
Route::get('/listaTests', [BaseTestController::class, 'index'])->name('listaTests.aplicacionTest');
Route::get('/tests/{id}/results', [BaseTestController::class, 'showResults'])->name('tests.TestResults'); // Mostrar resultados del test


//Rutas para CALENDARIOS
use App\Http\Controllers\CalendarioController;
// Ruta para la vista principal del calendario
// Route::get('/calendario', [CalendarioController::class, 'index'])->name('calendario.calendarioEventos');
// // Ruta para la vista del calendario
// Route::get('/calendario/eventos', [CalendarioController::class, 'eventos'])->name('calendario.cEventos');


use App\Http\Controllers\FullCalendarController;
Route::controller(FullCalendarController::class)->group(function(){
    Route::get('calendario', 'index')->name('calendario.index');
    Route::get('events', 'events')->name('fullcalendar.events');
    Route::post('events/add', 'add')->name('fullcalendar.events.add');
    Route::put('events/update', 'update')->name('fullcalendar.events.update');
    Route::delete('events/destroy', 'destroy')->name('fullcalendar.events.destroy');
});


//Rutas para NOTAS
use App\Http\Controllers\NotasController;
// Ruta para la vista principal de notas
Route::get('/notas', [NotasController::class, 'index'])->name('notas.notas');
Route::get('/notas/create', [NotasController::class, 'create'])->name('notas.create');
Route::post('/store', [NotasController::class, 'store'])->name('store');
Route::get('/notas/edit/{noteId}', [NotasController::class, 'edit'])->name('notas.edit');
Route::put('/update/{noteId}', [NotasController::class, 'update'])->name('update');
Route::delete('/destroy/{noteId}', [NotasController::class, 'destroy'])->name('destroy');


//Ruta para la lista de grupos
use App\Http\Controllers\GruposController;
Route::get('/grupos', [GruposController::class, 'GruposL'])->name('pacientes.grupos');

use App\Http\Controllers\UsuariosController;

Route::prefix('usuarios')->middleware(['auth'])->group(function () {
    Route::get('/', [UsuariosController::class, 'index'])->name('usuarios.index'); // Lista de usuarios
    Route::get('/crear', [UsuariosController::class, 'create'])->name('usuarios.create'); // Formulario de creación
    Route::post('/', [UsuariosController::class, 'store'])->name('usuarios.store'); // Guardar nuevo usuario
    Route::get('/edit/{id}', [UsuariosController::class, 'edit'])->name('usuarios.edit'); // Formulario de edición
    Route::put('/{id}', [UsuariosController::class, 'update'])->name('usuarios.update'); // Actualizar usuario
    Route::delete('/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy'); // Eliminar usuario
});



// Pacientes
use App\Http\Controllers\PacientesController;

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

use App\Http\Controllers\ResultController;
// Ruta para ver los resultados de los tests
Route::get('/test-results/{id}', [ResultController::class, 'show'])->name('testResults.show');

Route::get('/tests/results/{id}/psychologist', [BaseTestController::class, 'showResultsPsychologist'])->name('tests.resultsPsicologist');
