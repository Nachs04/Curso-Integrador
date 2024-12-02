<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', 'G@bo1007', 'marcosweb');

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Leer el contenido JSON enviado desde el frontend
$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data)) {
    foreach ($data as $venta) {
        $nombre_producto = $conexion->real_escape_string($venta['nombre_producto']);
        $cantidad = intval($venta['cantidad']);
        $precio = floatval($venta['precio']);
        $total = floatval($venta['total']);
        $fecha = $conexion->real_escape_string($venta['fecha']);

        // Insertar en la tabla 'venta'
        $sql = "INSERT INTO venta (nombre_producto, cantidad, precio, total, fecha)
                VALUES ('$nombre_producto', $cantidad, $precio, $total, '$fecha')";

        if (!$conexion->query($sql)) {
            echo json_encode([
                'success' => false,
                'mensaje' => 'Error al insertar en la base de datos: ' . $conexion->error
            ]);
            exit;
        }
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'mensaje' => 'Datos vacíos o inválidos.']);
}

$conexion->close();
?>
