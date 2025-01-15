<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Enlace al archivo de estilos CSS -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/stylesPdf.css') }}"> -->
    <link rel="stylesheet" href="{{ public_path('assets/css/stylesPdf.css') }}">



    <title>Resultado del Test</title>
</head>

<body>
    <div class="header">
        <h1>Resultado del Test</h1>
    </div>

    <div class="content">
        <div class="section">
            <h2>Test: {{ $test->name }}</h2>
            <p><strong>Usuario:</strong> {{ $result->user->name }}</p>
            <p><strong>Número de Control:</strong> {{ $result->user->controlNumber ?? 'N/A' }}</p>
        </div>

        <div class="section">
            <h2>Respuestas:</h2>
            <ul>
                @foreach($testAnswers as $answer)
                <li>
                    <strong>Pregunta:</strong> {{ $answer->question->text ?? 'N/A' }}<br>
                    <strong>Respuesta:</strong> {{ $answer->answerText ?? 'N/A' }}
                </li>
                @endforeach
            </ul>
        </div>

        <div class="section">
            <h2>Resultado:</h2>
            <p>{{ $result->result }}</p>
        </div>


        <div class="footer">
            <p>Documento generado automáticamente.</p>
        </div>
    </div>
</body>

</html>