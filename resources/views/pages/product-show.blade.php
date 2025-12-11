@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('category', $product['category']) }}">{{ $product['category'] }}</a></li>
                <li class="breadcrumb-item active">{{ $product['name'] }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-6">
                <div class="product-image-container text-center">
                    <img src="{{ $product['image'] }}" class="img-fluid rounded" alt="{{ $product['name'] }}"
                         onerror="this.src='https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=600&h=600&fit=crop'"
                         style="max-height: 500px; object-fit: contain;">
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-details">
                    <span class="badge bg-primary mb-2">{{ $product['category'] }}</span>
                    <h1 class="display-6">{{ $product['name'] }}</h1>
                    <p class="lead">{{ $product['description'] }}</p>
                    
                    <div class="price-section mb-4">
                        <h2 class="text-primary">${{ number_format($product['price'], 2) }}</h2>
                        <div class="rating mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <span class="text-muted ms-2">(128 reviews)</span>
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="features mb-4">
                        <h5>Key Features:</h5>
                        <div class="row">
                            @foreach($product['features'] as $feature)
                            <div class="col-md-6 mb-2">
                                <i class="fas fa-check text-success me-2"></i>{{ $feature }}
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Specifications -->
                    <div class="specifications mb-4">
                        <h5>Specifications:</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    @foreach($product['specifications'] as $key => $value)
                                    <tr>
                                        <th class="w-25">{{ $key }}</th>
                                        <td>{{ $value }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <!-- Additional Info -->
                    <div class="additional-info mt-4">
                        <div class="row text-center">
                            <div class="col-4">
                                <i class="fas fa-shipping-fast text-primary mb-2"></i>
                                <p class="small mb-0">Free Shipping</p>
                            </div>
                            <div class="col-4">
                                <i class="fas fa-undo-alt text-primary mb-2"></i>
                                <p class="small mb-0">30-Day Returns</p>
                            </div>
                            <div class="col-4">
                                <i class="fas fa-shield-alt text-primary mb-2"></i>
                                <p class="small mb-0">2-Year Warranty</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</section>
@endsection

@section('scripts')
<script>
class ShoppingCart {
    constructor() {
        this.items = [];
        this.loadFromStorage();
        this.updateCartCount();
    }

    addItem(product, quantity = 1) {
        const existingItem = this.items.find(item => item.id === product.id);
        if (existingItem) {
            existingItem.quantity += quantity;
        } else {
            this.items.push({...product, quantity });
        }
        this.saveToStorage();
        this.updateCartCount();
        this.showAddToCartMessage(product.name, quantity);
    }

    getTotalItems() {
        return this.items.reduce((total, item) => total + item.quantity, 0);
    }

    updateCartCount() {
        const cartCount = document.getElementById('cart-count');
        if(cartCount) cartCount.textContent = this.getTotalItems();
    }

    showAddToCartMessage(productName, quantity) {
        const toast = document.createElement('div');
        toast.className = 'alert alert-success position-fixed top-0 end-0 m-3';
        toast.style.zIndex = '1050';
        toast.innerHTML = `<i class="fas fa-check-circle me-2"></i><strong>${quantity} x ${productName}</strong> added to cart!`;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }

    saveToStorage() {
        localStorage.setItem('modamart_cart', JSON.stringify(this.items));
    }

    loadFromStorage() {
        const saved = localStorage.getItem('modamart_cart');
        if(saved) this.items = JSON.parse(saved);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    window.shoppingCart = new ShoppingCart();

    // Main product add to cart
    document.querySelectorAll('.add-to-cart').forEach(btn => {
        btn.addEventListener('click', function() {
            const product = {
                id: this.dataset.id,
                name: this.dataset.product,
                price: parseFloat(this.dataset.price),
                image: this.dataset.image
            };
            const qtySelect = this.parentElement.querySelector('.quantity-selector');
            const quantity = qtySelect ? parseInt(qtySelect.value) : 1;
            window.shoppingCart.addItem(product, quantity);

            // Animate cart icon
            const cartIcon = document.querySelector('.fa-shopping-cart');
            if(cartIcon) {
                cartIcon.style.transform = 'scale(1.2)';
                setTimeout(() => cartIcon.style.transform = 'scale(1)', 300);
            }
        });
    });

    // Related products add to cart
    document.querySelectorAll('.add-to-cart-related').forEach(btn => {
        btn.addEventListener('click', function() {
            const product = {
                id: this.dataset.id,
                name: this.dataset.product,
                price: parseFloat(this.dataset.price),
                image: this.dataset.image
            };
            window.shoppingCart.addItem(product, 1);
        });
    });
});
</script>
@endsection
