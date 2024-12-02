function buscarCliente() {
    // Obtener el valor del campo de búsqueda
    var searchQuery = document.getElementById('searchBar').value.trim();

    console.log("Buscando: " + searchQuery); // Verifica que se está llamando a la función y captura el valor del input

    // Solo realizar la búsqueda si el input no está vacío
    if (searchQuery.length > 0) {
        var xhr = new XMLHttpRequest();
        // Llamar al archivo PHP con el término de búsqueda codificado
        xhr.open('GET', '../php/buscarCliente.php?search=' + encodeURIComponent(searchQuery), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    // Parsear la respuesta JSON
                    var clientes = JSON.parse(xhr.responseText);
                    var tablaBody = document.getElementById('clientesBody');
                    tablaBody.innerHTML = ''; // Limpiar la tabla antes de insertar nuevos datos

                    if (clientes.length > 0) {
                        // Recorrer los clientes y mostrar los datos en la tabla
                        clientes.forEach(function(cliente) {
                            var fila = document.createElement('tr');

                            var tdCorreo = document.createElement('td');
                            tdCorreo.textContent = cliente.correo;
                            fila.appendChild(tdCorreo);

                            var tdNombre = document.createElement('td');
                            tdNombre.textContent = cliente.nombre_cli; // Correcto según tu base de datos
                            fila.appendChild(tdNombre);

                            var tdContraseña = document.createElement('td');
                            tdContraseña.textContent = cliente.contraseña;
                            fila.appendChild(tdContraseña);

                            var tdFecha = document.createElement('td');
                            tdFecha.textContent = cliente.fecha;
                            fila.appendChild(tdFecha);

                            // Columna de acciones
                            var tdAcciones = document.createElement('td');
                            tdAcciones.innerHTML = '<button class="btn btn-info">Editar</button>';
                            fila.appendChild(tdAcciones);

                            tablaBody.appendChild(fila);
                        });
                    } else {
                        tablaBody.innerHTML = '<tr><td colspan="5">No se encontraron resultados.</td></tr>';
                    }
                } catch (e) {
                    console.error("Error al procesar la respuesta JSON:", e);
                }
            } else {
                console.error('Error al cargar los datos. Código de estado:', xhr.status);
            }
        };
        xhr.send();
    } else {
        console.log("No se ha ingresado texto para buscar."); // Mensaje para cuando el input esté vacío
    }
}
