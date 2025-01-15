<!DOCTYPE html>
<html>

<head>
    <title>Calendario de agenda de Eventos</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/locales-all.global.min.js'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/stylesHome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/stylesNotas.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/stylosVistas.css') }}">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark bg-gradient">
        <div class="container-fluid">
          <span class="navbar-brand mb-0 h1">CALENDARIO DE EVENTOS</span>
          <span class="navbar-text text-white">
            <a href="{{route('profile.show')}}" class="links_Listas">
                <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto de perfil" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">{{ $user->username ?? $user->name ?? 'Usuario' }}
            </a>
          </span>
        </div>
      </nav>

    <div class="container-fluid">
        <div class="row vh-100">
            <!-- Sidebar -->
            <div id="sidebar" class="sidebar sidebar-collapsed col-md-2 bg-dark">
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
                    <li class="nav-item p-3">
                        <a href="{{ route('pacientes.grupos') }}" class="links_Listas">
                            <i class="bi bi-person"></i> Pacientes
                        </a>
                    </li>
                    <li class="nav-item p-3 card-body bg-light bg-opacity-10 border rounded">
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

            <!-- Calendario -->
            <div class="col-md-10 p-3 d-flex justify-content-center">
                <div class="card h-100 w-75">
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay',
        },
        locale: 'es',
        editable: true,
        selectable: true,
        events: "{{ route('fullcalendar.events') }}",
        
        dateClick: function(info) {
            $('#eventStart').val(info.dateStr);
            $('#eventEnd').val(info.dateStr);
            $('#addEventModal').modal('show');
        },
        
            eventClick: function(info) {
            $('#deleteEventModal').modal('show');
            $('#confirmDeleteEvent').off('click').on('click', function() {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('fullcalendar.events.destroy') }}",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        eventId: info.event.id,
                    },
                    success: function(response) {
                        if (response.success) {
                            info.event.remove();
                            $('#deleteEventModal').modal('hide');

                            // Mostrar el modal de confirmación
                            $('#confirmationMessage').text('Evento eliminado.');
                            $('#confirmationModal').modal('show');
                        } else {
                            alert(response.message || 'Error al eliminar el evento.');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Ocurrió un error en el servidor.');
                    }
                });
            });
        }
    });

    $('#addEventForm').on('submit', function(e) {
        e.preventDefault();
        var title = $('#eventTitle').val();
        var start = $('#eventStart').val();
        var end = $('#eventEnd').val();

        $.ajax({
            url: "{{ route('fullcalendar.events.add') }}",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                title: title,
                start: start,
                end: end
            },
            type: "POST",
            success: function(data) {
                calendar.addEvent({
                    id: data.id,
                    title: title,
                    start: start,
                    end: end,
                    allDay: false
                });
                $('#addEventModal').modal('hide');
                calendar.render();
            }
        });
    });

    calendar.render();
});

    </script>
    <!-- Modal para Agregar Evento -->
<div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="addEventForm">
          <div class="modal-header">
            <h5 class="modal-title" id="addEventModalLabel">Agregar Evento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="eventTitle" class="form-label">Nombre del Evento</label>
              <input type="text" class="form-control" id="eventTitle" name="title" required>
            </div>
            <div class="mb-3">
              <label for="eventStart" class="form-label">Inicio</label>
              <input type="datetime-local" class="form-control" id="eventStart" name="start" required>
            </div>
            <div class="mb-3">
              <label for="eventEnd" class="form-label">Fin</label>
              <input type="datetime-local" class="form-control" id="eventEnd" name="end" required>
            </div>
          </div>          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <!-- Modal para Confirmar Eliminación -->
  <div class="modal fade" id="deleteEventModal" tabindex="-1" aria-labelledby="deleteEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteEventModalLabel">Eliminar Evento</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ¿Estás seguro de que deseas eliminar este evento?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteEvent">Eliminar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para Mensajes de Confirmación -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body text-center">
          <p id="confirmationMessage"></p>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
  
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/ajustesVistas.js') }}"></script>
    <script src="{{ asset('assets/js/notas.js') }}"></script>
</body>

</html>
