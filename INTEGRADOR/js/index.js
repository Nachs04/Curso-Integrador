document.addEventListener('DOMContentLoaded', () => {
    const cartIcon = document.getElementById('cart-icon');
    const cartDropdown = document.querySelector('.cart-dropdown');
    const cartItemsContainer = cartDropdown.querySelector('.carrito-items');
    const totalElement = cartDropdown.querySelector('.carrito-precio-total');
    const payButton = cartDropdown.querySelector('.btn-pagar');
    const API_URL = 'http://localhost/INTEGRADOR/php/guardar_detalle_venta.php'; // URL del servidor

    // Mostrar u ocultar el carrito
    cartIcon.addEventListener('click', () => {
        cartDropdown.style.display = cartDropdown.style.display === 'none' ? 'block' : 'none';
    });

    // Generar ID único para productos
    function generateProductId(name, price) {
        return `${name.replace(/\s+/g, '-').toLowerCase()}-${price}`;
    }

    // Agregar producto al carrito
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', (event) => {
            const productCard = event.target.closest('.card-product');
            const productName = productCard.querySelector('h3').textContent;
            const productPrice = parseFloat(productCard.querySelector('.price').textContent.replace('$', ''));
            const productImage = productCard.querySelector('img').src;
            const productId = generateProductId(productName, productPrice);

            const existingItem = [...cartItemsContainer.querySelectorAll('.carrito-item')].find(item => item.dataset.productId === productId);

            if (existingItem) {
                const quantityInput = existingItem.querySelector('.carrito-item-cantidad');
                quantityInput.value = parseInt(quantityInput.value) + 1;
            } else {
                const cartItemHtml = `
                    <div class="carrito-item" data-product-id="${productId}">
                        <img src="${productImage}" width="80px" alt="${productName}">
                        <div class="carrito-item-detalles">
                            <span class="carrito-item-titulo">${productName}</span>
                            <div class="selector-cantidad">
                                <i class="fa-solid fa-minus restar-cantidad"></i>
                                <input type="text" value="1" class="carrito-item-cantidad" disabled>
                                <i class="fa-solid fa-plus sumar-cantidad"></i>
                            </div>
                            <span class="carrito-item-precio">$${productPrice.toFixed(2)}</span>
                        </div>
                        <span class="btn-eliminar">
                            <i class="fa-solid fa-trash"></i>
                        </span>
                    </div>`;
                cartItemsContainer.insertAdjacentHTML('beforeend', cartItemHtml);
            }
            updateTotal();
        });
    });

    // Actualizar total del carrito
    function updateTotal() {
        let total = 0;
        cartItemsContainer.querySelectorAll('.carrito-item').forEach(item => {
            const quantity = parseInt(item.querySelector('.carrito-item-cantidad').value);
            const price = parseFloat(item.querySelector('.carrito-item-precio').textContent.replace('$', ''));
            total += quantity * price;
        });
        totalElement.textContent = `$${total.toFixed(2)}`;
    }

    // Manejar cambios en cantidad y eliminación
    cartDropdown.addEventListener('click', (event) => {
        if (event.target.classList.contains('sumar-cantidad') || 
            event.target.classList.contains('restar-cantidad')) {
            const item = event.target.closest('.carrito-item');
            const quantityInput = item.querySelector('.carrito-item-cantidad');

            if (event.target.classList.contains('sumar-cantidad')) {
                quantityInput.value = parseInt(quantityInput.value) + 1;
            } else if (event.target.classList.contains('restar-cantidad')) {
                if (parseInt(quantityInput.value) > 1) {
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                }
            }
            updateTotal();
        } else if (event.target.classList.contains('btn-eliminar') || 
                   event.target.classList.contains('fa-trash')) {
            const item = event.target.closest('.carrito-item');
            item.remove();
            updateTotal();
        }
    });

    // Función para recolectar datos del carrito
    function getCartData() {
        const items = cartItemsContainer.querySelectorAll('.carrito-item');
        const productos = [];
        let total = 0;

        items.forEach(item => {
            const nombre = item.querySelector('.carrito-item-titulo').textContent;
            const cantidad = parseInt(item.querySelector('.carrito-item-cantidad').value);
            const precio = parseFloat(item.querySelector('.carrito-item-precio').textContent.replace('$', ''));
            const subtotal = cantidad * precio;

            productos.push({
                nombre: nombre,
                cantidad: cantidad,
                precio: precio
            });

            total += subtotal;
        });

        return { productos, total };
    }

    // Procesar el pago
    payButton.addEventListener('click', async (event) => {
        event.preventDefault(); // Evitar redirección al servidor
        const cartData = getCartData(); // Recoger los datos del carrito

        if (cartData.productos.length === 0) {
            alert('El carrito está vacío');
            return;
        }

        const ventaData = cartData.productos.map(producto => ({
            nombre_producto: producto.nombre,
            cantidad: producto.cantidad,
            precio: producto.precio,
            total: producto.cantidad * producto.precio,
            fecha: new Date().toISOString().split('T')[0] // Fecha actual en formato YYYY-MM-DD
        }));

        try {
            const response = await fetch(API_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(ventaData)
            });

            // Aquí eliminamos la lógica de respuesta JSON
            alert('¡Gracias por su compra!');

            // Vaciar el carrito después de la compra
            clearCart();
            cartDropdown.style.display = 'none';

        } catch (error) {
            console.error('Error:', error);
            alert('Error al procesar la compra. Por favor, intente nuevamente.');
        }
    });

    // Función para vaciar el carrito
    function clearCart() {
        cartItemsContainer.innerHTML = '';
        updateTotal();
    }

    // Funciones de navegación
    window.salir = function() {
        window.location.href = "../html/portadacolaborador.html";
    };

    window.EntrarCliente = function() {
        window.location.href = '../html/login-cliente.html';
    };

    window.entrar = function() {
        window.location.href = "../html/colaborador.html";
    };

    // Actualizar total inicial
    updateTotal();
});

