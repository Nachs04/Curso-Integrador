<?php 

$host = "localhost";
$user = "root";
$password = "G@bo1007";
$db = "marcosweb";

// Conexión a la base de datos
$conexion = new mysqli($host, $user, $password, $db);

// Verifica si la conexión es exitosa
if ($conexion->connect_errno) {
    die("Falló la conexión a la base de datos: " . $conexion->connect_error);
}

// Importar clases de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../lib/PHPMailer/Exception.php';
require '../lib/PHPMailer/PHPMailer.php';
require '../lib/PHPMailer/SMTP.php';

// Obtener el correo enviado por POST
$email = $_POST['email'];

// Verifica que el correo se haya recibido correctamente
if (empty($email)) {
    die("No se ha enviado el correo.");
}

// Consulta para verificar si el correo existe
$query = "SELECT * FROM cliente WHERE correo = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("s", $email);  // 's' indica que el parámetro es un string
$stmt->execute();
$result = $stmt->get_result();

// Verifica si se encontró el correo en la base de datos
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); // Obtenemos los datos del cliente

    // Si el correo existe, generamos un token único
    $token = bin2hex(random_bytes(16));  // Genera un token aleatorio
    $token_expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));  // El token expirará en 1 hora

    // Actualizamos el token y la fecha de expiración en la base de datos
    $update_query = "UPDATE cliente SET token = ?, token_expiry = ? WHERE correo = ?";
    $stmt = $conexion->prepare($update_query);
    $stmt->bind_param("sss", $token, $token_expiry, $email);
    if (!$stmt->execute()) {
        die("Error al actualizar el token en la base de datos: " . $stmt->error);
    }

    // Configuración de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp-mail.outlook.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'gaborcandela@outlook.com';  // Tu correo de Outlook
        $mail->Password   = 'G@briel2005';  // Tu contraseña de Outlook
        $mail->Port       = 587;

        // Configuración del correo
        $mail->setFrom('gaborcandela@outlook.com', 'NOMBRE_FORM');  // Correo y nombre del remitente
        $mail->addAddress($email, $row['nombre_cli']);  // Enviar a la dirección de correo recuperada y su nombre
        $mail->isHTML(true);
        $mail->Subject = 'Recuperación de contraseña';
        
        // Enlace de recuperación de contraseña con el token
        $mail->Body = 'Hola ' . $row['nombre_cli'] . ', este es un correo generado para solicitar tu recuperación de contraseña. ' .
                      'Por favor, visita la página de <a href="http://localhost/INTEGRADOR/php/reset-contrasena.html?token=' . $token . '">Recuperación de contraseña</a>';

        // Enviar el correo
        if (!$mail->send()) {
            die("Error al enviar el correo: " . $mail->ErrorInfo);
        }

        // Redirigir con mensaje de éxito
        header("Location: ../html/reset-contrasena.html?message=ok");  
        exit;  // Asegúrate de llamar a exit después de header para evitar que el código siga ejecutándose
    } catch (Exception $e) {
        // En caso de error, redirigir con mensaje de error
        die("Error al enviar el correo: " . $e->getMessage());
    }
} else {
    // Si el correo no existe, redirigir con mensaje de "no encontrado"
    echo "Error al enviar el correo: " . $mail->ErrorInfo;
    exit;  // Asegúrate de llamar a exit después de header para evitar que el código siga ejecutándose
}
?>
