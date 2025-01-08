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
          <span class="navbar-brand mb-0 h1">INICIO</span>
          <span class="navbar-text text-white">
            <a href="#" class="links_Listas">
              {{ $user->username ?? $user->name ?? 'Usuario' }}
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
                        <a href="{{ route('notas.create') }}" class="links_Listas">
                            <i class="bi bi-card-text"></i> Notas</a>
                    </li>
                    <li class="nav-item p-3">
                        <a href="{{ route('InicioSesion.inisioSesion') }}" class="links_Listas">
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
                /** -------------------------------------------------------------
                 * creacion de eventos
                 */
                dateClick: function(info) {
                    var title = prompt('Agrega un nuevo evento:');
                    if (title) {
                        var start = moment(info.dateStr).format('Y-MM-DD');
                        var end = moment(info.dateStr).format('Y-MM-DD');

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
                                    start: end,
                                    allDay: false
                                });
                                calendar.render();
                            }
                        });
                    }
                },
                /** -------------------------------------------------------------
                 * Eliminación de eventos
                 */
                eventClick: function(info) {
                    var deleteMsg = confirm("¿Quieres eliminar este evento?");
                    if (deleteMsg) {
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
                                    alert('Evento eliminado.');
                                } else {
                                    alert(response.message ||
                                        'Error al eliminar el evento.');
                                }
                            },
                            error: function(xhr) {
                                console.error(xhr.responseText);
                                alert('Ocurrió un error en el servidor.');
                            }
                        });
                    }
                },
                /** -------------------------------------------------------------
                 * Actualización de eventos
                 */
                eventDrop: function(info) {
                    var start = moment(info.event.start).format('Y-MM-DD');
                    var end = moment(info.event.end).format('Y-MM-DD');

                    $.ajax({
                        url: "{{ route('fullcalendar.events.update') }}",
                        type: "PUT",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            title: info.event.title,
                            start: start,
                            end: end,
                            eventId: info.event.id,
                        },
                        success: function(response) {
                            if (response.success) {
                                alert('Evento actualizado.');
                            } else {
                                alert(response.message || 'Error al actualizar el evento.');
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            alert('Ocurrió un error en el servidor.');
                        }
                    });
                },
            });
            calendar.render();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/ajustesVistas.js') }}"></script>
    <script src="{{ asset('assets/js/notas.js') }}"></script>
</body>

</html>
