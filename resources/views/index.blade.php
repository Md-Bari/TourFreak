<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tour Freak - Home</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px; /* hidden by default */
            height: 100%;
            width: 250px;
            background: #1e293b; /* Dark navy */
            color: #fff;
            padding-top: 60px; /* a little breathing space for links */
            transition: all 0.3s ease-in-out;
            z-index: 2000; /* above navbar */
        }
        .sidebar.active {
            left: 0; /* show sidebar */
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #cbd5e1;
            text-decoration: none;
            font-size: 15px;
            border-radius: 6px;
            margin: 5px 10px;
            transition: background 0.2s ease;
        }
        .sidebar a:hover {
            background: #334155;
            color: #fff;
        }
        .sidebar a i {
            width: 20px;
        }

        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1500;
            display: none;
        }
        .overlay.active {
            display: block;
        }

        /* Content shift for desktop */
        .content {
            transition: margin-left 0.3s;
        }
        @media(min-width: 992px) {
            .content.shifted {
                margin-left: 250px;
            }
        }
    </style>
    @stack('style')
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <br><br><a href="{{ route('home') }}"><i class="fas fa-home me-2"></i> Home</a>
        <a href="{{ route('dashboard') }}"><i class="fas fa-home me-2"></i> Dashboard</a>
        <a href="{{ route('profile') }}"><i class="fas fa-user me-2"></i> Profile</a>
        <a href="{{ route('my.bookings') }}"><i class="fas fa-calendar-alt me-2"></i> Bookings</a>
        <a href="{{ route('my-ads') }}"><i class="fas fa-ad me-2"></i> My Ads</a>
        <a href="{{ route('my-wishlist') }}"><i class="fas fa-heart me-2"></i> Wishlist</a>
        <a href="#"><i class="fas fa-bell me-2"></i> Notifications</a>
        <a href="#"><i class="fas fa-envelope me-2"></i> Messages</a>
        <a href="{{ route('settings.index') }}"><i class="fas fa-cog me-2"></i> Settings</a>
        <a href="{{ route('support.index') }}"><i class="fas fa-headset me-2"></i> Support</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Fixed Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-ocean py-3 fixed-top shadow-sm">
        <div class="container-fluid px-5">
            <!-- Sidebar toggle button (hamburger menu always visible) -->
            <button class="btn btn-outline-light me-3" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>

            <a class="navbar-brand fw-bold text-light fs-4" href="{{ route('home') }}">
                Tour<span class="text-primary">Freak</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navMenu">
                <ul class="navbar-nav gap-3 fs-5 fw-semibold">
                    <li class="nav-item"><a class="nav-link text-light" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="{{ route('room') }}">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="{{ route('contact') }}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="{{ route('about') }}">About</a></li>
                </ul>

                <ul class="navbar-nav ms-4 gap-2">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-primary fw-bold" href="{{ route('dashboard') }}">{{ auth()->user()->name }}</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="btn btn-primary btn-sm" href="{{ route('register.create') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="content p-0 m-0" id="mainContent">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light pt-5 pb-3">
        <div class="container">
            <div class="row text-center text-md-start">

                <!-- Logo & About -->
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase fw-bold mb-3">TourFreak</h5>
                    <p class="small text-light">
                        Explore the world with confidence and comfort. TourFreak brings you the best travel experiences, personalized for your journey.
                    </p>
                    <div class="d-flex justify-content-center justify-content-md-start gap-3 mt-3">
                        <a href="#" class="text-light fs-5"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light fs-5"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light fs-5"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light fs-5"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase fw-bold mb-3">Quick Links</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-secondary text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="{{ route('room') }}" class="text-secondary text-decoration-none">Rooms</a></li>
                        <li class="mb-2"><a href="{{ route('facilities') }}" class="text-secondary text-decoration-none">Facilities</a></li>
                        <li class="mb-2"><a href="{{ route('contact') }}" class="text-secondary text-decoration-none">Contact</a></li>
                        <li><a href="{{ route('about') }}" class="text-secondary text-decoration-none">About</a></li>
                        <li><a href="{{ route('dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a></li>
                    </ul>
                </div>
                <!-- Contact Info -->
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase fw-bold mb-3">Contact Us</h5>
                    <p class="small mb-2"><i class="fas fa-map-marker-alt me-2"></i>123 Main Street, Dhaka, Bangladesh</p>
                    <p class="small mb-2"><i class="fas fa-phone me-2"></i>+880 123 456 789</p>
                    <p class="small"><i class="fas fa-envelope me-2"></i>support@tourfreak.com</p>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="small mb-1">&copy; 2025 <strong>TourFreak</strong>. All rights reserved.</p>
                <div class="small">
                    <a href="#" class="text-secondary text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-secondary text-decoration-none me-3">Terms of Service</a>
                    <a href="#" class="text-secondary text-decoration-none">Help & Support</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sidebar Toggle -->
    <script>
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");
        const mainContent = document.getElementById("mainContent");

        document.getElementById("sidebarToggle").addEventListener("click", function () {
            sidebar.classList.toggle("active");
            overlay.classList.toggle("active");
            mainContent.classList.toggle("shifted");
        });

        overlay.addEventListener("click", function () {
            sidebar.classList.remove("active");
            overlay.classList.remove("active");
            mainContent.classList.remove("shifted");
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
    @stack('script')
</body>
</html>
