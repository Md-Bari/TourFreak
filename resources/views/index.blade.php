<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tour Freak - Home</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('style')

</head>
<body>

    <!-- Fixed Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-ocean py-3 fixed-top shadow-sm">
        <div class="container-fluid px-5">
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
    <main class="full-width p-0 m-0">
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
                <!-- Social Icons -->
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
                    <li><a href="{{ route('dashboard') }}" class="text-secondary text-decoration-none">dashboard</a></li>
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

        <!-- Bottom Bar -->
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

    <!-- Optional scroll behavior -->
    <script>
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
