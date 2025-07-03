<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Tour Freak</title>
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  @stack('style')
</head>

<body>

  <div class="content">

    <nav class="navbar">
      <div class="navbar-brand">TourFreak</div>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Rooms</a></li>
        <li><a href="#">Facilities</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">About</a></li>
      </ul>
      <div class="navbar-buttons">
        <a href="{{ url('/login') }}" class="btn">Login</a>
        <a href="{{ url('/register') }}" class="btn">Register</a>
      </div>
    </nav>

    <div>
      @yield('content')
    </div>

  </div>

  <footer class="footer">
    <div class="footer-container">
      <p>&copy; 2025 Tour Freak. All rights reserved.</p>
      <ul class="footer-links">
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">Support</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms of Service</a></li>
      </ul>
    </div>
  </footer>

  @stack('java')
</body>

</html>
