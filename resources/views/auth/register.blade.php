@extends('index')

@section('title', 'Create Account')
@section('page_title', 'Create Your Account')

@push('style')
<style>
    .auth-shell {
        display: grid;
        grid-template-columns: minmax(0, 1.05fr) minmax(360px, 460px);
        gap: 22px;
        align-items: stretch;
    }

    .auth-visual {
        position: relative;
        min-height: 680px;
        border-radius: 34px;
        overflow: hidden;
        padding: 38px;
        color: #fff;
        background:
            linear-gradient(135deg, rgba(15, 23, 42, 0.76), rgba(29, 78, 216, 0.58)),
            url("{{ asset('assets/images/beach.jpg') }}") center/cover no-repeat;
        box-shadow: 0 28px 70px rgba(15, 23, 42, 0.16);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .auth-visual h2 {
        margin: 0 0 16px;
        font-size: clamp(2.5rem, 5vw, 4.6rem);
        line-height: 0.92;
        font-weight: 800;
        letter-spacing: -0.06em;
    }

    .auth-visual p {
        max-width: 520px;
        color: rgba(255,255,255,0.84);
        line-height: 1.8;
    }

    .auth-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .auth-badge {
        padding: 12px 14px;
        border-radius: 18px;
        background: rgba(255,255,255,0.13);
        border: 1px solid rgba(255,255,255,0.16);
        backdrop-filter: blur(10px);
    }

    .auth-card {
        padding: 26px;
        border-radius: 30px;
        background: rgba(255,255,255,0.96);
        border: 1px solid rgba(15, 23, 42, 0.08);
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.09);
    }

    .auth-card-top {
        margin-bottom: 20px;
    }

    .auth-card-top h3 {
        margin: 0 0 6px;
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: -0.04em;
    }

    .auth-card-top p {
        margin: 0;
        color: var(--text-soft);
    }

    .auth-card .form-label {
        font-size: 0.88rem;
        font-weight: 800;
        color: #344054;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    .auth-card .form-control {
        padding: 14px 16px;
        border-radius: 18px;
        border: 1px solid rgba(15, 23, 42, 0.1);
        background: #f8fafc;
    }

    .auth-card .form-control:focus {
        box-shadow: 0 0 0 4px rgba(29, 78, 216, 0.12);
        border-color: rgba(29, 78, 216, 0.55);
        background: #fff;
    }

    .auth-submit {
        width: 100%;
        padding: 14px 18px;
        border: 0;
        border-radius: 18px;
        background: linear-gradient(135deg, #1d4ed8, #0ea5e9);
        color: #fff;
        font-weight: 800;
        box-shadow: 0 18px 34px rgba(29, 78, 216, 0.18);
    }

    .auth-footer-note {
        margin-top: 16px;
        color: var(--text-soft);
        text-align: center;
    }

    @media (max-width: 991.98px) {
        .auth-shell {
            grid-template-columns: 1fr;
        }

        .auth-visual {
            min-height: 420px;
        }
    }
</style>
@endpush

@section('content')
<div class="page-shell">
    <div class="auth-shell">
        <section class="auth-visual">
            <div>
                <span class="eyebrow text-white">Join TourFreak</span>
                <h2>Start your next journey with a smarter account.</h2>
                <p>Create your profile to manage bookings, wishlist items, support requests, and email verification from one elegant dashboard.</p>
            </div>

            <div class="auth-badges">
                <div class="auth-badge">
                    <strong>Travel booking</strong>
                    <div>Packages, hotels, and transport</div>
                </div>
                <div class="auth-badge">
                    <strong>Email OTP</strong>
                    <div>Secure sign up with Gmail verification</div>
                </div>
                <div class="auth-badge">
                    <strong>Clean dashboard</strong>
                    <div>Modern account experience</div>
                </div>
            </div>
        </section>

        <section class="auth-card">
            <div class="auth-card-top">
                <span class="eyebrow">Create profile</span>
                <h3>Register</h3>
                <p>Use your real Gmail address so OTP verification reaches you correctly.</p>
            </div>

            <form method="POST" action="{{ route('register.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" required>
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="auth-submit">Create Account</button>
            </form>

            <p class="auth-footer-note">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </section>
    </div>
</div>
@endsection
