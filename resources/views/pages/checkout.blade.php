@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container">
        <h2 class="mb-4">Checkout</h2>

        <div id="checkout-cart" class="mb-4">
            <!-- Cart items will be injected here -->
        </div>

        <div id="checkout-summary" class="mb-4 d-none">
            <h4>Total: $<span id="checkout-total">0.00</span></h4>
        </div>

        <div id="empty-cart" class="text-center py-5 my-5 d-none">
            <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
            <h3 class="text-muted mb-3">Your cart is empty</h3>
            <a href="{{ route('products') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-grid me-2"></i> Browse Products
            </a>
        </div>

        <form id="checkout-form" class="d-none">
            <h4>Billing Details</h4>
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Place Order</button>
        </form>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkoutCart = document.getElementById('checkout-cart');
    const checkoutTotalElem = document.getElementById('checkout-total');
    const checkoutSummary = document.getElementById('checkout-summary');
    const emptyCart = document.getElementById('empty-cart');
    const checkoutForm = document.getElementById('checkout-form');

    function loadCheckoutCart() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        checkoutCart.innerHTML = '';

        if(cart.length === 0) {
            checkoutSummary.classList.add('d-none');
            checkoutForm.classList.add('d-none');
            emptyCart.classList.remove('d-none');
            return;
        }

        emptyCart.classList.add('d-none');
        checkoutSummary.classList.remove('d-none');
        checkoutForm.classList.remove('d-none');

        let total = 0;

        cart.forEach(item => {
            const subtotal = item.price * item.quantity;
            total += subtotal;

            const itemRow = document.createElement('div');
            itemRow.classList.add('card', 'mb-3');
            itemRow.innerHTML = `
                <div class="row g-0 align-items-center">
                    <div class="col-md-2">
                        <img src="${item.image}" class="img-fluid rounded-start" alt="${item.name}">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">${item.name}</h5>
                            <p class="card-text">$${item.price.toFixed(2)} x ${item.quantity}</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-end pe-3">
                        <p class="mb-0 fw-bold">Subtotal: $${subtotal.toFixed(2)}</p>
                    </div>
                </div>
            `;
            checkoutCart.appendChild(itemRow);
        });

        checkoutTotalElem.textContent = total.toFixed(2);
    }

    loadCheckoutCart();

    // Handle checkout form submission
checkoutForm.addEventListener('submit', function(e) {
    e.preventDefault();

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const address = document.getElementById('address').value.trim();

    if(name && email && address) {
        // Clear the cart
        localStorage.removeItem('cart');

        // Update cart count in header
        const cartCountElem = document.getElementById('cart-count');
        if(cartCountElem) cartCountElem.textContent = '0';

        // Redirect to thank you page
        window.location.href = "/thankyou";
    } else {
        alert('Please fill all the fields.');
    }
});

});
</script>
@endsection
