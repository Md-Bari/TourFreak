@extends('index')

@section('content')
<div class="login-container">
    <h2>Login</h2>
    @if(session('error'))
        <div style="color:red; margin-bottom:1rem;">{{ session('error') }}</div>
    @endif
    <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required autofocus>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="{{ url('/register') }}">Register here</a></p>
</div>
@endsection
