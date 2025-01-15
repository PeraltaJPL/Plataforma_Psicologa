<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/stylesPacientes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/stylosVistas.css') }}">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark bg-gradient">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">EDITAR PACIENTES</span>
            <span class="navbar-text text-white">
                <a href="{{route('profile.show')}}" class="links_Listas">
                    <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto de perfil" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">{{ $user->username ?? $user->name ?? 'Usuario' }}
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
                        <a href="{{ route('users.index') }}" class="links_Listas">
                          <i class="bi bi-people"></i> Usuarios
                        </a>
                      </li>
                    <li class="nav-item p-3">
                        <a href="{{ route('notas.create') }}" class="links_Listas">
                            <i class="bi bi-card-text"></i> Notas
                        </a>
                    </li>
                    <li class="nav-item p-3">
                        <a href="{{ route('logout') }}" class="links_Listas">
                          @csrf
                          <i class="bi bi-box-arrow-right"></i>Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Formulario Principal -->
            <div class="col-md-10 bg-light p-4">
                <h1>Editar Paciente</h1>

                <form action="{{ route('pacientes.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="controlNumber">No. Control:</label>
                        <input type="text" name="controlNumber" id="controlNumber" class="form-control" value="{{ $user->controlNumber }}" required>
                    </div>

                    <div class="form-group">
                        <label for="career">Carrera:</label>
                        <input type="text" name="career" id="career" class="form-control" value="{{ $user->career }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="schoolCycle">Ciclo Escolar:</label>
                        <input type="text" name="schoolCycle" id="schoolCycle" class="form-control" value="{{ $user->schoolCycle }}" readonly>
                    </div>

                    <button type="submit" class="btn btn-warning mt-3">Actualizar</button>
                    <a href="{{ route('pacientes.index', ['career' => $user->career]) }}" class="btn btn-secondary mt-3">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
   <!-- JS -->
    <script src="{{ asset('assets/js/pacientes.js') }}"></script>
</body>

</html>
