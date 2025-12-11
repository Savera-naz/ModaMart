@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container">
        <h2 class="mb-4">Your Shopping Cart</h2>

        <div id="cart-container">
            <!-- Cart items will be dynamically inserted here -->
        </div>

        <div id="cart-summary" class="mt-4 text-end d-none">
            <h4>Total: $<span id="cart-total">0.00</span></h4>
            <button id="checkout-btn" class="btn btn-success">Proceed to Checkout</button>
            <button id="clear-cart-btn" class="btn btn-danger ms-2">Clear Cart</button>
        </div>

        <div id="empty-cart" class="text-center py-5 my-5 d-none">
            <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
            <h3 class="text-muted mb-3">Your cart is empty</h3>
            <a href="{{ route('products') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-grid me-2"></i> Browse Products
            </a>
        </div>
    </div>
</section>
@endsection

@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container">
        <h2 class="mb-4">Your Shopping Cart</h2>

        <div id="cart-container">
            <!-- Cart items will be dynamically inserted here -->
        </div>

        <div id="cart-summary" class="mt-4 text-end d-none">
            <h4>Total: $<span id="cart-total">0.00</span></h4>
            <button id="checkout-btn" class="btn btn-success">Proceed to Checkout</button>
            <button id="clear-cart-btn" class="btn btn-danger ms-2">Clear Cart</button>
        </div>

        <div id="empty-cart" class="text-center py-5 my-5 d-none">
            <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
            <h3 class="text-muted mb-3">Your cart is empty</h3>
            <a href="{{ route('products') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-grid me-2"></i> Browse Products
            </a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cartContainer = document.getElementById('cart-container');
    const cartTotalElem = document.getElementById('cart-total');
    const cartSummary = document.getElementById('cart-summary');
    const emptyCart = document.getElementById('empty-cart');

    function loadCart() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        cartContainer.innerHTML = '';

        if(cart.length === 0) {
            cartSummary.classList.add('d-none');
            emptyCart.classList.remove('d-none');
            updateCartCount();
            return;
        }

        cartSummary.classList.remove('d-none');
        emptyCart.classList.add('d-none');

        let total = 0;

        cart.forEach((item, index) => {
            total += item.price * item.quantity;

            const row = document.createElement('div');
            row.classList.add('card', 'mb-3');
            row.innerHTML = `
                <div class="row g-0 align-items-center">
                    <div class="col-md-2">
                        <img src="${item.image}" class="img-fluid rounded-start" alt="${item.name}">
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <h5 class="card-title">${item.name}</h5>
                            <p class="card-text">$${item.price.toFixed(2)}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <input type="number" min="1" class="form-control quantity-input" data-index="${index}" value="${item.quantity}">
                    </div>
                    <div class="col-md-3 text-end pe-3">
                        <button class="btn btn-danger remove-btn" data-index="${index}">
                            <i class="fas fa-trash-alt"></i> Remove
                        </button>
                    </div>
                </div>
            `;
            cartContainer.appendChild(row);
        });

        cartTotalElem.textContent = total.toFixed(2);
        updateCartCount();

        // Attach events for quantity changes
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function() {
                const idx = this.dataset.index;
                let newQty = parseInt(this.value);
                if(newQty < 1) newQty = 1;
                const cart = JSON.parse(localStorage.getItem('cart')) || [];
                cart[idx].quantity = newQty;
                localStorage.setItem('cart', JSON.stringify(cart));
                loadCart();
            });
        });

        // Attach events for remove buttons
        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const idx = this.dataset.index;
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                cart.splice(idx, 1);
                localStorage.setItem('cart', JSON.stringify(cart));
                loadCart();
            });
        });
    }

    // Clear cart button
    document.getElementById('clear-cart-btn').addEventListener('click', function() {
        localStorage.removeItem('cart');
        loadCart();
    });

    // Checkout button
    document.getElementById('checkout-btn').addEventListener('click', function() {
        window.location.href = "/checkout"; // Redirect to checkout page
    });

    // Update cart number in header
    function updateCartCount() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const countElem = document.getElementById('cart-count');
        let totalQty = cart.reduce((sum, item) => sum + item.quantity, 0);
        if(countElem) countElem.textContent = totalQty;
    }

    // Load cart on page load
    loadCart();
});
</script>
@endsection
