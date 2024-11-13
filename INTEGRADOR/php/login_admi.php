<?php
// Habilitar reporte de errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Datos de conexión a la base de datos
$servername = "localhost"; // Cambia según tu servidor de base de datos
$username = "root";  // Cambia a tu usuario de base de datos
$password = "G@bo1007"; // Cambia a tu contraseña de base de datos
$dbname = "marcosweb"; // Cambia al nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos enviados desde el formulario
$cod_usuario = $_POST['cod_usuario'];  // 'cod_usuario' corresponde al campo en el formulario
$contrasena = $_POST['contraseña'];

// Consulta para verificar el usuario y la contraseña
$sql = "SELECT * FROM colaborador WHERE id = '$cod_usuario' AND contraseña = '$contrasena'";
$result = $conn->query($sql);

// Verificar si el colaborador existe y la contraseña es correcta
if ($result->num_rows > 0) {
    // Redirigir a la página de administrador si las credenciales son correctas
    header("Location: ../html/administrador.html");
    exit();
} else {
    // Redirigir de regreso al formulario de inicio de sesión con mensaje de error
    header("Location: ../html/portadacolaborador.html?error=usuario_no_encontrado");
    exit();
}

// Cerrar la conexión
$conn->close();
?>
