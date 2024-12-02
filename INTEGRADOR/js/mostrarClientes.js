document.getElementById('btnMostrarClientes').addEventListener('click', function () {
    var searchTerm = document.getElementById("searchBar").value; // Obtener el término de búsqueda
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/mostrar_clientes.php?search=' + encodeURIComponent(searchTerm), true); // Enviar búsqueda
    xhr.onload = function () {
        if (xhr.status === 200) {
            var clientes = JSON.parse(xhr.responseText); // Parsear la respuesta como JSON
            var tablaBody = document.getElementById('clientesBody');
            tablaBody.innerHTML = ''; // Limpiar la tabla antes de insertar nuevos datos

            // Recorrer los datos de clientes y agregarlos a la tabla
            clientes.forEach(function (cliente) {
                var fila = document.createElement('tr');
                fila.setAttribute('data-id', cliente.id); // Agregar el id del cliente como atributo de la fila

                // Crear y agregar la columna "Correo"
                var tdCorreo = document.createElement('td');
                tdCorreo.textContent = cliente.correo;
                fila.appendChild(tdCorreo);

                // Crear y agregar la columna "Nombre"
                var tdNombre = document.createElement('td');
                tdNombre.textContent = cliente.nombre_cli;
                fila.appendChild(tdNombre);

                // Crear y agregar la columna "Contraseña"
                var tdContraseña = document.createElement('td');
                tdContraseña.textContent = cliente.contraseña;
                fila.appendChild(tdContraseña);

                // Crear y agregar la columna "Fecha"
                var tdFecha = document.createElement('td');
                tdFecha.textContent = cliente.fecha;
                fila.appendChild(tdFecha);

                // Crear y agregar la columna "Acciones" (botones Editar y Eliminar)
                var tdAcciones = document.createElement('td');

                // Botón Editar
                var btnEditar = document.createElement('button');
                btnEditar.textContent = 'Editar';
                btnEditar.className = 'btn btn-primary btn-sm';
                btnEditar.addEventListener('click', function () {
                    console.log('Editar cliente:', cliente.id); // Aquí puedes implementar la funcionalidad de edición
                });
                tdAcciones.appendChild(btnEditar);

                // Botón Eliminar
                var btnEliminar = document.createElement('button');
                btnEliminar.textContent = 'Eliminar';
                btnEliminar.className = 'btn btn-danger btn-sm ms-2'; // Clase para diseño (Bootstrap)
                btnEliminar.addEventListener('click', function () {
                    if (confirm('¿Estás seguro de que deseas eliminar este cliente?')) {
                        eliminarCliente(cliente.id, fila); // Llama a la función eliminarCliente pasando la fila
                    }
                });
                tdAcciones.appendChild(btnEliminar);

                // Agregar la columna de acciones a la fila
                fila.appendChild(tdAcciones);

                // Agregar la fila a la tabla
                tablaBody.appendChild(fila);
            });
        } else {
            console.error('Error al cargar los datos');
        }
    };
    xhr.send();
});

// Evento para filtrar en tiempo real al escribir en la barra de búsqueda
document.getElementById("searchBar").addEventListener("keyup", function () {
    document.getElementById('btnMostrarClientes').click(); // Dispara el evento para actualizar los resultados
});

// Función para eliminar cliente
function eliminarCliente(filaIndex) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../php/eliminar_cliente.php', true); // Asegúrate de tener este archivo PHP configurado
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert('Cliente eliminado correctamente');
                document.getElementById('btnMostrarClientes').click(); // Actualiza la tabla
            } else {
                alert('Error al eliminar el cliente');
            }
        } else {
            console.error('Error al eliminar el cliente');
        }
    };
    xhr.send('index=' + encodeURIComponent(filaIndex)); // Enviar el índice de la fila
}

