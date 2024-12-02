<?php
// Conexion a la base de datos
$host = "localhost";
$user = "root";
$password = "G@bo1007";
$db = "marcosweb";

// Conexión a la base de datos
$conexion = new mysqli($host, $user, $password, $db);


if(isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
} else {
    echo json_encode([]); // Si no hay término de búsqueda, devolver un array vacío
    exit;
}

// Asegúrate de que la variable de búsqueda esté limpia
$searchQuery = trim($searchQuery);

if(empty($searchQuery)) {
    echo json_encode([]); // Si la búsqueda está vacía, devolver un array vacío
    exit;
}

// Preparar la consulta para buscar clientes por nombre o correo
$sql = "SELECT correo, nombre, contraseña, fecha FROM clientes WHERE nombre LIKE ? OR correo LIKE ?";
$stmt = $conexion->prepare($sql);

// Asegurarse de que la consulta funciona correctamente con LIKE y parámetros seguros
$searchParam = "%" . $searchQuery . "%";
$stmt->bind_param("ss", $searchParam, $searchParam);

// Ejecutar la consulta
$stmt->execute();
$result = $stmt->get_result();

$clientes = [];
while ($row = $result->fetch_assoc()) {
    $clientes[] = $row;  // Llenar el array de resultados
}

// Devolver los resultados en formato JSON
echo json_encode($clientes);
?>
