document.getElementById('btnGenerarReporte').addEventListener('click', function () {
    generarReporteVentas();
});

function generarReporteVentas() {
    fetch('../php/generarReporteVentas.php', {
        method: 'POST', // Método para enviar los datos al servidor
        headers: {
            'Content-Type': 'application/json', // Indicamos que el contenido será JSON
        },
        body: JSON.stringify({}) // Si necesitas enviar datos adicionales, como filtros de fechas, puedes agregarlo aquí
    })
    .then(response => {
        if (!response.ok) { // Verificar si la respuesta es exitosa
            throw new Error('Error al generar el reporte de ventas');
        }
        return response.blob(); // Recibimos el archivo PDF como un Blob
    })
    .then(blob => {
        const link = document.createElement('a'); // Creamos un enlace para descargar el archivo
        link.href = URL.createObjectURL(blob); // Creamos un objeto URL para el Blob
        link.download = 'reporte_ventas.pdf'; // Nombre del archivo que se descargará
        link.click(); // Hacemos clic programáticamente para descargar el archivo
    })
    .catch(error => {
        console.error('Error al generar el reporte de ventas:', error);
        alert('Ocurrió un error al generar el reporte de ventas.'); // Si ocurre un error, mostramos un mensaje
    });
}
