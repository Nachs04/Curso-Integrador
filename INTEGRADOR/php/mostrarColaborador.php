<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "G@bo1007";
$dbname = "marcosweb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el término de búsqueda desde la URL (GET)
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Consulta a la tabla "colaborador" con filtro por nombre
$sql = "SELECT cod_colaborador, nombre_colaborador, contraseña, estado FROM colaborador WHERE nombre_colaborador LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%" . $searchTerm . "%"; // Agregar comodines de búsqueda
$stmt->bind_param("s", $searchTerm); // Parámetro de tipo string
$stmt->execute();

$result = $stmt->get_result();
$colaboradores = array();

if ($result->num_rows > 0) {
    // Recorrer los resultados y agregarlos al array
    while ($row = $result->fetch_assoc()) {
        $colaboradores[] = $row;
    }
}

// Retornar los datos como JSON
echo json_encode($colaboradores);

// Cerrar conexión
$stmt->close();
$conn->close();
?>
