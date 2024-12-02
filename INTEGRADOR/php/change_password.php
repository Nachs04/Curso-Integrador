<?php 

$host = "localhost";
$user = "root";
$password = "G@bo1007";
$db = "marcosweb";

// Conexión a la base de datos
$conexion = new mysqli($host, $user, $password, $db);


$id = $_POST['id'];
$pass = $_POST['new_password'];

$query = "UPDATE usuarios set password= '$pass' WHERE id= $id";
$conexion->query($query);

header("Location: ../html/reset-password.html?message=success_password");

?>