@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Resultados de: {{ $test->name }}</h1>

        <ul>
            @foreach ($test->questions as $question)
                <li>
                    <strong>{{ $question->questionText }}</strong>
                    <br>
                    <span>Tu respuesta:
                        @if ($question->type === 'multiple_choice')
                            {{ $question->options->firstWhere('optionId', $answers[$question->questionId])->optionText ?? 'No respondida' }}
                        @else
                            {{ $answers[$question->questionId] ?? 'No respondida' }}
                        @endif
                    </span>
                    @if (isset($answers[$question->questionId]))
                        @php
                            $selectedOption = $question->options->firstWhere(
                                'optionId',
                                $answers[$question->questionId],
                            );
                        @endphp
                        @if ($selectedOption && isset($selectedOption->value))
                            <span class="badge bg-primary">Valor: {{ $selectedOption->value }}</span>
                        @endif
                    @endif
                </li>
            @endforeach
        </ul>

        {{-- Resultados del Test de Estilos de Aprendizaje --}}
        @if ($test->testId == 2 && isset($learningStyles))
            <div class="alert alert-info mt-4">
                <h3>Resultados de tus Estilos de Aprendizaje:</h3>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Visual</h5>
                                <p class="card-text">Puntaje: {{ $learningStyles['visual'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Auditivo</h5>
                                <p class="card-text">Puntaje: {{ $learningStyles['auditivo'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Kinestésico</h5>
                                <p class="card-text">Puntaje: {{ $learningStyles['kinestesico'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Verifica si el test es el de autoestima y si existe el resultado --}}
        @if ($test->testId == 1 && isset($result) && !empty($result))
            <div class="alert alert-info mt-4">
                <h3>Resultado de tu evaluación de autoestima:</h3>
                <p>{{ $result }}</p>
            </div>
        @elseif ($test->testId == 1 && (empty($result) || !isset($result)))
            {{-- Si no hay resultado asignado --}}
            <div class="alert alert-warning mt-4">
                <p>Lo siento, no pudimos calcular tu resultado. Intenta nuevamente.</p>
            </div>
        @endif

        {{-- Verifica si el test Vocacional y si existe el resultado --}}
        @if ($test->testId == 5 && isset($result) && !empty($result))
            <div class="alert alert-info mt-4">
                <h3>Resultado de tu evaluación de Test de Intereses Vocacionales y Profesionales:</h3>
                <p>{{ $result }}</p>
            </div>
        @elseif ($test->testId == 5 && (empty($result) || !isset($result)))
            {{-- Si no hay resultado asignado --}}
            <div class="alert alert-warning mt-4">
                <p>Lo siento, no pudimos calcular tu resultado. Intenta nuevamente.</p>
            </div>
        @endif

        <a href="{{ route('tests.show', $test->testId) }}" class="btn btn-secondary mt-3">Regresar al test</a>
    </div>
@endsection
