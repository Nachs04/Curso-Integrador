// Corregir el nombre de la función y eventos
document.getElementById('btnMostrarColaborador').addEventListener('click', function() {
    var searchTerm = document.getElementById("searchBar").value; // Obtener el término de búsqueda
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/mostrarColaborador.php?search=' + searchTerm, true); // Enviar búsqueda
    xhr.onload = function() {
        if (xhr.status === 200) {
            var colaboradores = JSON.parse(xhr.responseText);
            var tablaBody = document.getElementById('clientesBody');
            tablaBody.innerHTML = '';  // Limpiar la tabla antes de insertar nuevos datos

            // Recorrer los datos de colaboradores y agregarlos a la tabla
            colaboradores.forEach(function(colaborador) {
                var fila = document.createElement('tr');

                // Crear y agregar la columna "Id" (cod_colaborador)
                var tdId = document.createElement('td');
                tdId.textContent = colaborador.cod_colaborador;
                fila.appendChild(tdId);

                // Crear y agregar la columna "Nombre" (nombre_colaborador)
                var tdNombre = document.createElement('td');
                tdNombre.textContent = colaborador.nombre_colaborador;
                fila.appendChild(tdNombre);

                // Crear y agregar la columna "Contraseña"
                var tdContraseña = document.createElement('td');
                tdContraseña.textContent = colaborador.contraseña;
                fila.appendChild(tdContraseña);

                // Crear y agregar la columna "Estado"
                var tdEstado = document.createElement('td');
                tdEstado.textContent = colaborador.estado;
                fila.appendChild(tdEstado);

                // Agregar la fila a la tabla
                tablaBody.appendChild(fila);
            });
        } else {
            console.error('Error al cargar los datos');
        }
    };
    xhr.send();
});

// La función `mostrarColaboradores()` debe estar vinculada al evento `keyup` en la barra de búsqueda
document.getElementById("searchBar").addEventListener("keyup", function() {
    document.getElementById('btnMostrarColaborador').click(); // Dispara el click para actualizar los resultados
});
