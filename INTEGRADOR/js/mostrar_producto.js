// Función para cargar productos desde el servidor
function cargarProductos() {
    fetch("../php/mostrar_producto.php") // URL del archivo PHP
        .then((response) => response.json())
        .then((data) => {
            const tabla = document.getElementById("clientesBody");

            tabla.innerHTML = ""; // Limpiar la tabla antes de cargar los datos

            // Iterar sobre los datos y generar filas para la tabla
            data.forEach((producto) => {
                const row = `
    <tr>
        <td>${producto.ID}</td> <!-- Usamos 'ID' aquí en lugar de 'id_producto' -->
        <td>${producto.nombre_producto}</td>
        <td>S/. ${producto.precio}</td>
        <td>${producto.Estado === "1" ? "Activo" : "Inactivo"}</td> <!-- 'Estado' aquí -->
        <td>${producto.Stock}</td> <!-- 'Stock' aquí -->
        <td>${producto.cod_control_producto}</td>
        <td><img src="${producto.imagen}" alt="${producto.nombre_producto}" style="width: 100px; height: auto;"></td>
         <td>
                        <button class="btn btn-warning btn-edit" onclick="editarProducto(${producto.ID})">Editar</button>
                        <button class="btn btn-danger btn-delete" onclick="eliminarProducto(${producto.ID})">Eliminar</button>
                    </td>
    </tr>
`;

                tabla.innerHTML += row; // Añadir la fila a la tabla
            });
        })
        .catch((error) => console.error("Error al cargar los productos:", error));
}

// Asignar evento al botón
document.getElementById("btnMostrarProductos").addEventListener("click", cargarProductos);


