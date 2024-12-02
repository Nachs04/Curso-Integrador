<?php
// Incluir la conexión a la base de datos
// Conexión a la base de datos
$servername = "localhost"; // Cambia a tu servidor de base de datos
$username = "root";  // Cambia a tu usuario de base de datos
$password = "G@bo1007"; // Cambia a tu contraseña de base de datos
$dbname = "marcosweb"; // Cambia al nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


// Obtener datos de la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);
$fechaDesde = $data['fechaDesde'];
$fechaHasta = $data['fechaHasta'];

// Consultar los clientes en el rango de fechas
$query = "SELECT correo, nombre_cli, contraseña, fecha FROM cliente WHERE fecha BETWEEN '$fechaDesde' AND '$fechaHasta'";
$result = mysqli_query($conn, $query);

// Verificar si la consulta devuelve resultados
$clientes = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $clientes[] = $row;
    }
}

// Devolver los resultados en formato JSON
echo json_encode($clientes);

// Cerrar la conexión
mysqli_close($conn);
?>
