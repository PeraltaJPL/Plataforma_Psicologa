<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Grupos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/stylesHome.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/stylosVistas.css') }}">
</head>

<body>
  <!-- Barra superior -->
  <nav class="navbar navbar-dark bg-dark bg-gradient">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1">GRUPOS DEL ITSH</span>
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
      <div id="sidebar" class="sidebar sidebar-collapsed col-md-2 bg-dark">
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
          <li class="nav-item p-3 card-body bg-light bg-opacity-10 border rounded">
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
          <li class="nav-item p-3">
            <a href="{{route('notas.create')}}" class="links_Listas">
              <i class="bi bi-card-text"></i> Notas</a>
          </li>
          <li class="nav-item p-3">
            <a href="{{route('logout')}}" class="links_Listas">
              <i class="bi bi-box-arrow-right"></i>Cerrar Sesión
            </a>
          </li>
        </ul>
      </div>

      <!-- Las listas de los diferentes Grupos-->
      <div class="col-md-10 bg-light p-4">
        <div class="row justify-content-center">

          <div class="col-md-5 py-2">
            <div class="card text-center shadow-lg">
              <div class="card-body">
                <img src="" alt="" class="mb-3">
                <h5 class="card-title">ISIC</h5>
                {{-- <p>Descripción.</p> --}}
                <img src="{{asset('assets/images/logoISIC.png')}}" alt="Ingeniería Industrial" class="img-fluid" width="200em" height="70em">
                <!-- <a href="{{route('pacientes.index')}}" class="btn btn-info">Continuar</a> -->
                <br>
                <br>
                <a href="{{ route('pacientes.index', ['career' => 'ISIC']) }}" class="btn btn-info">Continuar</a>

              </div>
            </div>
          </div>

          <div class="col-md-5 py-2">
            <div class="card text-center shadow-lg">
              <div class="card-body">
                <img src="" alt="" class="mb-3">
                <h5 class="card-title">IIAL</h5>
                {{-- <p>Descripción.</p> --}}
                <img src="{{asset('assets/images/logoIIAL.png')}}" alt="Ingeniería Industrial" class="img-fluid" width="167em" height="70em">
                <!-- <a href="{{route('pacientes.index')}}" class="btn btn-info">Continuar</a> -->
                <br>
                <br>
                <a href="{{ route('pacientes.index', ['career' => 'IIAL']) }}" class="btn btn-info">Continuar</a>

              </div>
            </div>
          </div>

          <div class="col-md-5 py-2">
            <div class="card text-center shadow-lg">
              <div class="card-body">
                <img src="" alt="" class="mb-3">
                <h5 class="card-title">IGEM</h5>
                {{-- <p>Descripción.</p> --}}
                <img src="{{asset('assets/images/logoIGEM.png')}}" alt="Ingeniería Industrial" class="img-fluid" width="192em" height="70em">
                <!-- <a href="{{route('pacientes.index')}}" class="btn btn-info">Continuar</a> -->
                <br>
                <br>
                <a href="{{ route('pacientes.index', ['career' => 'IGEM']) }}" class="btn btn-info">Continuar</a>
              </div>
            </div>
          </div>

          <div class="col-md-5 py-2">
            <div class="card text-center shadow-lg">
              <div class="card-body">
                <img src="" alt="" class="mb-3">
                <h5 class="card-title">IIND</h5>
                {{-- <p>Descripción.</p> --}}
                <img src="{{asset('assets/images/logo_IIND.png')}}" alt="Ingeniería Industrial" class="img-fluid" width="200em" height="70em">
                <!-- <a href="{{route('pacientes.index')}}" class="btn btn-info">Continuar</a> -->
                <br>
                <br>
                <a href="{{ route('pacientes.index', ['career' => 'IIND']) }}" class="btn btn-info">Continuar</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/ajustesVistas.js') }}"></script>
</body>
</html>
