<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modamart - Your Ultimate Shopping Destination</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c5aa0;
            --secondary-color: #ff6b35;
            --accent-color: #34495e;
            --light-color: #f8f9fa;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ffffff;
        }
        
        .navbar-brand {
            font-weight: bold;
            color: var(--primary-color) !important;
            font-size: 1.5rem;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), #1e3a8a);
            color: white;
            padding: 120px 0;
            text-align: center;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 40px;
            padding-bottom: 15px;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--secondary-color);
        }
        
        .product-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            border-radius: 15px;
            overflow: hidden;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.15);
        }
        
        .product-image {
            height: 250px;
            object-fit: contain;
            padding: 20px;
            background: #f8f9fa;
        }
        
        .price {
            color: var(--secondary-color);
            font-weight: bold;
            font-size: 1.3rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 10px 25px;
            font-weight: 600;
        }
        
        .btn-primary:hover {
            background-color: #1e3a8a;
            border-color: #1e3a8a;
        }
        
        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .quantity-selector {
            width: 80px;
            display: inline-block;
        }
        
        footer {
            background-color: #2c3e50;
            color: white;
        }
        
        .category-card {
            transition: transform 0.3s;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .category-card:hover {
            transform: translateY(-5px);
        }
        
        .category-image {
            height: 200px;
            object-fit: cover;
        }
        
        .discount-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: var(--secondary-color);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .search-box {
            max-width: 500px;
        }

        .feature-icon {
            padding: 20px;
            border-radius: 10px;
            background: #f8f9fa;
            transition: transform 0.3s;
        }

        .feature-icon:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <!-- Include Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Include Footer -->
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
   
   
   
   
   
   
   
   
   <script>
    // Cart functionality
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
                this.items.push({
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    image: product.image,
                    quantity: quantity
                });
            }
            
            this.saveToStorage();
            this.updateCartCount();
            this.showAddToCartMessage(product.name, quantity);
        }

        removeItem(productId) {
            this.items = this.items.filter(item => item.id !== productId);
            this.saveToStorage();
            this.updateCartCount();
        }

        clearCart() {
            this.items = [];
            this.saveToStorage();
            this.updateCartCount();
        }

        getTotalItems() {
            return this.items.reduce((total, item) => total + item.quantity, 0);
        }

        getTotalPrice() {
            return this.items.reduce((total, item) => total + (item.price * item.quantity), 0);
        }

        updateCartCount() {
            const cartCountElement = document.getElementById('cart-count');
            if (cartCountElement) {
                cartCountElement.textContent = this.getTotalItems();
            }
        }

        showAddToCartMessage(productName, quantity) {
            const toast = document.createElement('div');
            toast.className = 'alert alert-success position-fixed top-0 end-0 m-3';
            toast.style.zIndex = '1050';
            toast.innerHTML = `
                <i class="fas fa-check-circle me-2"></i>
                <strong>${quantity} x ${productName}</strong> added to cart!
            `;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        saveToStorage() {
            localStorage.setItem('modamart_cart', JSON.stringify(this.items));
        }

        loadFromStorage() {
            const savedCart = localStorage.getItem('modamart_cart');
            if (savedCart) {
                this.items = JSON.parse(savedCart);
            }
        }
    }

    // Initialize cart when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        window.shoppingCart = new ShoppingCart();

        // Add to cart buttons
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const product = {
                    id: this.getAttribute('data-id'),
                    name: this.getAttribute('data-product'),
                    price: parseFloat(this.getAttribute('data-price')),
                    image: this.getAttribute('data-image')
                };
                
                const quantity = this.parentElement.querySelector('.quantity-selector') ? 
                                parseInt(this.parentElement.querySelector('.quantity-selector').value) : 1;
                
                window.shoppingCart.addItem(product, quantity);

                // Animate cart icon
                const cartIcon = document.querySelector('.fa-shopping-cart');
                if(cartIcon) {
                    cartIcon.style.transform = 'scale(1.2)';
                    setTimeout(() => cartIcon.style.transform = 'scale(1)', 300);
                }
            });
        });

        // Clear cart button (if exists on page)
        const clearCartBtn = document.getElementById('clear-cart-btn');
        if(clearCartBtn) {
            clearCartBtn.addEventListener('click', function() {
                window.shoppingCart.clearCart();
            });
        }
    });
</script>

    
    @yield('scripts')
</body>
</html>