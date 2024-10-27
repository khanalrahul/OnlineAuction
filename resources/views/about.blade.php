@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    <!-- About Us Section -->
    <div class="about-container">
        <h2 class="text-center mb-4">About Us</h2>
        <div class="content-section">
            <h4>Our Mission</h4>
            <p>At Online Auction, our mission is to provide a secure and user-friendly platform where buyers and sellers can engage in fair and competitive bidding. We aim to revolutionize the auction experience by leveraging cutting-edge technology and ensuring transparency at every step.</p>
        </div>
        <div class="content-section">
            <h4>Who We Are</h4>
            <p>Founded in 2024, Online Auction has quickly become a trusted name in the world of online auctions. Our team consists of experienced professionals from various industries, all united by a common goal: to make online auctions accessible and enjoyable for everyone.</p>
        </div>
        <div class="content-section">
            <h4>What We Offer</h4>
            <p>Our platform offers a wide range of auction categories, including electronics, collectibles, vehicles, and more. We provide tools and features that help sellers maximize their reach and enable buyers to find unique items at great prices.</p>
        </div>
        <div class="content-section">
            <h4>Our Values</h4>
            <ul>
                <li><strong>Integrity:</strong> We uphold the highest standards of honesty and transparency in all our operations.</li>
                <li><strong>Innovation:</strong> We continuously improve our platform to provide the best user experience.</li>
                <li><strong>Customer Focus:</strong> We prioritize the needs and satisfaction of our users.</li>
            </ul>
        </div>
        <div class="content-section">
            <h4>Contact Us</h4>
            <p>Have questions or need assistance? Feel free to <a href="{{ route('contact') }}">contact us</a>. We're here to help you with any inquiries or support you may need.</p>
        </div>
    </div>
    <!-- End of About Us Section -->
@endsection
