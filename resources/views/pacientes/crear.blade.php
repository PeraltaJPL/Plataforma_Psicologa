<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/stylesPacientes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/stylosVistas.css') }}">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark bg-gradient">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Agregar Paciente</span>
            <span class="navbar-text text-white">
                <a href="#" class="links_Listas">
                    <i class="bi bi-person-circle"></i> Mayra Salazar García
                </a>
            </span>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div id="sidebar" class="sidebar sidebar-collapsed col-md-2 bg-dark vh-100">
                <ul class="nav flex-column text-white">
                    <li class="nav-item p-3">
                        <a href="{{ route('Inicio.home') }}" class="links_Listas">
                            <i class="bi bi-house"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item p-3">
                        <a href="{{ route('listaTests.aplicacionTest') }}" class="links_Listas">
                            <i class="bi bi-journal-text"></i> Tests
                        </a>
                    </li>
                    <li class="nav-item p-3 card-body bg-light bg-opacity-10 border rounded">
                        <a href="{{ route('pacientes.grupos') }}" class="links_Listas">
                            <i class="bi bi-person"></i> Pacientes
                        </a>
                    </li>
                    <li class="nav-item p-3">
                        <a href="{{ route('calendario.index') }}" class="links_Listas">
                            <i class="bi bi-calendar"></i> Calendario de Eventos
                        </a>
                    </li>
                    <li class="nav-item p-3">
                        <a href="{{ route('notas.create') }}" class="links_Listas">
                            <i class="bi bi-card-text"></i> Notas
                        </a>
                    </li>
                    <li class="nav-item p-3">
                        <a href="{{ route('InicioSesion.inisioSesion') }}" class="links_Listas">
                            <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Formulario Principal -->
            <div class="col-md-10 bg-light p-4">
                <h1>Agregar Paciente</h1>

                <form action="{{ route('pacientes.store') }}" method="POST">
                    @csrf
                    <!-- Campo oculto para enviar el valor original de la carrera -->
                    <input type="hidden" name="career" value="{{ $career }}">

                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="controlNumber">No. Control:</label>
                        <input type="text" name="controlNumber" id="controlNumber" class="form-control" required
                            oninput="calculateSchoolCycle('controlNumber', 'schoolCycle')">
                    </div>
                    <div class="form-group">
                        <label for="career">Carrera:</label>
                        <input type="text" name="career" id="career" class="form-control" value="{{ $career }}" required>
                    </div>
                    <div class="form-group">
                        <label for="schoolCycle">Ciclo Escolar:</label>
                        <input type="text" name="schoolCycle" id="schoolCycle" class="form-control" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                    <a href="{{ route('pacientes.index', ['career' => $career]) }}" class="btn btn-secondary mt-3">Cancelar</a>
                </form>
            </div>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
   <!-- JS -->
    <script src="{{ asset('assets/js/pacientes.js') }}"></script>

</body>

</html>
