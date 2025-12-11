@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container text-center">
        <i class="fas fa-check-circle fa-6x text-success mb-4"></i>
        <h1 class="mb-3">Thank You for Shopping!</h1>
        <p class="lead mb-4">
            Your order has been successfully placed. We appreciate your business and hope you enjoy your purchase!
        </p>
        <a href="{{ route('products') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-shopping-bag me-2"></i> Continue Shopping
        </a>
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    // Function to update cart count in header
    function updateCartCount() {
        const countElem = document.getElementById('cart-count');
        if(countElem) countElem.textContent = '0';
    }

    // Clear localStorage cart
    localStorage.removeItem('cart');
    loadCart();


    // Update header count
    updateCartCount();
});
</script>
@endsection
