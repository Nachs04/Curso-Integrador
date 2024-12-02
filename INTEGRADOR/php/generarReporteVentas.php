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
$pdf->Ln(5);

// Título del reporte
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, utf8_decode('Reporte de Ventas'), 0, 1, 'C');
$pdf->Ln(10);

// Descripción del reporte
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, utf8_decode('A continuación, un reporte detallado de las ventas de la empresa y la cantidad vendida por producto.'));
$pdf->Ln(10);

// Encabezados de la tabla (sin la columna ID Venta)
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(100, 100, 255); // Color de fondo en los encabezados
$pdf->SetTextColor(255, 255, 255); // Color del texto
$pdf->Cell(50, 10, utf8_decode('Nombre Producto'), 1, 0, 'C', true);
$pdf->Cell(30, 10, utf8_decode('Cantidad'), 1, 0, 'C', true);
$pdf->Cell(30, 10, utf8_decode('Precio'), 1, 0, 'C', true);
$pdf->Cell(30, 10, utf8_decode('Total'), 1, 0, 'C', true);
$pdf->Cell(40, 10, utf8_decode('Fecha'), 1, 1, 'C', true);

// Consultar datos de la tabla 'venta'
$query = "SELECT nombre_producto, cantidad, precio, total, fecha FROM venta";
$resultado = $conn->query($query);

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    // Agregar datos al PDF
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 0, 0); // Color de texto negro
    $ingresoTotal = 0;
    $productosVendidos = [];

    while ($fila = $resultado->fetch_assoc()) {
        // Mostrar los datos de la venta en la tabla
        $pdf->Cell(50, 10, utf8_decode($fila['nombre_producto']), 1);
        $pdf->Cell(30, 10, utf8_decode($fila['cantidad']), 1);
        $pdf->Cell(30, 10, utf8_decode($fila['precio']), 1);
        $pdf->Cell(30, 10, utf8_decode($fila['total']), 1);
        $pdf->Cell(40, 10, utf8_decode($fila['fecha']), 1, 1);

        // Acumular el total de las ventas
        $ingresoTotal += $fila['total'];

        // Acumular la cantidad de cada producto vendido
        if (!isset($productosVendidos[$fila['nombre_producto']])) {
            $productosVendidos[$fila['nombre_producto']] = 0;
        }
        $productosVendidos[$fila['nombre_producto']] += $fila['cantidad'];
    }

    // Mostrar el ingreso total
    $pdf->Ln(10); // Salto de línea
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode("Ingreso total: S/ " . number_format($ingresoTotal, 2)), 0, 1, 'C');
    $pdf->Ln(10);

    // Mostrar la cantidad vendida de cada producto con un diseño más bonito
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetTextColor(100, 100, 255); // Color del texto
    $pdf->Cell(0, 10, utf8_decode('Cantidad vendida por producto:'), 0, 1, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 0, 0); // Color de texto negro
    foreach ($productosVendidos as $producto => $cantidad) {
        $pdf->Cell(0, 10, utf8_decode($producto . ': ' . $cantidad . ' unidades'), 0, 1, 'L');
    }
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay ventas para mostrar.'), 0, 1, 'C');
}

// Cerrar conexión
$conn->close();

// Salida del PDF
$pdf->Output('D', 'reporte_ventas.pdf'); // Forzar descarga
?>
