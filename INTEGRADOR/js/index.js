
//funcion 2
document.addEventListener('DOMContentLoaded', function() {
    const fadeInElements = document.querySelectorAll('.fade-in');
    const slideUpElements = document.querySelectorAll('.slide-up');

    // Verifica si la animación ya se ha ejecutado
    if (!localStorage.getItem('animationExecuted')) {
        // Marca que la animación se ha ejecutado
        localStorage.setItem('animationExecuted', 'true');

        // Añade la clase para activar las animaciones
        fadeInElements.forEach(el => el.classList.add('animate-once', 'fade-in'));
        slideUpElements.forEach(el => el.classList.add('animate-once', 'slide-up'));
    } else {
        // Si ya se ejecutó, asegúrate de que las animaciones no se repitan
        fadeInElements.forEach(el => el.classList.add('animate-once'));
        slideUpElements.forEach(el => el.classList.add('animate-once'));
    }

    // Opcional: Puedes eliminar las clases después de la animación
    function handleAnimationEnd(event) {
        event.target.classList.remove('fade-in', 'slide-up', 'animate-once');
    }

    fadeInElements.forEach(el => el.addEventListener('animationend', handleAnimationEnd));
    slideUpElements.forEach(el => el.addEventListener('animationend', handleAnimationEnd));
});


function salir(){
    window.location.href = "../html/portadacolaborador.html";
}

function EntrarCliente(){
    window.location.href='../html/login-cliente.html';
}

function entrar(){
    window.location.href = "../html/colaborador.html";
}


document.addEventListener('DOMContentLoaded', () => {
    const cartIcon = document.getElementById('cart-icon');
    const cartDropdown = document.querySelector('.cart-dropdown');
    const cartItemsContainer = cartDropdown.querySelector('.carrito-items');
    const totalElement = cartDropdown.querySelector('.carrito-precio-total');
    const payButton = cartDropdown.querySelector('.btn-pagar');

    // Mostrar u ocultar el carrito al hacer clic en el ícono del carrito
    cartIcon.addEventListener('click', () => {
        cartDropdown.style.display = cartDropdown.style.display === 'none' ? 'block' : 'none';
    });

    // Generar un ID único para cada producto basado en su contenido
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

            // Crear un ID único para el producto
            const productId = generateProductId(productName, productPrice);

            // Verificar si el producto ya está en el carrito
            const existingItem = [...cartItemsContainer.querySelectorAll('.carrito-item')].find(item => item.dataset.productId === productId);

            if (existingItem) {
                // Actualizar cantidad si el producto ya está en el carrito
                const quantityInput = existingItem.querySelector('.carrito-item-cantidad');
                quantityInput.value = parseInt(quantityInput.value) + 1;
            } else {
                // Agregar nuevo producto al carrito
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
                    </div>
                `;
                cartItemsContainer.insertAdjacentHTML('beforeend', cartItemHtml);
            }
            updateTotal();
        });
    });

    // Actualizar el total del carrito
    function updateTotal() {
        let total = 0;
        cartItemsContainer.querySelectorAll('.carrito-item').forEach(item => {
            const quantity = parseInt(item.querySelector('.carrito-item-cantidad').value);
            const price = parseFloat(item.querySelector('.carrito-item-precio').textContent.replace('$', ''));
            total += quantity * price;
        });
        totalElement.textContent = `$${total.toFixed(2)}`;
    }

    // Manejar cambios en la cantidad y eliminación de productos
    cartDropdown.addEventListener('click', (event) => {
        if (event.target.classList.contains('sumar-cantidad') || event.target.classList.contains('restar-cantidad')) {
            const item = event.target.closest('.carrito-item');
            const quantityInput = item.querySelector('.carrito-item-cantidad');
            const price = parseFloat(item.querySelector('.carrito-item-precio').textContent.replace('$', ''));

            if (event.target.classList.contains('sumar-cantidad')) {
                quantityInput.value = parseInt(quantityInput.value) + 1;
            } else if (event.target.classList.contains('restar-cantidad')) {
                if (parseInt(quantityInput.value) > 1) {
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                }
            }
            updateTotal();
        } else if (event.target.classList.contains('btn-eliminar') || event.target.classList.contains('fa-trash')) {
            const item = event.target.closest('.carrito-item');
            item.remove();
            updateTotal();
        }
    });

    // Función para vaciar el carrito
    function clearCart() {
        cartItemsContainer.innerHTML = '';
        updateTotal();
    }

    // Manejar el evento de pagar
    payButton.addEventListener('click', () => {
        alert('Gracias por su compra');
        clearCart();
        cartDropdown.style.display = 'none';
    });

    // Actualizar el total al cargar la página
    updateTotal();
});


