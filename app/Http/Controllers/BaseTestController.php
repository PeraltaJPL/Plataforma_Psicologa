<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\TestResult;
use App\Models\TestAnswer;
use App\Models\Option;
use Illuminate\Support\Facades\Auth;

class BaseTestController extends Controller
{
    // Obtiene y muestra la lista de tests
    public function index() {
        $user = Auth::user();  // Esto obtiene al usuario autenticado
        $tests = Test::all();
        $testResults = TestResult::with('test', 'user', 'patient')->get(); // Cargar las relaciones de Test, User y Patient
        return view('listaTests.aplicacionTest', compact('tests', 'testResults', 'user'));
    }


    // Muestra las preguntas y opciones de un test específico
    public function show($id) {
        $test = Test::with('questions.options')->findOrFail($id);
        return view('listaTests.TestTiposDeAprendizaje.show', compact('test'));
    }

    // Procesa las respuestas enviadas por el usuario
    public function submit(Request $request, $id)
    {
        $test = Test::with('questions.options')->findOrFail($id);
        $userId = auth()->id();

        // Verificar el testId para llamar al método adecuado
        if ($test->testId == 1) {
            return $this->submitAutoestimaTest($request, $test, $userId);
        }

        if ($test->testId == 2) {
            return $this->submitEstilosAprendizajeTest($request, $test, $userId);
        }

        return back()->with('error', 'Test no reconocido.');
    }

    // Método para procesar el Test de Autoestima
    protected function submitAutoestimaTest(Request $request, $test, $userId)
    {
        $answers = $request->input('answers');

        // Validación: asegura que todas las preguntas tienen una respuesta
        foreach ($test->questions as $question) {
            if (!isset($answers[$question->questionId])) {
                return back()->with('error', 'Por favor responde todas las preguntas.');
            }
        }

        // Crear el registro de resultado del test
        $testResult = TestResult::create([
            'testId' => $test->testId,
            'patientId' => null,  // Ajusta si necesitas asignar pacientes
            'userId' => $userId,
            'testDate' => now(),
            'result' => null, // Calcula el resultado si es necesario
        ]);

        // Almacenar respuestas del usuario
        foreach ($test->questions as $question) {
            $selectedOptionId = $answers[$question->questionId] ?? null;
            $selectedOptionText = null;
            $selectedOptionValue = null;

            if ($selectedOptionId) {
                $selectedOption = Option::find($selectedOptionId);
                $selectedOptionText = $selectedOption->optionText ?? null;
                $selectedOptionValue = $selectedOption->value ?? null;
            }

            TestAnswer::create([
                'resultId' => $testResult->resultId,
                'questionId' => $question->questionId,
                'optionId' => $selectedOptionId,
                'answerText' => $selectedOptionText,
                'userId' => $userId,
                'value' => $selectedOptionValue
            ]);
        }

        // Obtiene las respuestas almacenadas para calcular resultados
        $testAnswers = TestAnswer::where('resultId', $testResult->resultId)->get();
        $responseCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0];

        // Cuenta las respuestas basadas en el campo "value"
        foreach ($testAnswers as $answer) {
            if (isset($responseCounts[$answer->value])) {
                $responseCounts[$answer->value]++;
            }
        }

        // Determina el valor más frecuente
        $maxResponse = max($responseCounts);
        $maxKey = array_search($maxResponse, $responseCounts);

