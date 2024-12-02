<?php
require('../lib/fpdf/fpdf.php'); // Asegúrate de que la ruta sea correcta

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "G@bo1007";
$dbname = "marcosweb";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Establecer la codificación de la conexión a UTF-8
$conn->set_charset("utf8mb4");

// Crear instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Logo de la empresa (asegúrate de que la ruta sea correcta)
$pdf->Image('../recursos/imagenes/LOGO.png', 10, 8, 30); // Ajusta el tamaño y la posición
$pdf->Ln(10); // Salto de línea

// Nombre de la empresa
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 10, utf8_decode('PASTELERÍA DOÑA JULIA'), 0, 1, 'C'); // Cambia "Nombre de la Empresa" por el nombre real
$pdf->Ln(10);

// Título del reporte
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, utf8_decode('Reporte de Colaboradores Eliminados'), 0, 1, 'C');
$pdf->Ln(10);

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(200, 200, 200);
$pdf->Cell(30, 10, utf8_decode('ID'), 1, 0, 'C', true);
$pdf->Cell(60, 10, utf8_decode('Nombre'), 1, 0, 'C', true);
$pdf->Cell(50, 10, utf8_decode('Contraseña'), 1, 0, 'C', true);
$pdf->Cell(30, 10, utf8_decode('Estado'), 1, 1, 'C', true);

// Consultar datos de la tabla 'colaborador' filtrando por estado 0 (eliminados lógicamente)
$query = "SELECT cod_colaborador, nombre_colaborador, contraseña, estado FROM colaborador WHERE estado = 0";
$resultado = $conn->query($query);

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    // Agregar datos al PDF
    $pdf->SetFont('Arial', '', 12);
    while ($fila = $resultado->fetch_assoc()) {
        $pdf->Cell(30, 10, utf8_decode($fila['cod_colaborador']), 1);
        $pdf->Cell(60, 10, utf8_decode($fila['nombre_colaborador']), 1);
        $pdf->Cell(50, 10, utf8_decode($fila['contraseña']), 1);
        $pdf->Cell(30, 10, utf8_decode($fila['estado']), 1, 1);
    }

    // Mostrar la cantidad de colaboradores eliminados
    $pdf->Ln(10); // Salto de línea
    $pdf->SetFont('Arial', 'B', 12);
    $totalColaboradores = $resultado->num_rows;
    $pdf->Cell(0, 10, utf8_decode("Cantidad total de colaboradores eliminados lógicamente: " . $totalColaboradores), 0, 1, 'C');
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay colaboradores eliminados lógicamente para mostrar.'), 0, 1, 'C');
}

// Cerrar conexión
$conn->close();

// Salida del PDF
$pdf->Output('D', 'reporte_colaboradores_eliminados.pdf'); // Forzar descarga
?>
