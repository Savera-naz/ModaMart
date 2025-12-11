@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Welcome to Modamart</h1>
            <p class="lead mb-4">Your Ultimate Shopping Destination with Thousands of Products</p>
            <form action="{{ route('products') }}" method="GET" class="row justify-content-center">
                <div class="col-md-8">
                    <div class="input-group input-group-lg">
                        <input type="text" name="search" class="form-control" placeholder="What are you looking for today?" value="{{ request('search') }}">
                        <button class="btn btn-secondary" type="submit">
                            <i class="fas fa-search me-2"></i>Search
                        </button>
                    </div>
                </div>
            </form>
            <div class="mt-4">
                <small class="text-light">Popular: iPhone • Nike Shoes • Smart TV • Laptop • Kitchen Appliances</small>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center section-title">Shop by Category</h2>
            <p class="text-center text-muted mb-5">Explore our wide range of product categories</p>
            <div class="row">
                @foreach($categories as $category)
                <div class="col-md-4 col-lg-2 mb-4">
                    <div class="card category-card h-100 text-center">
                        <a href="{{ route('category', $category['name']) }}" class="text-decoration-none">
                            <img src="{{ $category['image'] }}" class="card-img-top category-image" alt="{{ $category['name'] }}"
                                 onerror="this.src='https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=400&h=300&fit=crop'">
                            <div class="card-body">
                                <h6 class="card-title text-dark mb-1">{{ $category['name'] }}</h6>
                                <small class="text-muted">{{ $category['count'] }} products</small>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title">Featured Products</h2>
            <p class="text-center text-muted mb-5">Discover our most popular items</p>
            <div class="row">
                @foreach($featuredProducts as $product)
                <div class="col-md-4 mb-4">
                    <div class="card product-card h-100">
                        <div class="position-relative">
                            <img src="{{ $product['image'] }}" class="card-img-top product-image" alt="{{ $product['name'] }}"
                                 onerror="this.src='https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=500&h=500&fit=crop'">
                            <span class="badge bg-success position-absolute top-0 start-0 m-2">Featured</span>
                            <span class="badge bg-primary position-absolute top-0 end-0 m-2">{{ $product['category'] }}</span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product['name'] }}</h5>
                            <p class="card-text text-muted small flex-grow-1">{{ $product['description'] }}</p>
                            <div class="mt-auto">
                                <p class="price mb-2">${{ number_format($product['price'], 2) }}</p>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <select class="form-select quantity-selector" style="width: 80px;">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                    <button class="btn btn-primary add-to-cart ms-2" 
                                            data-id="{{ $product['id'] }}"
                                            data-product="{{ $product['name'] }}" 
                                            data-price="{{ $product['price'] }}"
                                            data-image="{{ $product['image'] }}">
                                        <i class="fas fa-cart-plus"></i> Add
                                    </button>
                                </div>
                                <a href="{{ route('product.show', $product['id']) }}" class="btn btn-outline-secondary btn-sm w-100">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('products') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-grid me-2"></i>View All Products
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-shipping-fast fa-3x text-primary mb-3"></i>
                        <h5>Free Shipping</h5>
                        <p class="text-muted">On orders over $50</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-undo-alt fa-3x text-primary mb-3"></i>
                        <h5>Easy Returns</h5>
                        <p class="text-muted">30-day return policy</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-lock fa-3x text-primary mb-3"></i>
                        <h5>Secure Payment</h5>
                        <p class="text-muted">100% secure payment</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="feature-icon">
                        <i class="fas fa-headset fa-3x text-primary mb-3"></i>
                        <h5>24/7 Support</h5>
                        <p class="text-muted">Dedicated support</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection