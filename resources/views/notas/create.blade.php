<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notas</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/stylesNotas.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/stylosVistas.css') }}">
</head>

<body>

  <nav class="navbar navbar-dark bg-dark bg-gradient">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1">NOTAS</span>
      <span class="navbar-text text-white">
        <a href="{{route('profile.show')}}" class="links_Listas">
          <i class="bi bi-person-circle"> </i>{{ $user->username ?? $user->name ?? 'Usuario' }}
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
            <a href="{{route('Inicio.home')}}" class="links_Listas">
              <i class="bi bi-house"></i> Inicio
            </a>
          </li>
          <li class="nav-item p-3">
            <a href="{{route('listaTests.aplicacionTest')}}" class="links_Listas">
              <i class="bi bi-journal-text"></i> Tests
            </a>
          </li>
          <li class="nav-item p-3">
            <a href="{{route('pacientes.grupos')}}" class="links_Listas">
              <i class="bi bi-person"></i> Pacientes
            </a>
          </li>
          <li class="nav-item p-3">
            <a href="{{route('calendario.index')}}" class="links_Listas">
              <i class="bi bi-calendar"></i> Calendario de Eventos
            </a>
          </li>
          <li class="nav-item p-3">
            <a href="{{ route('users.index') }}" class="links_Listas">
              <i class="bi bi-people"></i> Usuarios
            </a>
          </li>
          <li class="nav-item p-3 card-body bg-light bg-opacity-10 border rounded">
            <a href="{{route('notas.create')}}" class="links_Listas">
              <i class="bi bi-card-text"></i> Notas</a>
          </li>
          <li class="nav-item p-3">
            <a href="{{ route('logout') }}" class="links_Listas">
              @csrf
              <i class="bi bi-box-arrow-right"></i>Cerrar Sesión
            </a>
          </li>
        </ul>
      </div>

      <!-- Apartado de Agregar Nota -->
      <div class="col-md-10 p-3">
        <h2>Agregar nota</h2>
        <div class="container mt-5">
          <form action="{{route('store')}}" method="post">
            @csrf
            @method('POST')
            <label for="name">Agregar titulo de la nota</label>
            <input type="text" name="title" id="title" class="form-control" required>
            <label for="name">Agrega la descripcion de la nota</label>
            <input type="text" name="description" id="description" class="form-control" required>
            <button class="btn btn-primary mt-3"><i class="bi bi-plus-circle"></i> Agregar</button>
            <a href="{{route('Inicio.home')}}" class="btn btn-secondary mt-3">Cancelar</a>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Iconos de Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
  <script src="{{ asset('assets/js/notas.js') }}"></script>
  <script src="{{ asset('assets/js/ajustesVistas.js') }}"></script>
</body>

</html>