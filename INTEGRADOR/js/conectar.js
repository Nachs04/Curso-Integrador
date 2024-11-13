// archivo: js/script.js
function registrarUsuario() {
    const formData = new FormData(document.getElementById('registroForm'));

    fetch('http://localhost/INTEGRADOR/php/registrar.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Muestra el mensaje desde PHP
    })
    .catch(error => console.error('Error:', error));
}
