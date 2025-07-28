@extends('index')

@section('content')
<div class="container mt-5" style="max-width: 400px;">
    <h2>Login</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif
    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="form-control" required autofocus />
        </div>
        <div class="mb-3">
            <input type="password" name="password" placeholder="Password" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <p class="mt-3">Don't have an account? <a href="{{ route('register.create') }}">Register here</a></p>
</div>
@endsection
