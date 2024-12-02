<?php
// Incluir la librería FPDF
require('../lib/fpdf/fpdf.php');

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "G@bo1007";
$dbname = "marcosweb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir los datos enviados desde el frontend
$data = json_decode(file_get_contents('php://input'), true);
$fechaDesde = $data['fechaDesde'];
$fechaHasta = $data['fechaHasta'];

if (!$fechaDesde || !$fechaHasta) {
    die("Rango de fechas inválido");
}

// Crear una nueva instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Agregar el logo de la empresa
$pdf->Image('../recursos/imagenes/LOGO.png', 10, 10, 30); // Ruta al logo, posición (x, y), tamaño (ancho)

// Espaciado para evitar que el texto se cruce con el logo
$pdf->SetY(20); // Ajustar la posición del cursor
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, utf8_decode('PASTELERÍA DOÑA JULIA - Reporte de Clientes'), 0, 1, 'C'); // Título centrado
$pdf->Ln(10); // Espaciado adicional

// Agregar una descripción
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, utf8_decode("Este reporte muestra la lista de clientes registrados en un periodo determinado."), 0, 'C');
$pdf->Ln(10); // Espaciado adicional

// Configuración de la tabla
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(200, 220, 255); // Color de fondo de los encabezados
$pdf->SetDrawColor(50, 50, 100); // Color de los bordes

// Encabezados
$pdf->Cell(70, 10, utf8_decode('Correo'), 1, 0, 'C', true);
$pdf->Cell(60, 10, utf8_decode('Nombre'), 1, 0, 'C', true);
$pdf->Cell(40, 10, utf8_decode('Fecha'), 1, 1, 'C', true);

// Consultar los clientes filtrados por fecha
$query = "SELECT correo, nombre_cli, fecha FROM cliente WHERE fecha BETWEEN ? AND ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $fechaDesde, $fechaHasta);
$stmt->execute();
$result = $stmt->get_result();

$totalClientes = 0; // Variable para contar la cantidad total de clientes

// Filas de la tabla
$pdf->SetFont('Arial', '', 12); // Fuente para las filas
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(70, 10, utf8_decode($row['correo']), 1, 0, 'L');
    $pdf->Cell(60, 10, utf8_decode($row['nombre_cli']), 1, 0, 'L');
    $pdf->Cell(40, 10, utf8_decode($row['fecha']), 1, 1, 'C');
    $totalClientes++; // Incrementar el contador
}

// Espaciado adicional para el resumen al final
$pdf->Ln(10);

// Mostrar el total de clientes
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, utf8_decode("Total de clientes: " . $totalClientes), 0, 1, 'R'); // Alineado a la derecha

// Mostrar el rango de fechas al final del PDF
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, utf8_decode("Rango de fechas: Desde $fechaDesde hasta $fechaHasta"), 0, 1, 'R'); // Alineado a la derecha

$stmt->close();
$conn->close();

// Generar el archivo PDF y enviarlo al navegador
$pdf->Output('D', 'reporte_clientes.pdf');
?>
