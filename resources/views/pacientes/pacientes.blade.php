<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/stylesPacientes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/stylosVistas.css') }}">
</head>

<body>

    <nav class="navbar navbar-dark bg-dark bg-gradient">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">PACIENTES</span>
            <span class="navbar-text text-white">
                <a href="{{ route('profile.show') }}" class="links_Listas">
                    <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto de perfil" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;"></i>{{ $user->username ?? ($user->name ?? 'Usuario') }}
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
                            <i class="bi bi-box-arrow-right"></i>Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contenido Principal -->
            <div class="col-md-10 bg-light p-4">
                <h1>Pacientes {{ $career ?? 'Todos los Grupos' }}</h1>

                <a href="{{ route('pacientes.create', ['career' => $career]) }}" class="btn btn-primary mb-3">Agregar
                    Paciente</a>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>No. Control</th>
                            <th>Carrera</th>
                            <th>Ciclo Escolar</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            @if ($user->role === 'patient')
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->controlNumber }}</td>
                                    <td>{{ $user->career }}</td>
                                    <td>{{ $user->schoolCycle }}</td>
                                    <td>
                                        <a href="{{ route('pacientes.edit', $user->id) }}"
                                            class="btn btn-warning">Editar</a>
                                        <form action="{{ route('pacientes.destroy', $user->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="career" value="{{ $career }}">
                                            <button class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No hay pacientes registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
