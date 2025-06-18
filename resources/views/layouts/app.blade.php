<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'OnlineAuctionSystem') }}</title>

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #e0e7ff 0%, #f8fafc 100%);
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background: linear-gradient(90deg, #0d6efd 60%, #6610f2 100%);
            border-bottom: 3px solid #0d6efd;
            box-shadow: 0 2px 8px rgba(13,110,253,0.08);
        }
        .navbar .navbar-brand, .navbar .nav-link, .navbar .dropdown-toggle {
            color: #fff !important;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        .navbar .nav-link.active, .navbar .nav-link:hover, .navbar .dropdown-toggle:hover {
            color: #ffe082 !important;
            transition: color 0.2s;
        }
        .navbar-brand img {
            height: 36px;
            margin-right: 12px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.08));
        }
        .profile-dropdown .dropdown-menu {
            animation: fadeInDown 0.3s;
            border-radius: 1rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.10);
            min-width: 200px;
        }
        .profile-dropdown .dropdown-item:hover {
            background: #f1f3f9;
            color: #0d6efd;
        }
        .profile-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.10);
            margin-right: 8px;
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-10px);}
            to { opacity: 1; transform: translateY(0);}
        }
        main {
            flex: 1;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        .footer {
            background: linear-gradient(90deg, #0d6efd 60%, #6610f2 100%);
            color: #fff;
            border-top: 3px solid #0d6efd;
            padding: 24px 0 12px 0;
            text-align: center;
            font-size: 1rem;
            letter-spacing: 0.2px;
        }
        .footer a {
            color: #ffe082;
            text-decoration: underline;
        }
        .footer a:hover {
            color: #fff;
        }
        /* Card hover effect */
        .hover-effect {
            transition: transform 0.3s cubic-bezier(.4,2,.6,1), box-shadow 0.3s;
        }
        .hover-effect:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 8px 32px rgba(13,110,253,0.12);
        }
        /* Button hover effect */
        .hover-btn-effect {
            transition: background 0.3s, transform 0.2s;
        }
        .hover-btn-effect:hover {
            background: linear-gradient(90deg, #0d6efd 60%, #6610f2 100%);
            color: #fff;
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 4px 16px rgba(13,110,253,0.10);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                <span>{{ config('app.name', 'OnlineAuctionSystem') }}</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Left Side of Navbar -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-house-door"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('auctions.index') ? 'active' : '' }}" href="{{ route('auctions.index') }}"><i class="bi bi-gavel"></i> My Auctions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}"><i class="bi bi-info-circle"></i> About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}"><i class="bi bi-envelope"></i> Contact</a>
                    </li>
                </ul>

                <!-- Right Side of Navbar (User Menu) -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><i class="bi bi-person-plus"></i> Register</a>
                        </li>
                    @else
                        <li class="nav-item dropdown profile-dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if(Auth::user()->avatar)
                                    <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" class="profile-avatar" alt="Profile">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0d6efd&color=fff&size=64" class="profile-avatar" alt="Profile">
                                @endif
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end mt-2 shadow">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person-circle me-2"></i> Edit Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('auctions.index') }}">
                                        <i class="bi bi-gavel me-2"></i> My Auctions
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </a>
                                </li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Section -->
    <main class="container">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="mb-1">&copy; {{ date('Y') }} <b>Online Auction System</b>. All rights reserved.</p>
            <small>
                Follow us on
                <a href="#"><i class="bi bi-facebook"></i> Facebook</a> |
                <a href="#"><i class="bi bi-twitter"></i> Twitter</a> |
                <a href="#"><i class="bi bi-instagram"></i> Instagram</a>
            </small>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        // Card and button hover effects (already handled by CSS)
        // DataTables init
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>
</body>
</html>
