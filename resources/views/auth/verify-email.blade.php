@extends('index')

@section('content')
<style>
.verify-container {
    max-width: 400px;
    margin: 5% auto;
    padding: 30px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}
</style>

<div class="verify-container">
    <h2>Email Verification</h2>
    <p>We have sent a 6-digit OTP to <strong>{{ $user->email }}</strong></p>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('otp.verify', $user->id) }}">
        @csrf
        <div class="mb-3">
            <input type="text" name="otp" class="form-control" placeholder="Enter OTP" required>
            @error('otp') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100">Verify</button>
    </form>
</div>
@endsection
