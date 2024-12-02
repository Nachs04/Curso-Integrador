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

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['correo']) && isset($data['nombre_cli']) && isset($data['contraseña']) && isset($data['fecha'])) {
    $correo = $data['correo'];
    $nombre = $data['nombre_cli'];
    $contraseña = $data['contraseña'];
    $fecha = $data['fecha'];

    $sql = "UPDATE cliente SET nombre_cli = ?, contraseña = ?, fecha = ? WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $contraseña, $fecha, $correo);

    if ($stmt->execute()) {
        echo "Cliente actualizado correctamente";
    } else {
        echo "Error al actualizar el cliente";
    }
}
?>

