<?php
$servername = "localhost";  // Cambia esto según tu configuración
$username = "root";         // Cambia según tu configuración
$password = "G@bo1007";             // Cambia según tu configuración
$dbname = "marcosweb";      // El nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM cliente";  // Consulta para obtener todos los clientes
$result = $conn->query($sql);

$clientes = [];

if ($result->num_rows > 0) {
    // Recoger todos los clientes
    while($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
}

// Devolver los resultados como JSON
echo json_encode($clientes);

$conn->close();
?>
