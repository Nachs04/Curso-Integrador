<?php
// Configuración de la base de datos
$host = "localhost";
$user = "root";
$password = "G@bo1007";
$dbname = "marcosweb"; // Cambia al nombre de tu base de datos

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener los datos de la tabla producto
$sql = "SELECT ID, nombre_producto, precio, Estado, Stock, cod_control_producto, imagen FROM producto";

$result = $conn->query($sql);

// Crear un array para almacenar los datos
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data);

// Cerrar conexión
$conn->close();
?>
