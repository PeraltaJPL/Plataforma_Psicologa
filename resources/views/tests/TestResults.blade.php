@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<div class="container mt-5">
    <h2 class="mb-4">Resultados: {{ $test->name }}</h2>
    <p>Revisa tus respuestas</p>

    <div class="card shadow">
        <div class="card-header">
            <h4>Resumen de Respuestas</h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($test->questions as $question)
                    <li class="list-group-item">
                        <h5>{{ $question->text }}</h5>
                        <p>
                            <strong>Tu respuesta: </strong>
                            @php
                                $answer = $testAnswers->firstWhere('questionId', $question->questionId);
                            @endphp

                            @if ($answer)
                                {{ $answer->answerText }}
                            @else
                                <span class="text-danger">No respondida</span>
                            @endif
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="card shadow mt-4">
        <div class="card-header">
            <h4>Resultado Final</h4>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                {{ $result->result }}
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('listaTests.aplicacionTest') }}" class="btn btn-primary">Volver a la lista de tests</a>
    </div>
</div>

@endsection