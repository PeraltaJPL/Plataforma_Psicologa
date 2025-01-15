<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test Psicologicos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/stylesHome.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/stylosVistas.css') }}">
</head>

<body>

    @php
    $roles = [
<<<<<<< Updated upstream
        'admin' => 'Administrador',
        'user' => 'Usuario',
        'patient' => 'Paciente',
    ];
@endphp
  <!-- Barra superior -->
  <nav class="navbar navbar-dark bg-dark bg-gradient">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1">TEST</span>
      <span class="navbar-text text-white">
        <a href="{{route('profile.show')}}" class="links_Listas">
            <i class="bi bi-person-circle"> </i>{{ $user->username ?? $user->name ?? 'Usuario' }}
        </a>
      </span>
    </div>
  </nav>
=======
    'admin' => 'Administrador',
    'user' => 'Usuario',
    'patient' => 'Paciente',
    ];
    @endphp
    <!-- Barra superior -->
    <nav class="navbar navbar-dark bg-dark bg-gradient">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">TEST</span>
            <span class="navbar-text text-white">
                <a href="{{ route('profile.show') }}" class="links_Listas">
                    <!-- Mostrar la imagen de perfil del usuario o la imagen predeterminada -->
                    <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto de perfil" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                    {{ $user->username ?? $user->name ?? 'Usuario' }}
                </a>
            </span>
>>>>>>> Stashed changes

        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">

<<<<<<< Updated upstream
      <!-- Sidebar -->
      <div id="sidebar" class="sidebar sidebar-collapsed col-md-2 bg-dark">
          <ul class="nav flex-column text-white">
            @if(Auth::check() && Auth::user()->role === 'admin')
                <li class="nav-item p-3">
                    <a href="{{ route('Inicio.home') }}" class="links_Listas">
                        <i class="bi bi-house"></i> Inicio
                    </a>
                </li>
            @endif
=======
            <!-- Sidebar -->
            <div id="sidebar" class="sidebar sidebar-collapsed col-md-2 bg-dark vh-1000">
                <ul class="nav flex-column text-white">
                    @if (Auth::check() && Auth::user()->role === 'admin')
                    <li class="nav-item p-3">
                        <a href="{{ route('Inicio.home') }}" class="links_Listas">
                            <i class="bi bi-house"></i> Inicio
                        </a>
                    </li>
                    @endif
>>>>>>> Stashed changes


                <!-- Mostrar solo la sección de tests si el usuario es un paciente -->
                <li class="nav-item p-3 card-body bg-light bg-opacity-10 border rounded">
                    <a href="{{ route('listaTests.aplicacionTest') }}" class="links_Listas">
                        <i class="bi bi-journal-text"></i> Tests
                    </a>
                </li>


<<<<<<< Updated upstream
            <!-- Resto de las secciones se ocultarán para los pacientes -->
            @if(Auth::check() && Auth::user()->role === 'admin')
                <li class="nav-item p-3">
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
            @endif

            <li class="nav-item p-3">
                <a href="{{ route('logout') }}" class="links_Listas">
                    @csrf
                    <i class="bi bi-box-arrow-right"></i>Cerrar Sesión
                  </a>
            </li>
        </ul>
    </div>

    <div class="col-md-10 bg-light p-4">
        @if(Auth::check() && Auth::user()->role !== 'psychologist')
            <div class="row justify-content-center">
                @foreach ($tests as $test)
                <div class="col-md-5 py-2">
                    <div class="card text-center shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title">{{ $test->name }}</h5>
                            <p>Te invitamos a contestar este test</p>
                            <a href="{{ route('tests.show', $test->testId) }}" class="btn btn-info">Continuar</a>
=======
                    <!-- Resto de las secciones se ocultarán para los pacientes -->
                    @if (Auth::check() && Auth::user()->role === 'admin')
                    <li class="nav-item p-3">
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
                    @endif

                    <li class="nav-item p-3">
                        <a href="{{ route('logout') }}" class="links_Listas">
                            @csrf
                            <i class="bi bi-box-arrow-right"></i>Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-10 bg-light p-4 vh-1000">
                @if (Auth::check() && Auth::user()->role !== 'psychologist')
                <div class="row justify-content-center">
                    @foreach ($tests as $test)
                    <div class="col-md-5 py-2">
                        <div class="card text-center shadow-lg">
                            <div class="card-body">
                                <h5 class="card-title">{{ $test->name }}</h5>
                                <p>Te invitamos a contestar este test</p>
                                <a href="{{ route('tests.show', $test->testId) }}"
                                    class="btn btn-info btn-continue">Continuar</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if (Auth::check() && Auth::user()->role === 'admin')
                <div class="row mt-4">
                    <div class="col text-center">
                        <button id="disable-buttons" class="btn btn-warning">Desactivar Test</button>
                        <button id="enable-buttons" class="btn btn-success">Activar Test</button>
                    </div>
                </div>
                @endif
                @endif

                <!-- Tabla de resultados de tests -->
                @if (Auth::check() && Auth::user()->role === 'admin')
                <!-- Contenedor de la tabla con scroll -->
                <div class="container mt-5">
                    <div class="card p-5 shadow-lg">

                        <h4>Resultados de los Tests</h4>

                        <!-- Campos de búsqueda -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <input type="text" id="searchName" class="form-control"
                                    placeholder="Buscar por nombre">
                            </div>
                            <div class="col-md-4">
                                <input type="text" id="searchControl" class="form-control"
                                    placeholder="Buscar por N.Control">
                            </div>
