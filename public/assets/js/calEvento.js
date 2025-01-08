document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
  
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth', // Vista por defecto
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay' // Vistas disponibles
      },
      events: [
        {
          title: 'Consulta Médica',
          start: '2024-09-10T10:00:00',
          end: '2024-09-10T11:00:00',
          description: 'Consulta general con el Dr. Pérez',
          backgroundColor: '#28a745', // Color verde para consultas
          borderColor: '#28a745'
        },
        {
          title: 'Cena con amigos',
          start: '2024-09-12T21:30:00',
          end: '2024-09-12T23:00:00',
          description: 'Cena en restaurante',
          backgroundColor: '#007bff', // Color azul para eventos personales
          borderColor: '#007bff'
        }
      ],
      eventClick: function(info) {
        // Muestra detalles de los eventos al hacer clic
        alert('Evento: ' + info.event.title + '\nDescripción: ' + info.event.extendedProps.description);
      }
    });
  
    calendar.render();
  });
  