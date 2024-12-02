function filtrarClientes() {
    const fechaDesde = document.getElementById('fechaDesde').value;
    const fechaHasta = document.getElementById('fechaHasta').value;

    // Verificar que las fechas sean válidas
    if (!fechaDesde || !fechaHasta) {
        alert("Por favor, selecciona ambas fechas.");
        return;
    }

    // Enviar solicitud al servidor (PHP) para obtener los clientes filtrados
    fetch('../php/filtrarClientes.php', {
        method: 'POST',
        body: JSON.stringify({ fechaDesde, fechaHasta }), // Enviamos las fechas como un objeto JSON
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json()) // Esperamos un JSON en la respuesta
    .then(data => {
        const clientesBody = document.getElementById('clientesBody');
        clientesBody.innerHTML = ''; // Limpiar la tabla

        // Insertar los clientes filtrados en la tabla
        data.forEach(cliente => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${cliente.correo}</td>
                <td>${cliente.nombre_cli}</td>
                <td>${cliente.contraseña}</td>
                <td>${cliente.fecha}</td>
                <td><button class="btn btn-warning">Editar</button> <button class="btn btn-danger">Eliminar</button></td>
            `;
            clientesBody.appendChild(row);
        });
    })
    .catch(error => {
        console.error('Error al filtrar clientes:', error);
    });
}
