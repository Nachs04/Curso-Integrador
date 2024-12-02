function generarReporte() {
    fetch('../php/generarReporteColaboradores.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({}) // Si necesitas enviar datos adicionales, agrégalos aquí
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al generar el reporte');
            }
            return response.blob(); // Recibe el PDF como Blob
        })
        .then(blob => {
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'reporte_colaboradores.pdf'; // Nombre del archivo descargado
            link.click();
        })
        .catch(error => {
            console.error('Error al generar el reporte:', error);
            alert('Ocurrió un error al generar el reporte.');
        });
}
