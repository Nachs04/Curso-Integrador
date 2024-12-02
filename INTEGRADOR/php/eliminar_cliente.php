<?php
// Conexión a la base de datos
$servername = "localhost"; 
$username = "root";  
$password = "G@bo1007"; 
$dbname = "marcosweb"; 

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha recibido el índice de la fila
if (isset($_POST['index'])) {
    $index = $_POST['index'];

    // Obtener los clientes para encontrar el cliente en la posición indicada
    $sql = "SELECT * FROM cliente LIMIT ?, 1"; // Usar LIMIT para obtener solo un cliente según el índice
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $index); // Usar el índice como parámetro de LIMIT

    $stmt->execute();
    $result = $stmt->get_result();
    $cliente = $result->fetch_assoc();

    if ($cliente) {
        // Si se encuentra el cliente, eliminarlo
        $sql_delete = "DELETE FROM cliente WHERE correo = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("s", $cliente['correo']); // Usar el correo del cliente para eliminarlo
        if ($stmt_delete->execute()) {
            echo json_encode(["success" => true, "message" => "Cliente eliminado correctamente"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error al eliminar el cliente"]);
        }
        $stmt_delete->close();
    } else {
        echo json_encode(["success" => false, "message" => "Cliente no encontrado"]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "No se ha recibido el índice"]);
}
$conn->close();
?>


