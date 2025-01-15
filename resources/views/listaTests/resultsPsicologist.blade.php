<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados del Test</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h1 class="display-6 mb-0">Resultados del Test: {{ $testName }}</h1>
            </div>

            <div class="card-body">
                @if ($questions->isNotEmpty())
                    <div class="bg-light p-4 rounded-3 border">
                        <div class="row">
                            <div class="col-12">
                                <h2>Detalles del Test y Resultado</h2>
                                <div class="alert alert-info shadow-sm">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-info-circle-fill me-2 fs-4"></i>
                                        <h4 class="mb-0">Interpretación:</h4>
                                    </div>
                                    <p class="lead mb-0">{!! nl2br(e($result->result)) !!}</p>
                                </div>
                                <ul class="list-group shadow-sm">
                                    @foreach ($questions as $question)
                                        <p><strong>Pregunta:</strong> {!! nl2br(e($question['question_text'])) !!}</p>
                                        <p><strong>Respuesta:</strong> {!! nl2br(e($question['answer_text'])) !!}</p>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning shadow-sm">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
                            <p class="mb-0">No se encontraron resultados para este test.</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="card-footer bg-light">
                <a href="{{ route('listaTests.aplicacionTest') }}" class="btn btn-primary">
                    <i class="bi bi-arrow-left me-2"></i>Regresar
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
