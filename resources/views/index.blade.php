<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tour Freak - Home</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Custom CSS pushed from pages -->
    @stack('style')
</head>

<body>

    <!-- Classy Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-ocean py-3 fixed-top shadow-sm">
        <div class="container-fluid px-5">
            <a class="navbar-brand fw-bold text-light fs-4" href="{{ route('home') }}">
                Tour<span class="text-primary">Freak</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navMenu">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item"><a class="nav-link text-light" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="#">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="#">Facilities</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="#">Contact</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="#">About</a></li>
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
                        <li class="nav-item"><a class="btn btn-primary btn-sm" href="{{ route('register.show') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <main class="full-width p-0 m-0"> style="margin-top: 80px;">
        @yield('content')
    </main>

    <!-- Classy Footer -->
    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-1 fw-light">&copy; 2025 <strong>TourFreak</strong>. All rights reserved.</p>
            <div class="small">
                <a href="#" class="text-secondary text-decoration-none me-3">Privacy Policy</a>
                <a href="#" class="text-secondary text-decoration-none me-3">Terms</a>
                <a href="#" class="text-secondary text-decoration-none">Support</a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Optional Navbar Scroll Behavior -->
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
</body>

</html>
