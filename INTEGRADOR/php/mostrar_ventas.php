<?php
$servername = "localhost";
$username = "root";
$password = "G@bo1007";
$dbname = "marcosweb";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta SQL
$sql = "SELECT id_venta, nombre_producto, cantidad, precio, total, fecha FROM venta";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Crear un array para almacenar las ventas
    $ventas = array();

    // Recorrer los resultados y agregarlos al array
    while($row = $result->fetch_assoc()) {
        $ventas[] = $row;
    }

    // Devolver los resultados en formato JSON
    echo json_encode($ventas);
} else {
    echo json_encode([]); // Devolver un array vacío si no hay resultados
}

// Cerrar la conexión
$conn->close();
?>
