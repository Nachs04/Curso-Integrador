document.getElementById('btnMostrarClientes').addEventListener('click', function() {
    // Realizamos la petición AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/fetch_clients.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var clientes = JSON.parse(xhr.responseText);
            var tablaBody = document.getElementById('clientesBody');
            tablaBody.innerHTML = '';  // Limpiar la tabla antes de insertar nuevos datos

            // Recorrer los datos de clientes y agregarlos a la tabla
            clientes.forEach(function(cliente) {
                var fila = document.createElement('tr');

                var tdCorreo = document.createElement('td');
                tdCorreo.textContent = cliente.correo;
                fila.appendChild(tdCorreo);

                var tdNombre = document.createElement('td');
                tdNombre.textContent = cliente.nombre_cli;
                fila.appendChild(tdNombre);

                var tdContraseña = document.createElement('td');
                tdContraseña.textContent = cliente.contraseña;
                fila.appendChild(tdContraseña);

                var tdFecha = document.createElement('td');
                tdFecha.textContent = cliente.fecha;
                fila.appendChild(tdFecha);

                tablaBody.appendChild(fila);
            });
        } else {
            console.error('Error al cargar los datos');
        }
    };
    xhr.send();
});
