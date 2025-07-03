@extends('index')

@push('style')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush

@section('content')
<div class="register-container">
    <h2>Create Account</h2>
    <form id="registerForm" method="POST" action="{{ route('register.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Full Name" required />
        <input type="email" name="email" placeholder="Email Address" required />
        <input type="password" name="password" placeholder="Password" required />
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
        <div class="error" id="error"></div>
        <button type="submit">Register</button>
    </form>
    <div class="login-link">
        Already have an account? <a href="/login">Login</a>
    </div>
</div>

<script src="{{ asset('js/register.js') }}"></script>
@endsection
