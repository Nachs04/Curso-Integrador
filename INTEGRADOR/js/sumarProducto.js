// Función para guardar o actualizar el stock del producto
document.getElementById("btn-save").addEventListener("click", function () {
    // Obtener los valores del ID y del stock
    let barcode = document.getElementById("barcode").value;
    let stock = parseInt(document.getElementById("stock").value);

    // Verificar que el stock sea un número válido
    if (isNaN(stock) || stock <= 0) {
        alert("Por favor, ingresa un número válido para el stock.");
        return;
    }

    // Crear un objeto con los datos
    let data = {
        barcode: barcode,
        stock: stock
    };

    // Enviar los datos al servidor usando AJAX
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/guardar_producto.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Respuesta del servidor
            let response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert(response.message);
            } else {
                alert("Error al guardar el producto.");
            }
        }
    };
    xhr.send(JSON.stringify(data));

    // Limpiar los campos del formulario
    document.getElementById("barcode").value = "";
    document.getElementById("stock").value = "";
});
