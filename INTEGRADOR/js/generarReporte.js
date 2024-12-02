document.getElementById('btnGenerarReporte').addEventListener('click', function () {
    const fechaDesde = document.getElementById('fechaDesde').value;
    const fechaHasta = document.getElementById('fechaHasta').value;

    if (!fechaDesde || !fechaHasta) {
        alert('Por favor, selecciona un rango de fechas.');
        return;
    }

    // Enviar solicitud para generar el reporte PDF
    fetch('../php/generarReportePDF.php', {
        method: 'POST',
        body: JSON.stringify({ fechaDesde, fechaHasta }),
        headers: {
            'Content-Type': 'application/json',
        },
    })
        .then(response => response.blob())
        .then(blob => {
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'reporte_clientes.pdf';
            link.click();
        })
        .catch(error => {
            console.error('Error al generar el reporte PDF:', error);
        });
});
