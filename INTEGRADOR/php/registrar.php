<?php
// Conexión a la base de datos
$conex = mysqli_connect("localhost", "root", "G@bo1007", "marcosweb");

// Verificar conexión
if (mysqli_connect_errno()) {
    echo "Falló la conexión a MySQL: " . mysqli_connect_error();
    exit();
}

// Inicializar mensaje
$mensaje = "HOLAAAA";

// Verificar si el formulario ha sido enviado
if (isset($_POST['Ingresar'])) {
    // Comprobar que los campos no estén vacíos
    if (strlen($_POST['nombre']) < 1 || strlen($_POST['cod_usuario']) < 1 || strlen($_POST['contraseña']) < 1) {
        $mensaje = '<h3 class="bad">¡Por favor complete todos los campos!</h3>';
    } else {
        // Obtener los valores y sanitizarlos
        $nombre_cli = trim($_POST["nombre"]);
        $correo = trim($_POST['cod_usuario']);
        $contraseña = trim($_POST['contraseña']);
        $fecha = date('Y-m-d H:i:s'); // Obtener la fecha actual

        // Comprobar si el correo ya existe en la base de datos
        $consulta_check = "SELECT * FROM cliente WHERE correo = '$correo'";
        $resultado_check = mysqli_query($conex, $consulta_check);

        if (mysqli_num_rows($resultado_check) > 0) {
            // Si el correo ya existe, mostrar mensaje de error
            $mensaje = '<h3 class="bad">¡Este correo ya está registrado!</h3>';
        } else {
            // Hash de la contraseña para almacenarla de forma segura
            $contrasena_hash = password_hash($contraseña, PASSWORD_DEFAULT);

            // Consulta SQL para insertar los datos
            $consulta = "INSERT INTO cliente (correo, nombre_cli, contraseña, fecha) VALUES ('$correo', '$nombre_cli', '$contrasena_hash', '$fecha')";
            $resultado = mysqli_query($conex, $consulta);

            // Comprobar si la inserción fue exitosa
            if ($resultado) {
                header("Location: ../html/cliente.html");
                exit; // Detener el script para asegurar que la redirección se ejecute
            } else {
                $mensaje = '<h3 class="bad">¡Ups, ha ocurrido un error!</h3>'; // Mensaje de error
            }
        }
    }
} else {
    $mensaje = '<h3 class="bad">¡Error al procesar la solicitud!</h3>'; // Mensaje de error en caso de no recibir la solicitud
}

// Cerrar la conexión
mysqli_close($conex);

// Devolver el mensaje como respuesta
echo $mensaje;
?>