        // Da el resultado según el valor mayor
        switch ($maxKey) {
            case 1:
                $result = 'Mayoría de 1:  Tienes un nivel algo bajo de autoestima y se nota en la valoración que haces
                de ti mismo, de tu trabajo y de tu fortuna en la vida. Una de las razones por las que percibimos
                más las cosas negativas es que estas son más destacables que las positivas. En la escuela o
                de niños en casa, siempre nos regañaban por lo malo pero se olvidaban de felicitamos por lo
                bueno. Para elevar el nivel de nuestra autoestima es necesario aceptarse tal como uno es y
                valorar más lo que somos y lo que tenemos. A veces puede parecer difícil, pero si practicas
                unos minutos diarios a pensar en las cosas positivas que tienes, irás poco a poco queriéndote
                más.';
                break;
            case 2:
                $result = 'Mayoría de 2:  Tu nivel de autoestima es suficiente pero más a menudo de lo que te gustaría,
                te falla y te abandona. Los sucesos negativos que nos pasan absorben más nuestros sentidos
                pues son más desagradables que las cosas positivas, por ello les damos más importancia de
                la que merecen y no nos fijamos en lo bueno con igual intensidad. Todas las personas
                tenemos cosas positivas y todos cometemos errores o tenemos días flojos. La clave está en
                darle a cada cosa el justo valor que tiene, ver los errores como maneras de aprendizaje y
                reconocer las cosas buenas que poseemos. También podemos aprender a queremos a
                nosotros mismos cuidándonos con más mimo y dándonos gustos.';
                break;
            case 3:
                $result = 'Mayoría de 3:  Tu nivel de autoestima es muy bueno, sabes dar a las cosas el valor que
                merecen, reconoces lo bueno y no te dejas amilanar fácilmente por las adversidades. Eres
                una persona sensata y realista que tiene confianza en sí misma, tus objetivos no son
                irrealizables y te gusta luchar para conseguirlos. Has aprendido que las cosas no salen
                siempre como quieres ni cuando quieres, que todo requiere un esfuerzo y que es normal
                equivocarse. Cuando tienes un error procuras aprender lo que este te enseña y a evitarlo en
                futuras ocasiones. Un buen nivel de autoestima nos hace tener más ganas de luchar por las cosas, nos ayuda a no desistir en nuestro empeño de lograr algo y hace que la vida nos sea
                más amable y agradable.';
                break;
            case 4:
                $result = 'Mayoría de 4: Tienes un alto nivel de autoestima y mucha confianza y seguridad en ti mismo.
                Ambos sentimientos son muy positivos y necesarios para conseguir mucho más de lo que nos
                proponemos, sin embargo, es preciso ser cautelosos. Al igual que una baja autoestima, un
                exceso de esta puede hacernos perder la objetividad de nuestras acciones, hacernos creer
                demasiado buenos en algo, y si sobreviene una decepción o un fracaso, hacernos sufrir más
                de lo razonable. También si nos creemos demasiado especiales podemos hacer daño a los
                demás minusvalorando su esfuerzo o no apreciándolo en lo que vale. Siempre conviene tener
                una dosis de modestia';
                break;
            default:
                $result = 'Error en los resultados';
                break;
        }

        // Actualiza el resultado del test
        $testResult->update(['result' => $result]);

