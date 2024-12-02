<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "G@bo1007";
$dbname = "marcosweb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $newPassword = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

    // Verificar si el token es válido
    $sql = "SELECT * FROM cliente WHERE token = ? AND token_expiry > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Actualizar contraseña e invalidar el token
        $updateSql = "UPDATE cliente SET contraseña = ?, token = NULL, token_expiry = NULL WHERE token = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("ss", $newPassword, $token);
        $stmt->execute();

        echo "Tu contraseña ha sido actualizada correctamente.";
    } else {
        echo "El enlace de recuperación no es válido o ha expirado.";
    }
}
?>

