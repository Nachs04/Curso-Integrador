document.addEventListener("DOMContentLoaded", function() {
    // Seleccionamos el botón y la tabla
    const btnMostrarClientes = document.querySelector("#btnMostrarClientes");
    const clientesTable = document.querySelector("#clientes_table tbody");

    // Función para cargar la lista de clientes desde el servidor
    function loadClientes() {
        fetch('obtener_clientes.php')  // Hace la solicitud a obtener_clientes.php
            .then(response => response.json())  // Esperamos la respuesta en formato JSON
            .then(data => {
                // Limpiar la tabla antes de cargar nuevos datos
                clientesTable.innerHTML = '';
                
                // Verificamos si hay clientes
                if (data.length === 0) {
                    clientesTable.innerHTML = '<tr><td colspan="4">No hay clientes registrados.</td></tr>';
                    return;
                }

                // Llenamos la tabla con los datos obtenidos
                data.forEach(cliente => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${cliente.nombre}</td>
                        <td>${cliente.email}</td>
                        <td>${cliente.telefono}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editCliente(${cliente.id})">Editar</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteCliente(${cliente.id})">Eliminar</button>
                        </td>
                    `;
                    clientesTable.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Error al cargar los clientes:', error);
            });
    }

    // Evento para mostrar clientes al hacer clic en el botón
    btnMostrarClientes.addEventListener('click', function() {
        loadClientes();
    });

    // Función para eliminar un cliente
    function deleteCliente(clienteId) {
        if (confirm("¿Estás seguro de que quieres eliminar este cliente?")) {
            fetch('eliminar_cliente.php?id=' + clienteId)
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    loadClientes();  // Recargar la lista de clientes después de eliminar uno
                })
                .catch(error => console.error('Error al eliminar el cliente:', error));
        }
    }

    // Función para editar un cliente (a futuro puedes agregarla)
    function editCliente(clienteId) {
        alert('Editar cliente: ' + clienteId);
    }
});
