<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AutoestimaTestController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\TestsController;
use App\Http\Controllers\BaseTestController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\GruposController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\ResultController;

// Rutas públicas
Route::middleware('auth')->get('/', [loginController::class, 'login'])->name('login.show'); // Ruta de login
Route::post('/login', [LoginController::class, 'attempt'])->name('login.attempt'); // Autenticación Login
Route::get('/logout', [loginController::class, 'logout'])->name('logout');
Route::get('/', [loginController::class, 'login'])->name('login');

// Grupo de rutas protegidas por middleware (auth)
Route::middleware(['auth'])->group(function () {

    // Ruta de inicio
    Route::get('/home', [HomeController::class, 'home'])->name('Inicio.home'); // Ruta de inicio

    // Rutas para el inicio de sesión
    Route::get('/InicioSesion', [SesionController::class, 'sesion'])->name('InicioSesion.inisioSesion');

    // Rutas para el Lista de los test
    Route::get('/tests/{id}', [BaseTestController::class, 'show'])->name('tests.show'); // Mostrar el test
    Route::post('/tests/{id}', [AutoestimaTestController::class, 'submit'])->name('tests.submit');
    Route::get('/listaTests', [BaseTestController::class, 'index'])->name('listaTests.aplicacionTest');
    Route::get('/tests/{id}/results', [BaseTestController::class, 'showResults'])->name('tests.TestResults'); // Mostrar resultados del test

    // Rutas para el calendario
    Route::controller(FullCalendarController::class)->group(function () {
        Route::get('calendario', 'index')->name('calendario.index');
        Route::get('events', 'events')->name('fullcalendar.events');
        Route::post('events/add', 'add')->name('fullcalendar.events.add');
        Route::put('events/update', 'update')->name('fullcalendar.events.update');
        Route::delete('events/destroy', 'destroy')->name('fullcalendar.events.destroy');
    });

    // Rutas para notas
    Route::get('/notas', [NotasController::class, 'index'])->name('notas.notas');
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

    // Ruta para ver los resultados de los tests
    Route::get('/test-results/{id}', [ResultController::class, 'show'])->name('testResults.show');

    // Ruta para los resultados psicológicos
    Route::get('/tests/results/{id}/psychologist', [BaseTestController::class, 'showResultsPsychologist'])->name('tests.resultsPsicologist');

});
