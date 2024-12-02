document.getElementById("btnMostrarProductos").addEventListener("click", function() {
    fetch('../php/mostrar_ventas.php') // Ruta al archivo PHP que genera los datos
        .then(response => response.json())
        .then(data => {
            const tabla = document.getElementById('ventasTable');
            tabla.innerHTML = '';  // Limpiar la tabla antes de agregar los nuevos datos

            // Verificar si hay datos
            if (data.length > 0) {
                // Recorrer las ventas y agregar las filas a la tabla
                data.forEach(venta => {
                    const fila = document.createElement('tr');
                    fila.innerHTML = `
                        <td>${venta.id_venta}</td>
                        <td>${venta.nombre_producto}</td>
                        <td>${venta.cantidad}</td>
                        <td>${venta.precio}</td>
                        <td>${venta.total}</td>
                        <td>${venta.fecha}</td>
                    `;
                    tabla.appendChild(fila);
                });
            } else {
                // Si no hay datos, mostrar un mensaje
                const mensaje = document.createElement('tr');
                mensaje.innerHTML = '<td colspan="6" class="text-center">No hay ventas registradas</td>';
                tabla.appendChild(mensaje);
            }
        })
        .catch(error => console.error('Error al cargar las ventas:', error));
});
