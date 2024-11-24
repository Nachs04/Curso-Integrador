<?php
// Habilitar reporte de errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "integrador";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos enviados desde el formulario
$cod_usuario = $_POST['cod_usuario']; // Campo del formulario
$contrasena = $_POST['contraseña'];  // Campo del formulario

// Consulta segura con sentencias preparadas
$sql = "SELECT * FROM colaborador WHERE cod_colaborador = ? AND contraseña = ? AND estado = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $cod_usuario, $contrasena); // "i" para entero, "s" para string
$stmt->execute();
$result = $stmt->get_result();

// Verificar si el colaborador existe, la contraseña es correcta y el estado es activo
if ($result->num_rows > 0) {
    // Redirigir a la página de administrador si las credenciales son correctas
    header("Location: ../html/administrador.html");
    exit();
} else {
    // Redirigir de regreso al formulario de inicio de sesión con mensaje de error
    header("Location: ../html/portadacolaborador.html?error=usuario_no_encontrado");
    exit();
}

// Cerrar la conexión y la declaración preparada
$stmt->close();
$conn->close();
?>