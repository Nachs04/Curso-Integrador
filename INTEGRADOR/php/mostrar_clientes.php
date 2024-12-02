<?php
// Configuración de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "G@bo1007";
$dbname = "marcosweb";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el término de búsqueda desde la URL (GET)
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Consulta a la tabla "cliente" con filtro por nombre o correo
$sql = "SELECT correo, nombre_cli, contraseña, fecha 
        FROM cliente 
        WHERE nombre_cli LIKE ? OR correo LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%" . $searchTerm . "%"; // Agregar comodines para la búsqueda
$stmt->bind_param("ss", $searchTerm, $searchTerm); // Parámetros para el filtro
$stmt->execute();

$result = $stmt->get_result();
$clientes = array();

if ($result->num_rows > 0) {
    // Recorrer los resultados y agregarlos al array
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
}

// Retornar los datos como JSON
echo json_encode($clientes);

// Cerrar conexión
$stmt->close();
$conn->close();
?>
