@extends('index')

@section('content')
    <div class="container mt-5" style="max-width: 400px;">
        <h2>Create Account</h2>
        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" class="form-control"
                    required />
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" class="form-control"
                    required />
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" class="form-control"
                    required />
                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <input type="password" name="password" placeholder="Password" class="form-control" required />
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control"
                    required />
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
        <p class="mt-3">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
    </div>
@endsection
