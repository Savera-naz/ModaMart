@extends('layouts.app')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="section-title">
                    @if($category && $category !== 'All Categories')
                        {{ $category }} Products
                    @else
                        All Products
                    @endif
                </h2>
            </div>
            <div class="col-md-4 text-end">
                {{-- Ensure count() is called safely --}}
                <p class="mb-0 mt-2 text-muted">Showing {{ $filteredProducts->count() }} products</p>
            </div>
        </div>

        ---

        <div class="row mb-4">
            <div class="col-md-8">
                <form action="{{ route('products') }}" method="GET" class="row g-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ $search ?? '' }}">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Search</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="category" class="form-select">
                            {{-- MODIFIED LINE 36 FIX --}}
                            @php
                                // Convert $categories to array safely for in_array check
                                $category_array = is_array($categories) ? $categories : ($categories instanceof \Illuminate\Support\Collection ? $categories->toArray() : (is_countable($categories) ? $categories : []));
                            @endphp
                            
                            {{-- Check if 'All Categories' option is present, otherwise add it as the default --}}
                            @if (!in_array('All Categories', $category_array))
                                <option value="All Categories" {{ ($category ?? 'All Categories') == 'All Categories' ? 'selected' : '' }}>
                                    All Categories
                                </option>
                            @endif
                            
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ ($category ?? 'All Categories') == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4 text-end">
                @if($search || ($category && $category !== 'All Categories'))
                    <a href="{{ route('products') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Clear Filters
                    </a>
                @endif
            </div>
        </div>

        ---

        @if($filteredProducts->count() > 0)
        <div class="row" id="products-container">
            @foreach($filteredProducts as $product)
            {{-- SAFE ATTRIBUTE ACCESS: Using $product->property ?? $product['property'] --}}
            @php
                // Safely extract product attributes, defaulting to array access if object property fails
                $id = $product->id ?? $product['id'] ?? null;
                $name = $product->name ?? $product['name'] ?? 'Untitled Product';
                $image = $product->image ?? $product['image'] ?? null;
                $category_name = $product->category ?? $product['category'] ?? 'N/A';
                $description = $product->description ?? $product['description'] ?? 'No description available.';
                $features = $product->features ?? $product['features'] ?? [];
                $price = $product->price ?? $product['price'] ?? 0.00;
            @endphp
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card product-card h-100">
                    <div class="position-relative">
                        <img src="{{ $image }}" class="card-img-top product-image" alt="{{ $name }}">
                        <span class="badge bg-primary position-absolute top-0 end-0 m-2">{{ $category_name }}</span>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $name }}</h5>
                        <p class="card-text flex-grow-1">{{ $description }}</p>

                        <div class="mb-3">
                            @if(is_array($features) && count($features) > 0)
                                @foreach(array_slice($features, 0, 3) as $feature)
                                    <span class="badge bg-light text-dark me-1 mb-1">
                                        <i class="fas fa-check text-success me-1"></i>{{ $feature }}
                                    </span>
                                @endforeach
                                @if(count($features) > 3)
                                    <span class="badge bg-secondary">+{{ count($features) - 3 }} more</span>
                                @endif
                            @endif
                        </div>

                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <p class="price mb-0">${{ number_format($price, 2) }}</p>
                                <div class="rating">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <select class="form-select quantity-selector">
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <button class="btn btn-primary add-to-cart ms-2" 
                                        data-id="{{ $id }}"
                                        data-product="{{ $name }}" 
                                        data-price="{{ $price }}"
                                        data-image="{{ $image }}">
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                            </div>
                            <a href="{{ route('product.show', $id) }}" class="btn btn-outline-secondary btn-sm w-100">
                                <i class="fas fa-eye me-1"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5 my-5">
            <i class="fas fa-search fa-4x text-muted mb-3"></i>
            <h3 class="text-muted mb-3">No products found</h3>
            <p class="text-muted mb-4">
                @if($search)
                    No products found for "**{{ $search }}**"
                @elseif($category && $category !== 'All Categories')
                    No products found in the **{{ $category }}** category
                @else
                    No products available
                @endif
            </p>
            <a href="{{ route('products') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-grid me-2"></i>Browse All Products
            </a>
        </div>
        @endif
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.querySelector('select[name="category"]');
    if (categorySelect) {
        // Automatic form submission on category change
        categorySelect.addEventListener('change', function() {
            this.form.submit();
        });
    }

    // Image fallback: if the provided image URL fails, load a placeholder
    document.querySelectorAll('.product-image').forEach(img => {
        img.addEventListener('error', function() {
            // Prevent infinite loop if placeholder itself fails
            if (this.src !== 'https://via.placeholder.com/500') {
                this.src = 'https://via.placeholder.com/500';
            }
        });
    });

    // Add to Cart Logic using localStorage
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.id;
            const name = this.dataset.product;
            const price = parseFloat(this.dataset.price);
            const image = this.dataset.image;
            // Find the quantity selector which is the previous sibling element
            const quantity = parseInt(this.previousElementSibling.value);

            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const index = cart.findIndex(item => item.id == productId);
            
            if (index > -1) {
                // Product exists, increment quantity
                cart[index].quantity += quantity;
            } else {
                // Product is new, add to cart
                cart.push({ id: productId, name, price, quantity, image });
            }
            
            localStorage.setItem('cart', JSON.stringify(cart));
            alert(`"${name}" (${quantity} unit(s)) added to cart!`);
        });
    });
});
</script>
@endsection