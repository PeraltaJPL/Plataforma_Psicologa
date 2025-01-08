// document.addEventListener('DOMContentLoaded', function() {
//     const agregarNotaBtn = document.getElementById('agregarNotaBtn');
//     const guardarNotaBtn = document.getElementById('guardarNotaBtn');
//     const notaModal = new bootstrap.Modal(document.getElementById('notaModal'), {});
//     const modalLabel = document.getElementById('modalLabel');
//     const tituloInput = document.getElementById('titulo');
//     const descripcionInput = document.getElementById('descripcion');
//     const notasTable = document.getElementById('notasTable');
    
//     let editando = false;
//     let filaActual = null;
  
//     // Evento para mostrar el modal de agregar nota
//     agregarNotaBtn.addEventListener('click', function() {
//       editando = false;
//       modalLabel.textContent = 'Agregar Nota';
//       tituloInput.value = '';
//       descripcionInput.value = '';
//       notaModal.show();
//     });
  
//     // Evento para guardar la nota
//     guardarNotaBtn.addEventListener('click', function() {
//       const titulo = tituloInput.value.trim();
//       const descripcion = descripcionInput.value.trim();
  
//       if (titulo === '' || descripcion === '') {
//         alert('Por favor, completa todos los campos.');
//         return;
//       }
  
//       if (editando && filaActual) {
//         // Editar nota existente
//         filaActual.cells[0].textContent = titulo;
//         filaActual.cells[1].textContent = descripcion;
//       } else {
//         // Agregar nueva nota
//         const nuevaFila = notasTable.insertRow();
//         nuevaFila.innerHTML = `
//           <td>${titulo}</td>
//           <td>${descripcion}</td>
//           <td>
//             <button class="btn btn-info btn-sm editarBtn">Editar</button>
//             <button class="btn btn-danger btn-sm eliminarBtn">Eliminar</button>
//           </td>
//         `;
  
//         agregarEventosAcciones(nuevaFila);
//       }
  
//       notaModal.hide();
//     });
  
//     // Función para agregar eventos a las acciones de editar y eliminar
//     function agregarEventosAcciones(fila) {
//       const editarBtn = fila.querySelector('.editarBtn');
//       const eliminarBtn = fila.querySelector('.eliminarBtn');
  
//       // Evento de editar
//       editarBtn.addEventListener('click', function() {
//         editando = true;
//         filaActual = fila;
//         modalLabel.textContent = 'Editar Nota';
//         tituloInput.value = fila.cells[0].textContent;
//         descripcionInput.value = fila.cells[1].textContent;
//         notaModal.show();
//       });
  
//       // Evento de eliminar
//       eliminarBtn.addEventListener('click', function() {
//         if (confirm('¿Estás seguro de que deseas eliminar esta nota?')) {
//           fila.remove();
//         }
//       });
//     }
  
//     // Agregar eventos a las notas iniciales en la tabla
//     document.querySelectorAll('#notasTable tr').forEach(agregarEventosAcciones);
//   });
  