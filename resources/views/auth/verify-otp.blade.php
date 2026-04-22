@extends('index')

@section('title', 'Verify Email')
@section('page_title', 'Verify Your Email')

@section('content')
<div class="page-shell form-shell">
    <section class="hero-panel">
        <div>
            <span class="eyebrow">Secure sign up</span>
            <h2>Email verification</h2>
            <p>We sent a 6-digit OTP to <strong>{{ $user->email }}</strong>. Enter it below to complete your registration.</p>
        </div>
    </section>

    <section class="form-card">
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if($errors->has('otp'))
            <div class="alert alert-danger">{{ $errors->first('otp') }}</div>
        @endif

        @if($errors->has('email'))
            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
        @endif

        <form method="POST" action="{{ route('otp.verify', $user->id) }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Verification Code</label>
                <input type="text" name="otp" class="form-control" placeholder="Enter 6-digit OTP" inputmode="numeric" maxlength="6" required>
            </div>
            <button type="submit" class="btn btn-dark w-100">Verify Email</button>
        </form>

        <form method="POST" action="{{ route('otp.resend', $user->id) }}" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-outline-dark w-100">Resend OTP</button>
        </form>
    </section>
</div>
@endsection
