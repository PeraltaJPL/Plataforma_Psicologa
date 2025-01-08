<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestResult; // Modelo para resultados
use App\Models\Test; // Modelo para tests
use App\Models\User; // Modelo para usuarios

class ResultController extends Controller
{
    // Muestra la lista de resultados
    public function index()
    {
        // Obtén los resultados con relaciones de usuarios y tests
        $testResults = TestResult::with('user', 'test')->get();

        return view('results.index', compact('testResults'));
    }

    // Muestra un resultado específico
    public function show($id)
    {
        $testResult = TestResult::with('user', 'test')->findOrFail($id);
        $answers = $testResult->answers; 

        return view('results.show', compact('testResult', 'answers'));
    }
}