        // Redirigir a la ruta de resultados
        return redirect()->route('tests.TestResults', $testResult->resultId)
                         ->with('success', 'Test completado exitosamente.');
    }

    // Método para procesar el Test de Estilos de Aprendizaje
    protected function submitEstilosAprendizajeTest(Request $request, $test, $userId)
    {
        $answers = $request->input('answers');
    
        // Validación: asegura que todas las preguntas tienen una respuesta
        foreach ($test->questions as $question) {
            if (!isset($answers[$question->questionId])) {
                return back()->with('error', 'Por favor responde todas las preguntas.');
            }
        }
    
        // Inicializa los puntos
        $visualPoints = 0;
        $auditoryPoints = 0;
        $kinestheticPoints = 0;
    
        // Listas de preguntas por categoría
        $visualQuestions = [1, 3, 6, 9, 10, 11, 14];
        $auditoryQuestions = [2, 5, 12, 15, 17, 21, 23];
        $kinestheticQuestions = [4, 7, 8, 13, 19, 22, 24];
    
        // Procesar las respuestas y calcular puntos
        foreach ($test->questions as $question) {
            $questionNumber = $question->questionId - ($test->questions->first()->questionId - 1);
            $selectedOptionId = $answers[$question->questionId] ?? null;
    
            if ($selectedOptionId) {
                $selectedOption = Option::find($selectedOptionId);
    
                if ($selectedOption) {
                    $value = $selectedOption->value ?? 0;
    
                    if (in_array($questionNumber, $visualQuestions)) {
                        $visualPoints += $value;
                    } elseif (in_array($questionNumber, $auditoryQuestions)) {
                        $auditoryPoints += $value;
                    } elseif (in_array($questionNumber, $kinestheticQuestions)) {
                        $kinestheticPoints += $value;
                    }
                }
            }
        }
    
        // Crear el resultado en formato JSON
        $result = [
            'visual' => $visualPoints,
            'auditivo' => $auditoryPoints,
            'kinestesico' => $kinestheticPoints,
        ];
    
        // Crear el registro de resultado del test
        $testResult = TestResult::create([
            'testId' => $test->testId,
            'patientId' => null,
            'userId' => $userId,
            'testDate' => now(),
            'result' => json_encode($result),
        ]);
    
        // Almacenar respuestas del usuario
        foreach ($test->questions as $question) {
            $selectedOptionId = $answers[$question->questionId] ?? null;
            $selectedOptionText = null;
            $selectedOptionValue = null;
    
            if ($selectedOptionId) {
                $selectedOption = Option::find($selectedOptionId);
                $selectedOptionText = $selectedOption->optionText ?? null;
                $selectedOptionValue = $selectedOption->value ?? null;
            }
    
            TestAnswer::create([
                'resultId' => $testResult->resultId,
                'questionId' => $question->questionId,
                'optionId' => $selectedOptionId,
                'answerText' => $selectedOptionText,
                'userId' => $userId,
                'value' => $selectedOptionValue,
            ]);
        }
    
        // Redirigir a la ruta de resultados
        return redirect()->route('tests.TestResults', $testResult->resultId)
                         ->with('success', 'Test completado exitosamente.');
    }
    

    // Muestra los resultados de un test
    public function showResults($id)
{
    $testAnswers = TestAnswer::where('resultId', $id)->get(['questionId', 'optionId', 'answerText', 'value']);
    if ($testAnswers->isEmpty()) {
        return back()->with('error', 'No hay respuestas disponibles para este test.');
    }

    $test = $testAnswers->first()->question->test ?? null;
    if (!$test) {
        return back()->with('error', 'El test asociado no fue encontrado.');
    }

    $result = TestResult::find($id);
    $learningStyles = null;

    // Evaluar estilos de aprendizaje si es el test correspondiente (ID = 2)
    if ($test->testId == 2) {
        $visualQuestions = [1, 3, 6, 9, 10, 11, 14];
        $auditiveQuestions = [2, 5, 12, 15, 17, 21, 23];
        $kinestheticQuestions = [4, 7, 8, 13, 19, 22, 24];
        
        $visualScore = 0;
        $auditiveScore = 0;
        $kinestheticScore = 0;

        foreach ($testAnswers as $answer) {
            $questionNumber = $answer->question->questionId - ($test->questions->first()->questionId - 1);
            
            if (in_array($questionNumber, $visualQuestions)) {
                $visualScore += $answer->value;
            } elseif (in_array($questionNumber, $auditiveQuestions)) {
                $auditiveScore += $answer->value;
            } elseif (in_array($questionNumber, $kinestheticQuestions)) {
                $kinestheticScore += $answer->value;
            }
        }
        
        // Formatear el resultado como un string legible
        $formattedResult = "Visual: {$visualScore} puntos\n";
        $formattedResult .= "Auditivo: {$auditiveScore} puntos\n";
        $formattedResult .= "Kinestésico: {$kinestheticScore} puntos";
        
        // Actualizar el resultado en la base de datos con el formato legible
        $result->update(['result' => $formattedResult]);

        $learningStyles = [
            'visual' => $visualScore,
            'auditivo' => $auditiveScore,
            'kinestesico' => $kinestheticScore
        ];
    }

    return view('tests.TestResults', [
        'test' => $test,
        'testAnswers' => $testAnswers,
        'result' => $result,
        'learningStyles' => $learningStyles
    ]);
}

    public function showResultsPsychologist($id)
    {
        $result = TestResult::findOrFail($id);
        return view('listaTests.resultsPsicologist', compact('result'));
    }
}