>>>>>>> Stashed changes
                        </div>

                        <!-- Contenedor para el scroll -->
                        <div style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered" id="resultsTable">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Test Realizado</th>
                                        <th>N.Control</th>
                                        <th>Carrera</th>
                                        <th>Roles</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testResults as $result)
                                    <tr>
                                        <td>{{ $result->User->name ?? 'N/A' }}</td>
                                        <td>{{ $result->test->name }}</td>
                                        <td>{{ $result->User->controlNumber ?? 'N/A' }}</td>
                                        <td>{{ $result->User->career ?? 'N/A' }}</td>
                                        <td>{{ $roles[$result->User->role] ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('tests.resultsPsicologist', ['id' => $result->resultId, 'testId' => $test->testId]) }} "
                                                class="btn btn-info">
                                                Ver Resultados
                                            </a>
                                            <!-- PDF -->
                                            <a href="{{ route('tests.downloadPDF', $result->resultId) }}"
                                                class="btn btn-secondary">
                                                Descargar PDF
                                            </a>



                                            <br>
                                            <br>
                                            <form action="{{ route('listaTests.destroy', $result->resultId) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">
                                                    Eliminar Resultados
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
<<<<<<< Updated upstream
                @endforeach
=======

                @endif
>>>>>>> Stashed changes
            </div>
        @endif

        <!-- Tabla de resultados de tests -->
        @if(Auth::check() && Auth::user()->role === 'admin')
        <div class="container mt-5">
            <div class="card p-5 shadow-lg">

            <h4>Resultados de los Tests</h4>
        
            <!-- Campos de búsqueda -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="searchName" class="form-control" placeholder="Buscar por nombre">
                </div>
                <div class="col-md-4">
                    <input type="text" id="searchControl" class="form-control" placeholder="Buscar por N.Control">
                </div>
            </div>
        
            <!-- Tabla de resultados -->
            <table class="table table-bordered" id="resultsTable">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Test Realizado</th>
                        <th>N.Control</th>
                        <th>Carrera</th>
                        <th>Roles</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($testResults as $result)
                    <tr>
                        <td>{{ $result->User ->name ?? 'N/A' }}</td>
                        <td>{{ $result->test->name }}</td>
                        <td>{{ $result->User ->controlNumber ?? 'N/A' }}</td>
                        <td>{{ $result->User ->career ?? 'N/A' }}</td>
                        <td>{{ $roles[$result->User ->role] ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('tests.resultsPsicologist', $result->resultId) }}" class="btn btn-info">Ver Resultados</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            </div>
        </div>
        @endif
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/ajustesVistas.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Obtener referencias a los campos de búsqueda
        const searchName = document.getElementById('searchName');
        const searchControl = document.getElementById('searchControl');

        // Obtener referencia a la tabla y sus filas
        const table = document.getElementById('resultsTable');
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        // Función para filtrar la tabla
        function filterTable() {
            const nameValue = searchName.value.toLowerCase();
            const controlValue = searchControl.value.toLowerCase();

            // Recorrer todas las filas de la tabla
            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const nameCell = row.getElementsByTagName('td')[0].textContent.toLowerCase();
                const controlCell = row.getElementsByTagName('td')[2].textContent.toLowerCase();

                // Verificar si el nombre y el número de control coinciden con la búsqueda
                const nameMatch = nameCell.includes(nameValue);
                const controlMatch = controlCell.includes(controlValue);

                // Mostrar u ocultar la fila según coincida
                if (nameMatch && controlMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }

        // Escuchar cambios en los campos de búsqueda
        searchName.addEventListener('input', filterTable);
        searchControl.addEventListener('input', filterTable);
    });
</script>
</body>

</html>