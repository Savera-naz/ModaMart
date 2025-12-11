<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-shopping-bag me-2"></i>Modamart
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products') ? 'active fw-bold' : '' }}" href="{{ route('products') }}">All Products</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Categories
                    </a>
                    <ul class="dropdown-menu">
                        @foreach(App\Models\Category::getAllCategories() as $category)
                        <li>
                            <a class="dropdown-item" href="{{ route('category', $category['name']) }}">
                                {{ $category['name'] }} 
                                <span class="badge bg-primary float-end">{{ $category['count'] }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active fw-bold' : '' }}" href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <form action="{{ route('products') }}" method="GET" class="d-flex me-3">
                    <div class="input-group search-box">
                        <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <a href="/cart" class="btn btn-outline-primary me-2 position-relative">
                    <i class="fas fa-shopping-cart"></i> Cart 
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-count">0</span>
                </a>
                <a href="/admin/products" class="btn btn-primary">
                    <i class="fas fa-user me-2"></i>Admin
                </a>
            </div>
        </div>
    </div>
</nav>