<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Tour Freak</title>
    <style>
        
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="navbar-brand">TourFreak</div>
        <ul>
            <li><a href="{{ url('/welcome') }}">welcome</a></li>
            <li><a href="#">Rooms</a></li>
            <li><a href="#">Facilities</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">About</a></li>
        </ul>
    </nav>

    <div class="login-container">
        <h2>Login to Tour Freak</h2>
        <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf

            <input type="email" name="email" placeholder="Email" required autofocus value="{{ old('email') }}">
            @error('email')
                <span style="color:red; font-size:0.85rem;">{{ $message }}</span>
            @enderror

            <input type="password" name="password" placeholder="Password" required>
            @error('password')
                <span style="color:red; font-size:0.85rem;">{{ $message }}</span>
            @enderror

            <button type="submit">Login</button>
        </form>
        <p style="text-align:center; margin-top:1rem; font-size:0.95rem;">
            Don't have an account? <a href="{{ route('register') }}" style="color:#2e8b57; text-decoration:underline;">Register here</a>
        </p>
    </div>

    <footer class="footer">
        <p>&copy; 2025 Tour Freak. All rights reserved.</p>
        <ul class="footer-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Support</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
        </ul>
    </footer>

</body>

</html>