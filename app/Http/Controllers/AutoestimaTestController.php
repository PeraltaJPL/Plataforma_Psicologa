<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\TestResult;
use App\Models\TestAnswer;
use App\Models\Option;


class AutoestimaTestController extends BaseTestController
{
    // Procesa las respuestas del Test de Autoestima
    public function submit(Request $request, $id)
{
    return parent::submit($request, $id);
}
}
