<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Tour Freak</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background: linear-gradient(to right, #2e8b57, #3cb371);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            color: #fff;
        }

        .navbar ul {
            display: flex;
            list-style: none;
            gap: 1.5rem;
        }

        .navbar a {
            text-decoration: none;
            color: #f8f8f8;
            font-weight: 500;
        }

        .login-container {
            max-width: 400px;
            background: #ffffff;
            padding: 2rem;
            margin: 3rem auto;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .login-container h2 {
            text-align: center;
            color: #2e8b57;
            margin-bottom: 1.5rem;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .login-form input {
            padding: 0.5rem;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-form button {
            padding: 0.5rem;
            background-color: #2e8b57;
            color: #fff;
            font-weight: bold;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 1rem;
        }

        .login-form button:hover {
            background-color: #276c4a;
        }

        .footer {
            background: #2e8b57;
            padding: 1.5rem 2rem;
            text-align: center;
            color: #f1f1f1;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .footer p {
            margin-bottom: 0.5rem;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
            padding: 0;
        }

        .footer-links a {
            text-decoration: none;
            color: #f1f1f1;
            font-size: 0.95rem;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }
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