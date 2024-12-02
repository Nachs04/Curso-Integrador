// Mostrar colaboradores al cargar la página
function mostrarColaboradores() {
    fetch("../php/mostrarColaborador.php")
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById("colaboradoresBody");
            tbody.innerHTML = "";
            data.forEach(colaborador => {
                tbody.innerHTML += `
                    <tr>
                        <td>${colaborador.correo}</td>
                        <td>${colaborador.nombre}</td>
                        <td>${colaborador.contrasena}</td>
                        <td>${colaborador.fecha}</td>
                        <td>
                            <button onclick="editarColaborador('${colaborador.id}')" class="btn btn-warning btn-sm">Editar</button>
                            <button onclick="eliminarColaborador('${colaborador.id}')" class="btn btn-danger btn-sm">Eliminar</button>
                        </td>
                    </tr>
                `;
            });
        });
}

// Eliminar colaborador
function eliminarColaborador(id) {
    if (confirm("¿Estás seguro de eliminar este colaborador?")) {
        fetch("eliminarColaborador.php?id=" + id, { method: "GET" })
            .then(response => response.text())
            .then(data => {
                alert(data);
                mostrarColaboradores(); // Recargar la lista de colaboradores
            });
    }
}

// Editar colaborador
function editarColaborador(id) {
    const nombre = prompt("Ingresa el nuevo nombre:");
    if (nombre) {
        fetch("editarColaborador.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id, nombre })
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            mostrarColaboradores(); // Recargar la lista de colaboradores
        });
    }
}

// Filtrar colaboradores por nombre
function filterColaboradores() {
    const filter = document.getElementById("searchBar").value.toLowerCase(); // Obtener el texto de la búsqueda
    const rows = document.getElementById("colaboradoresBody").getElementsByTagName("tr"); // Obtener las filas de la tabla

    Array.from(rows).forEach(row => {
        const cells = row.getElementsByTagName("td"); // Obtener las celdas de cada fila
        const name = cells[1].textContent.toLowerCase(); // Obtener el nombre (segunda celda)

        // Comparar el nombre con el filtro de búsqueda
        row.style.display = name.includes(filter) ? "" : "none"; // Si coincide, mostrar la fila, si no ocultarla
    });
}

// Llamar a la función para mostrar los colaboradores cuando se carga la página
mostrarColaboradores();
