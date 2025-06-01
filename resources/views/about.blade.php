@extends('layouts.app')

@section('title', 'About Us - Online Auction')

@section('content')
<section class="py-5 bg-light">
    <div class="container my-4">
        <h1 class="text-center mb-5 display-4 fw-bold text-primary">About Online Auction</h1>
        <p class="lead text-center mb-5 text-muted">
            Your trusted platform for secure and thrilling online bidding experiences.
        </p>

        <div class="row g-4 mb-5">
            <div class="col-md-6 d-flex align-items-stretch">
                <div class="card shadow-sm p-4 w-100 hover-effect">
                    <div class="card-body">
                        <h4 class="card-title text-success mb-3"><i class="fas fa-bullseye me-2"></i>Our Mission</h4>
                        <p class="card-text">At Online Auction, our mission is to redefine the bidding landscape. We are committed to providing a <strong>secure, transparent, and user-friendly platform</strong> that empowers both buyers and sellers. By leveraging cutting-edge technology, we aim to facilitate fair competition and ensure a seamless auction experience for everyone.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-stretch">
                <div class="card shadow-sm p-4 w-100 hover-effect">
                    <div class="card-body">
                        <h4 class="card-title text-info mb-3"><i class="fas fa-users-gear me-2"></i>Who We Are</h4>
                        <p class="card-text">Established in <strong>2024</strong>, Online Auction has rapidly emerged as a reliable destination for online bidding. Our dedicated team comprises seasoned professionals from diverse backgrounds, collectively driven by a singular vision: to make the excitement and opportunity of online auctions universally accessible and truly enjoyable.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card shadow-sm p-4 w-100 hover-effect">
                    <div class="card-body">
                        <h4 class="card-title text-warning mb-3"><i class="fas fa-boxes-stacked me-2"></i>What We Offer</h4>
                        <p class="card-text">Our comprehensive platform caters to a vast array of interests, featuring diverse auction categories including:
                            <strong class="d-block mt-2">Electronics, rare Collectibles, reliable Vehicles, unique Art pieces, and much more.</strong>
                            We equip sellers with robust tools to maximize their reach and potential, while enabling buyers to effortlessly discover exceptional items at competitive prices, all within a vibrant marketplace.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card shadow-sm p-4 w-100 hover-effect">
                    <div class="card-body">
                        <h4 class="card-title text-danger mb-3"><i class="fas fa-handshake-angle me-2"></i>Our Core Values</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><strong><i class="fas fa-check-circle text-success me-2"></i>Integrity:</strong> We steadfastly uphold the highest standards of honesty, fairness, and transparency across all our operations and interactions.</li>
                            <li class="mb-2"><strong><i class="fas fa-lightbulb text-warning me-2"></i>Innovation:</strong> We are committed to continuous advancement, constantly refining our platform and services to deliver an unparalleled user experience.</li>
                            <li class="mb-2"><strong><i class="fas fa-heart text-danger me-2"></i>Customer Focus:</strong> The needs and satisfaction of our global community of users remain at the forefront of our priorities, guiding every decision we make.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center p-4 bg-white rounded shadow-sm hover-effect-alt">
            <h4 class="mb-3">Ready to Start Bidding or Selling?</h4>
            <p class="lead">Have questions or need personalized assistance? Our dedicated support team is always ready to help.</p>
            <a href="{{ route('contact') }}" class="btn btn-lg btn-primary mt-3 hover-btn-effect"><i class="fas fa-envelope me-2"></i>Contact Our Support Team</a>
        </div>

    </div>
</section>
@endsection
