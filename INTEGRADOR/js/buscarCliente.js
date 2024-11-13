// Función que se ejecuta al escribir en el campo de búsqueda o al hacer clic en "Buscar"
document.getElementById('btnBuscarCliente').addEventListener('click', buscarCliente);
document.getElementById('searchBar').addEventListener('keyup', buscarCliente);

function buscarCliente() {
    const searchValue = document.getElementById('searchBar').value;

    // Verifica si hay texto en la barra de búsqueda
    if (searchValue.trim() !== "") {
        fetch('../php/buscarCliente.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nombre: searchValue })
        })
        .then(response => response.json())
        .then(data => {
            const clientesBody = document.getElementById('clientesBody');
            clientesBody.innerHTML = '';  // Limpiar la tabla antes de mostrar nuevos resultados

            if (data.length === 0) {
                const row = document.createElement('tr');
                row.innerHTML = `<td colspan="5" class="text-center">No se encontraron resultados</td>`;
                clientesBody.appendChild(row);
            } else {
                // Recorre los resultados y los inserta en la tabla
                data.forEach(cliente => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${cliente.correo}</td>
                        <td>${cliente.nombre_cli}</td>
                        <td>${cliente.contraseña}</td>
                        <td>${cliente.fecha}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editarCliente('${cliente.correo}')">Editar</button>
                            <button class="btn btn-danger btn-sm" onclick="eliminarCliente('${cliente.correo}')">Eliminar</button>
                        </td>
                    `;
                    clientesBody.appendChild(row);
                });
            }
        })
        .catch(error => console.error('Error al buscar cliente:', error));
    } else {
        // Si no hay texto en la barra de búsqueda, vacía la tabla
        document.getElementById('clientesBody').innerHTML = '';
    }
}
