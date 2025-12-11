@extends('layouts.app')

@section('content')
    <section class="py-5">
        <div class="container">
            <h2 class="text-center section-title mb-5">Contact Us</h2>
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h4 class="card-title mb-4">Send us a Message</h4>
                            <form id="contactForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="firstName" class="form-label">First Name *</label>
                                        <input type="text" class="form-control" id="firstName" name="first_name" required>
                                        <div class="invalid-feedback">Please enter your first name.</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="lastName" class="form-label">Last Name *</label>
                                        <input type="text" class="form-control" id="lastName" name="last_name" required>
                                        <div class="invalid-feedback">Please enter your last name.</div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject *</label>
                                    <select class="form-select" id="subject" name="subject" required>
                                        <option value="">Choose a subject</option>
                                        <option value="general">General Inquiry</option>
                                        <option value="order">Order Status</option>
                                        <option value="return">Returns & Refunds</option>
                                        <option value="wholesale">Wholesale Inquiry</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a subject.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message *</label>
                                    <textarea class="form-control" id="message" name="message" rows="6" placeholder="Tell us how we can help you..." required></textarea>
                                    <div class="invalid-feedback">Please enter your message.</div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="contact-info">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marker-alt fa-2x mb-3"></i>
                                <h5>Visit Our Store</h5>
                                <p class="mb-0">123 Mall Street<br>City Center, CC 12345</p>
                            </div>
                        </div>
                        
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body text-center">
                                <i class="fas fa-phone fa-2x mb-3"></i>
                                <h5>Call Us</h5>
                                <p class="mb-0">(555) 123-4567<br>(555) 123-4568</p>
                            </div>
                        </div>
                        
                        <div class="card bg-warning text-dark mb-4">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope fa-2x mb-3"></i>
                                <h5>Email Us</h5>
                                <p class="mb-0">info@modamart.com<br>support@modamart.com</p>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Store Hours</h5>
                                <div class="store-hours">
                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                        <span>Monday - Friday</span>
                                        <span>9:00 AM - 9:00 PM</span>
                                    </div>
                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                        <span>Saturday</span>
                                        <span>10:00 AM - 8:00 PM</span>
                                    </div>
                                    <div class="d-flex justify-content-between py-2">
                                        <span>Sunday</span>
                                        <span>11:00 AM - 6:00 PM</span>
                                    </div>
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
    document.addEventListener('DOMContentLoaded', function() {
        const contactForm = document.getElementById('contactForm');
        
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simple form validation
            let isValid = true;
            const inputs = contactForm.querySelectorAll('input[required], select[required], textarea[required]');
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            
            if (isValid) {
                // Simulate form submission
                const submitBtn = contactForm.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
                submitBtn.disabled = true;
                
                setTimeout(() => {
                    alert('Thank you for your message! We will get back to you within 24 hours.');
                    contactForm.reset();
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    
                    // Remove any invalid classes
                    inputs.forEach(input => {
                        input.classList.remove('is-invalid');
                    });
                }, 2000);
            }
        });
        
        // Remove invalid class when user starts typing
        contactForm.querySelectorAll('input, select, textarea').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.trim()) {
                    this.classList.remove('is-invalid');
                }
            });
        });
    });
</script>
@endsection