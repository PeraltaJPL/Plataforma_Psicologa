<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\TestResult;
use App\Models\TestAnswer;

class EstilosAprendizajeController extends BaseTestController
{
    public function show($id)
    {
        $test = Test::with('questions.options')->findOrFail($id);
        return view('tests.estilosAprendizaje.show', compact('test'));
    }

    public function submit(Request $request, $id)
    {
    }
}
