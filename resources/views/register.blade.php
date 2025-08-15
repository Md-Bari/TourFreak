@extends('index')

@section('content')
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        height: 100vh;
        overflow: hidden;
    }

    /* Floating animation for images */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    /* Background floating images */
    .floating-img {
        position: absolute;
        animation: float 6s ease-in-out infinite;
        z-index: 0;
        opacity: 0.2;
    }

    .floating-img.img1 {
        top: 10%;
        left: 5%;
        width: 150px;
        animation-delay: 0s;
    }
    .floating-img.img2 {
        bottom: 15%;
        right: 10%;
        width: 180px;
        animation-delay: 1s;
    }
    .floating-img.img3 {
        top: 50%;
        right: 30%;
        width: 200px;
        animation-delay: 2s;
    }

    /* Center form container */
    .register-container {
        position: relative;
        z-index: 1;
        max-width: 450px;
        margin: auto;
        padding: 40px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        margin-top: 5%;
        animation: fadeIn 1s ease-in-out;
    }

    /* Fade in animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    h2 {
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
        text-align: center;
    }

    .form-control {
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #2575fc;
        box-shadow: 0 0 10px rgba(37, 117, 252, 0.3);
    }

    .btn-primary {
        background: linear-gradient(45deg, #6a11cb, #2575fc);
        border: none;
        padding: 12px;
        font-weight: bold;
        border-radius: 8px;
        transition: transform 0.3s ease, background 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        background: linear-gradient(45deg, #2575fc, #6a11cb);
    }

    p {
        text-align: center;
        margin-top: 15px;
    }

    a {
        color: #2575fc;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

<!-- Floating background images -->
<img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" class="floating-img img1" alt="Floating Icon">
<img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="floating-img img2" alt="Floating Icon">
<img src="https://cdn-icons-png.flaticon.com/512/456/456212.png" class="floating-img img3" alt="Floating Icon">

<div class="register-container">
    <h2>Create Account</h2>
    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <div class="mb-3">
            <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" class="form-control" required />
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" class="form-control" required />
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" class="form-control" required />
            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <input type="password" name="password" placeholder="Password" class="form-control" required />
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
    <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
</div>
@endsection
