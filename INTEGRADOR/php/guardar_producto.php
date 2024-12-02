<?php
// Configuración de la base de datos
$servername = "localhost"; // Cambia a tu servidor
$username = "root";        // Tu usuario de la base de datos
$password = "G@bo1007";    // Tu contraseña de la base de datos
$dbname = "marcosweb";     // El nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos de la solicitud JSON
$data = json_decode(file_get_contents("php://input"));

// Verificar si los datos fueron recibidos
if (isset($data->barcode) && isset($data->stock)) {
    $barcode = $data->barcode;
    $stock = $data->stock;

    // Verificar si el producto ya existe en la base de datos
    $sql = "SELECT * FROM producto WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $barcode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Si el producto existe, actualizar el stock
        $sql = "UPDATE producto SET Stock = Stock + ? WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $stock, $barcode);
        $stmt->execute();

        $response = array("success" => true, "message" => "El stock ha sido actualizado.");
    } else {
        // Si el producto no existe, insertar un nuevo producto
        // Aquí, solo almacenamos el ID y Stock, pero puedes añadir más datos si es necesario
        $sql = "INSERT INTO producto (ID, Stock) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $barcode, $stock);
        $stmt->execute();

        $response = array("success" => true, "message" => "Producto guardado exitosamente.");
    }

    // Devolver la respuesta como JSON
    echo json_encode($response);
} else {
    // Si faltan datos
    echo json_encode(array("success" => false, "message" => "Datos incompletos."));
}

$conn->close();
?>
