<?php
$servername = "localhost";
$username = "root";
$password = "G@bo1007";
$dbname = "marcosweb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
