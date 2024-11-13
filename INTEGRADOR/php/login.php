<?php
session_start(); // Iniciar la sesión

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

// Obtener los datos del formulario
$correo = $_POST['cod_usuario'];
$contrasena = $_POST['contraseña'];

// Consulta para verificar el usuario y la contraseña
$sql = "SELECT * FROM cliente WHERE correo = '$correo'";
$result = $conn->query($sql);

// Verificar si el usuario existe
if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    
    // Verificar la contraseña (puedes usar password_verify si usas hash)
    if ($usuario['contraseña'] === $contrasena) {
        // Si la contraseña es correcta, iniciamos la sesión
        $_SESSION['usuario_id'] = $usuario['id']; // Guarda el ID del usuario en la sesión
        $_SESSION['usuario_correo'] = $usuario['correo']; // Guarda el correo del usuario

        // Redirigir a cliente.html
        header("Location: ../html/cliente.html");
        exit();
    } else {
        // Contraseña incorrecta, redirigir con un error
        header("Location: ../html/login-cliente.html?error=usuario_no_encontrado");
        exit();
    }
} else {
    // El usuario no existe, redirigir con un error
    header("Location: ../html/login-cliente.html?error=usuario_no_encontrado");
    exit();
}

// Cerrar la conexión
$conn->close();
?>


