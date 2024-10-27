<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Online Auction</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Link to CSS file -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .about-container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .content-section {
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            padding: 15px 0;
            background: #343a40;
            color: white;
            width: 100%;
            position: relative;
            bottom: 0;
            border-top: 4px solid #4a90e2;
        }
        .navbar {
            padding: 20px;
            border-bottom: 4px solid #4a90e2;
            margin-bottom: 50px; /* Space below the navbar */
        }
        .navbar-brand img {
            height: 50px;
            border: 2px solid #f39c12;
            padding: 5px;
            border-radius: 50%;
        }
        .navbar-nav .nav-link {
            border: 2px solid;
            padding: 10px;
            border-radius: 5px;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}" style="border-color: #2980b9;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}" style="border-color: #27ae60;">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auctions.index') }}" style="border-color: #c0392b;">Auctions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}" style="border-color: #8e44ad;">Contact</a>
                    </li>
                </ul>

                <!-- Search Bar -->
                <form class="d-flex" role="search" style="border: 2px solid #27ae60; padding: 5px; border-radius: 5px;">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit"><i class="fa fa-search"></i></button>
                </form>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}" style="border-color: #f39c12;">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}" style="border-color: #f39c12;">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="border-color: #f39c12;">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of Header Section -->

    <!-- About Us Section -->
    <div class="about-container">
        <h2 class="text-center mb-4">About Us</h2>
        <div class="content-section">
            <h4>Our Mission</h4>
            <p>At Online Auction, our mission is to provide a secure and user-friendly platform where buyers and sellers can engage in fair and competitive bidding. We aim to revolutionize the auction experience by leveraging cutting-edge technology and ensuring transparency at every step.</p>
        </div>
        <div class="content-section">
            <h4>Who We Are</h4>
            <p>Founded in 2023, Online Auction has quickly become a trusted name in the world of online auctions. Our team consists of experienced professionals from various industries, all united by a common goal: to make online auctions accessible and enjoyable for everyone.</p>
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

    <!-- Footer Section -->
    <div class="footer">
        &copy; {{ date('Y') }} Online Auction. All rights reserved.
    </div>
    <!-- End of Footer Section -->

    <script src="{{ asset('js/app.js') }}"></script> <!-- Link to your JS file -->
</body>
</html>
