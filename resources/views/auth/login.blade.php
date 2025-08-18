@extends('index')

@section('content')
<style>
    /* ============================
       GLOBAL VARIABLES & THEME
    ============================ */
    :root {
        --primary-gradient: linear-gradient(135deg, #6a11cb, #2575fc);
        --secondary-gradient: linear-gradient(135deg, #ff6a00, #ee0979);
        --primary-color: #6a11cb;
        --secondary-color: #2575fc;
        --text-dark: #333;
        --text-light: #fff;
        --bg-light: #f8f9fa;
        --card-radius: 18px;
        --transition-speed: 0.3s;
        --shadow-soft: 0 8px 25px rgba(0, 0, 0, 0.15);
        --shadow-hover: 0 12px 35px rgba(0, 0, 0, 0.25);
    }

    /* ============================
       PAGE BACKGROUND
    ============================ */
    body {
        background: linear-gradient(-45deg, #6a11cb, #2575fc, #ff6a00, #ee0979);
        background-size: 400% 400%;
        animation: gradientMove 12s ease infinite;
        font-family: 'Segoe UI', sans-serif;
    }

    @keyframes gradientMove {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* ============================
       AUTH SECTION
    ============================ */
    .auth-section {
        min-height: calc(100vh - 140px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px 20px;
        position: relative;
    }

    /* ============================
       GLASSMORPHIC LOGIN CARD
    ============================ */
    .login-card {
        background: rgba(255, 255, 255, 0.15);
        border-radius: var(--card-radius);
        padding: 2rem;
        max-width: 450px;
        width: 100%;
        box-shadow: var(--shadow-soft);
        z-index: 1;
        animation: fadeInUp 0.6s ease, floatCard 6s ease-in-out infinite;
        position: relative;
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    @keyframes floatCard {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* ============================
       CARD HEADER
    ============================ */
    .login-card-header {
        text-align: center;
        margin-bottom: 1.5rem;
    }
    .login-card-header i {
        font-size: 55px;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
        margin-bottom: 10px;
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
    .login-card-header h2 {
        font-weight: bold;
        color: var(--text-light);
    }
    .login-card-header p {
        color: rgba(255,255,255,0.8);
        font-size: 14px;
    }

    /* ============================
       FORM STYLING
    ============================ */
    .form-group {
        margin-bottom: 1.2rem;
    }
    .form-control {
        border-radius: 8px;
        padding: 12px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        background: rgba(255,255,255,0.1);
        color: #fff;
        transition: border-color var(--transition-speed), box-shadow var(--transition-speed);
        font-size: 15px;
    }
    .form-control:focus {
        border-color: var(--secondary-color);
        box-shadow: 0 0 10px rgba(106, 17, 203, 0.4);
    }
    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    /* Password toggle icon */
    .password-wrapper {
        position: relative;
    }
    .password-wrapper .toggle-password {
        position: absolute;
        top: 50%;
        right: 12px;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 18px;
        color: #ddd;
    }
    .password-wrapper .toggle-password:hover {
        color: #fff;
    }

    /* ============================
       BUTTONS
    ============================ */
    .btn-primary {
        background: var(--primary-gradient);
        border: none;
        padding: 12px;
        font-weight: bold;
        border-radius: 8px;
        color: white;
        transition: transform var(--transition-speed), box-shadow var(--transition-speed);
        width: 100%;
        font-size: 16px;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
    }
    .btn-secondary {
        background: var(--secondary-gradient);
        color: white;
        padding: 12px;
        border-radius: 8px;
        border: none;
        width: 100%;
        font-weight: bold;
        transition: transform var(--transition-speed), box-shadow var(--transition-speed);
        margin-top: 10px;
    }
    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
    }

    /* ============================
       ALERT
    ============================ */
    .alert {
        border-radius: 8px;
        padding: 10px 15px;
        font-size: 14px;
        margin-bottom: 1rem;
    }
    .alert-danger {
        background-color: rgba(255, 0, 0, 0.15);
        border-left: 5px solid red;
        color: #fff;
    }

    /* ============================
       LINKS
    ============================ */
    .auth-links {
        text-align: center;
        margin-top: 1rem;
    }
    .auth-links a {
        color: #fff;
        font-weight: 600;
        text-decoration: none;
        transition: color var(--transition-speed);
    }
    .auth-links a:hover {
        color: #ffea00;
    }

    /* ============================
       ANIMATIONS
    ============================ */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="auth-section">
    <div class="login-card">
        <!-- Header -->
        <div class="login-card-header">
            <i class="fas fa-user-circle"></i>
            <h2>Welcome Back</h2>
            <p>Please login to your account</p>
        </div>

        <!-- Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <div class="form-group">
                <input type="email" name="email" placeholder="Email address" value="{{ old('email') }}" class="form-control" required autofocus />
            </div>
            <div class="form-group password-wrapper">
                <input type="password" name="password" placeholder="Password" class="form-control" required id="password" />
                <span class="toggle-password" onclick="togglePassword()">👁️</span>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <!-- Extra links -->
        <div class="auth-links">
            <p>Don't have an account? <a href="{{ route('register.create') }}">Register here</a></p>
            <p><a href="#">Forgot your password?</a></p>
        </div>
    </div>
</div>

<!-- JS for password toggle -->
<script>
    function togglePassword() {
        const password = document.getElementById('password');
        password.type = password.type === 'password' ? 'text' : 'password';
    }
</script>
@endsection
