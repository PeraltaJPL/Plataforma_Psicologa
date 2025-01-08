<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendario de Eventos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/stylesCalendario.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/stylosVistas.css') }}">
</head>

<body>
  <!-- Barra superior -->
  <nav class="navbar navbar-dark bg-dark bg-gradient">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1">INICIO</span>
      <span class="navbar-text text-white">
        <a href="#" class="links_Listas">
          {{ $user->username ?? $user->name ?? 'Usuario' }}
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
          <li class="nav-item p-3 card-body bg-light bg-opacity-10 border rounded">
            <a href="{{route('calendario.calendarioEventos')}}" class="links_Listas">
              <i class="bi bi-calendar"></i> Calendario de Eventos
            </a>
          </li>
          <li class="nav-item p-3">
            <a href="{{route('notas.notas')}}" class="links_Listas">
              <i class="bi bi-card-text"></i> Notas</a>
          </li>
          <li class="nav-item p-3">
            <a href="{{route('InicioSesion.inisioSesion')}}" class="links_Listas">
              <i class="bi bi-box-arrow-right"></i>Cerrar Sesión
            </a>
          </li>
        </ul>
      </div>

      <!-- Contenido principal -->
      <div class="col-md-10 bg-light p-4">
        <div class="row justify-content-center">
          <!-- Calendario de Consultas -->
          <div class="col-md-5">
            <div class="card text-center shadow-lg">
              <div class="card-body">
                <img src="https://www.gstatic.com/images/branding/product/1x/calendar_2020q4_48dp.png" alt="Icono Calendario" class="mb-3">
                <h5 class="card-title">CALENDARIO DE EVENTOS</h5>
                <p>Gestión sobre las consultas médicas. Consulta horarios y detalles de tus próximas visitas.</p>
                <a href="{{route('calendario.cEventos')}}" class="btn btn-info">Continuar</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/calEvento.js') }}"></script>
  <script src="{{ asset('assets/js/ajustesVistas.js') }}"></script>
</body>

</html>
