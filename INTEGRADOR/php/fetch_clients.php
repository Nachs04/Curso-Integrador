<?php
// Configuración de la base de datos
$host = 'localhost'; // o tu servidor de base de datos
$dbname = 'marcosweb';
$username = 'root';
$password = 'G@bo1007';

try {
    // Establecer la conexión a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para obtener los datos de los clientes
    $sql = "SELECT correo, nombre_cli, contraseña, fecha FROM cliente";
    $stmt = $pdo->query($sql);

    // Recuperar todos los resultados como un array asociativo
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los resultados en formato JSON
    echo json_encode($clientes);

} catch (PDOException $e) {
    // Manejo de errores
    echo json_encode(['error' => 'No se pudo conectar a la base de datos: ' . $e->getMessage()]);
}
?>
