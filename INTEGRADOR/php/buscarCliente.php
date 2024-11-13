<?php
// Establecer la conexión con la base de datos
$servername = "localhost";
$username = "root";  // Cambia esto según tus credenciales
$password = "G@bo1007";      // Cambia esto según tus credenciales
$dbname = "marcosweb"; // Cambia esto por tu base de datos

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtén los datos del cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"), true);
$nombre = $data['nombre'];

// Consulta para buscar los clientes por nombre o correo
$sql = "SELECT correo, nombre_cli, contraseña, fecha FROM cliente WHERE nombre_cli LIKE ? OR correo LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%" . $nombre . "%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();

// Obtener los resultados
$result = $stmt->get_result();
$clientes = [];

while ($row = $result->fetch_assoc()) {
    $clientes[] = $row;
}

// Devuelve los resultados como un JSON
echo json_encode($clientes);

// Cierra la conexión
$conn->close();
?>
