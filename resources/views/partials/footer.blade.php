<footer class="py-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5 class="text-white">
                    <i class="fas fa-shopping-bag me-2"></i>Modamart
                </h5>
                <p class="text-light">Your ultimate shopping destination with thousands of products across multiple categories. Quality guaranteed.</p>
                <div class="social-links">
                    <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-light"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div class="col-md-2">
                <h6 class="text-white">Shop</h6>
                <ul class="list-unstyled">
                    @foreach(App\Models\Category::getAllCategories() as $category)
                    <li><a href="{{ route('products') }}?category={{ urlencode($category['name']) }}" class="text-light">{{ $category['name'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-2">
                <h6 class="text-white">Help</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-light">Customer Service</a></li>
                    <li><a href="#" class="text-light">Shipping Policy</a></li>
                    <li><a href="#" class="text-light">Returns & Refunds</a></li>
                    <li><a href="#" class="text-light">Size Guide</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h6 class="text-white">Company</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-light">About Us</a></li>
                    <li><a href="#" class="text-light">Careers</a></li>
                    <li><a href="#" class="text-light">Terms & Conditions</a></li>
                    <li><a href="#" class="text-light">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h6 class="text-white">Contact</h6>
                <ul class="list-unstyled text-light">
                    <li><i class="fas fa-map-marker-alt me-2"></i>123 Mall Street</li>
                    <li><i class="fas fa-phone me-2"></i>(555) 123-4567</li>
                    <li><i class="fas fa-envelope me-2"></i>info@modamart.com</li>
                </ul>
            </div>
        </div>
        <hr class="my-4 bg-light">
        <div class="row">
            <div class="col-md-6">
                <p class="text-light mb-0">&copy; 2024 Modamart. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-end">
                <img src="https://www.pngall.com/wp-content/uploads/2016/07/Payment-Methods-Accepted-PNG.png" alt="Payment Methods" height="30">
            </div>
        </div>
    </div>
</footer>