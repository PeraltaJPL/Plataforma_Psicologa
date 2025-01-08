<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página Principal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/stylesHome.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/stylesNotas.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/stylosVistas.css') }}">

</head>

<body>
  <!-- Barra lateral -->
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
      <div id="sidebar" class="sidebar sidebar-collapsed col-md-2 bg-dark">
        <ul class="nav flex-column text-white">
          <li class="nav-item p-3 card-body bg-light bg-opacity-10 border rounded">
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

      <!-- Contenido principal -->
      <div class="col-md-10 bg-light p-4">
        <div class="row mb-4">
          <!-- Tarjeta Pacientes -->
          <div class="col-md-6">
            <div class="card text-center shadow-lg">
              <div class="card-body">
                <h5 class="card-title">PACIENTES <br><i class="bi bi-person"></i></h5>
                <p><strong></strong></p>
                <a href="{{route('pacientes.index')}}" class="btn btn-info">Más detalles</a>
              </div>
            </div>
          </div>
          <!-- Eventos del Día -->
          <div class="col-md-6">
            <div class="card text-center shadow-lg">
              <div class="card-body">
                <h5 class="card-title">EVENTOS EL DÍA DE HOY <i class="bi bi-calendar"></i></h5>
                <table class="table">
                  <thead class="bg-primary bg-opacity-75">
                    <tr>
                      <th>Título</th>
                      {{-- <th>Descripción</th> --}}
                      {{-- <th>Hora</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($todayEvents as $event)
                    <tr>
                      <td>{{ $event->title }}</td>
                      {{-- <td>{{ \Carbon\Carbon::parse($event->start)->format('H:i') }}</td> --}}
                    </tr>
                    @empty
                    <tr>
                      <td colspan="1">No hay eventos el día de hoy</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

          
        

        <div class="row mb-4">
          <!-- Proximos 3 eventos -->
          <div class="col-md-6">
            <div class="card text-center shadow-lg">
              <div class="card-body">
                <h5 class="card-title">PROXIMOS 3 EVENTOS <i class="bi bi-calendar3-week"></i></h5>
                <table class="table">
                  <thead class="bg-primary bg-opacity-75">
                    <tr>
                      <th>Título</th>
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($nextThreeEvents as $event)
                    <tr>
                      <td>{{ $event->title }}</td>
                      <td>{{ \Carbon\Carbon::parse($event->start)->format('d-m-Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="2">No hay próximos eventos</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- Últimos 3 eventos -->
          <div class="col-md-6">
            <div class="card text-center shadow-lg">
              <div class="card-body">
                <h5 class="card-title">ÚLTIMOS 3 EVENTOS <i class="bi bi-calendar-check"></i></h5>
                <table class="table">
                  <thead class="bg-primary bg-opacity-75">
                    <tr>
                      <th>Título</th>
                      {{-- <th>Descripción</th> --}}
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($lastThreeEvents as $event)
                    <tr>
                      <td>{{ $event->title }}</td>
                      <td>{{ \Carbon\Carbon::parse($event->start)->format('d-m-Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="2">No hay eventos recientes</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- Notas y últimos eventos -->
        <div class="row mb-4">
          <!-- Notas -->
          <div class="col-md-12">
            <div class="card text-center shadow-lg">
              <div class="card-body">
                <h5 class="card-title">NOTAS <i class="bi bi-card-text"></i></h5>
                <!-- Tabla de notas -->
                <table class="table table-bordered bg-primary bg-opacity-75">
                  <thead>
                    <tr>
                      <th>Título</th>
                      <th>Descripción</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="notasTable" class="bg-light">
                    @forelse ($items as $item)
                    <tr>
                      <td>{{$item->title}}</td>
                      <td>{{$item->description}}</td>
                      <td>
                        <form action="{{route('destroy', $item->noteId)}}" method="post">
                          @csrf
                          @method('DELETE')
                          {{-- <a href="" class="btn btn-info">
                            <i class="bi bi-list-task"></i> Mostrar
                          </a> --}}
                          <a href="{{route('notas.edit', $item->noteId)}}" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i> Editar
                          </a>
                          <button class="btn btn-danger">
                            <i class="bi bi-recycle"></i> Eliminar
                          </button>
                        </form>
                      </td>
                      {{-- <td colspan="3">No hay eventos el día de hoy</td> --}}
                    </tr>
                    @empty
                    <tr>
                      <td colspan="3">No hay notas</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <div class="text-end p-2">
                <a href="{{route('notas.create')}}" class="decoration">
                  <button class="btn btn-primary mb-3">
                    {{-- <a href="{{route('notas.create')}}" class="btn btn-info"></a> --}}
                <i class="bi bi-zoom-in"></i> Agregar Nota
                </button>
                </a>

                {{-- <button id="agregarNotaBtn" class="btn btn-primary mb-3">
                  <i class="bi bi-plus-circle"></i> Agregar Nota
                </button> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="notaModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('store')}}" method="post">
          @csrf
          @method('POST')
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Agregar Nota</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="notaForm">
              <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="title" class="form-control" id="titulo" required>
              </div>
              <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" name="description" id="descripcion" rows="3" required></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="guardarNotaBtn">Guardar Nota</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/ajustesVistas.js') }}"></script>
  <script src="{{ asset('assets/js/notas.js') }}"></script>
</body>

</html>
