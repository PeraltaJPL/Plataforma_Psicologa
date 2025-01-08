@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h1 class="card-title">{{ $test->name }}</h1>
        </div>
        <div class="card-body">
            <p><strong>{!! nl2br(e($test->description)) !!}</strong></p>
            @if($test->guide)
                <p class="text-muted"><strong>Guía:</strong> {{ $test->guide }}</p>
            @endif

            <form action="{{ route('tests.submit', $test->testId) }}" method="POST">
                @csrf

                @foreach ($test->questions as $question)
                    <div class="mb-4">
                        <h5 class="fw-bold">{{ $loop->iteration }}. {{ $question->question_text }}</h5>

                        @if ($question->type === 'multiple_choice')
                            @foreach ($question->options as $option)
                                <div class="form-check">
                                    <input type="radio"
                                           name="answers[{{ $question->questionId }}]"
                                           id="option{{ $option->optionId }}"
                                           value="{{ $option->optionId }}"
                                           class="form-check-input" required>
                                    <label for="option{{ $option->optionId }}" class="form-check-label">
                                        {{ $option->optionText }}
                                    </label>
                                </div>
                            @endforeach
                        @else
                            <textarea
                                name="answers[{{ $question->questionId }}]"
                                class="form-control"
                                rows="3"
                                required></textarea>
                        @endif
                    </div>
                @endforeach

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Enviar respuestas</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
