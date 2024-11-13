// clientes.js

// Mostrar clientes al cargar la página
function mostrarClientes() {
    fetch("mostrarClientes.php")
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById("clientesBody");
            tbody.innerHTML = "";
            data.forEach(cliente => {
                tbody.innerHTML += `
                    <tr>
                        <td>${cliente.correo}</td>
                        <td>${cliente.nombre}</td>
                        <td>${cliente.contrasena}</td>
                        <td>${cliente.fecha}</td>
                        <td>
                            <button onclick="editarCliente('${cliente.id}')" class="btn btn-warning btn-sm">Editar</button>
                            <button onclick="eliminarCliente('${cliente.id}')" class="btn btn-danger btn-sm">Eliminar</button>
                        </td>
                    </tr>
                `;
            });
        });
}

// Eliminar cliente
function eliminarCliente(id) {
    if (confirm("¿Estás seguro de eliminar este cliente?")) {
        fetch("eliminarCliente.php?id=" + id, { method: "GET" })
            .then(response => response.text())
            .then(data => {
                alert(data);
                mostrarClientes();
            });
    }
}

// Editar cliente
function editarCliente(id) {
    const nombre = prompt("Ingresa el nuevo nombre:");
    if (nombre) {
        fetch("editarCliente.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id, nombre })
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            mostrarClientes();
        });
    }
}

// Filtrar clientes
function filterClients() {
    const filter = document.getElementById("searchBar").value.toLowerCase();
    const rows = document.getElementById("clientesBody").getElementsByTagName("tr");
    Array.from(rows).forEach(row => {
        const cells = row.getElementsByTagName("td");
        const name = cells[1].textContent.toLowerCase();
        const email = cells[0].textContent.toLowerCase();
        row.style.display = (name.includes(filter) || email.includes(filter)) ? "" : "none";
    });
}
