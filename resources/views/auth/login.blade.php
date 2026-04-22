@extends('index')

@section('title', 'Login')
@section('page_title', 'Sign In')

@push('style')
<style>
    .auth-shell {
        display: grid;
        grid-template-columns: minmax(0, 1.05fr) minmax(340px, 440px);
        gap: 22px;
        align-items: stretch;
    }

    .auth-visual-login {
        min-height: 640px;
        border-radius: 34px;
        padding: 38px;
        color: #fff;
        background:
            linear-gradient(135deg, rgba(15, 23, 42, 0.72), rgba(15, 118, 110, 0.55)),
            url("{{ asset('assets/images/bangladesh.jpeg') }}") center/cover no-repeat;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 28px 70px rgba(15, 23, 42, 0.16);
    }

    .auth-visual-login h2 {
        margin: 0 0 16px;
        font-size: clamp(2.4rem, 5vw, 4.5rem);
        line-height: 0.92;
        font-weight: 800;
        letter-spacing: -0.06em;
    }

    .auth-card-login {
        padding: 28px;
        border-radius: 30px;
        background: rgba(255,255,255,0.96);
        border: 1px solid rgba(15, 23, 42, 0.08);
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.09);
    }

    .auth-card-login .form-label {
        font-size: 0.88rem;
        font-weight: 800;
        color: #344054;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    .auth-card-login .form-control {
        padding: 14px 16px;
        border-radius: 18px;
        border: 1px solid rgba(15, 23, 42, 0.1);
        background: #f8fafc;
    }

    .auth-card-login .form-control:focus {
        box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.12);
        border-color: rgba(15, 118, 110, 0.55);
        background: #fff;
    }

    .auth-submit-login {
        width: 100%;
        padding: 14px 18px;
        border: 0;
        border-radius: 18px;
        background: linear-gradient(135deg, #0f172a, #0f766e);
        color: #fff;
        font-weight: 800;
        box-shadow: 0 18px 34px rgba(15, 23, 42, 0.16);
    }

    .password-toggle-wrap {
        position: relative;
    }

    .password-toggle-btn {
        position: absolute;
        top: 50%;
        right: 14px;
        transform: translateY(-50%);
        border: 0;
        background: transparent;
        color: #667085;
        margin: 0;
        padding: 0;
    }

    .auth-meta-note {
        color: rgba(255,255,255,0.84);
        line-height: 1.7;
        max-width: 520px;
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

        .auth-visual-login {
            min-height: 400px;
        }
    }
</style>
@endpush

@section('content')
<div class="page-shell">
    <div class="auth-shell">
        <section class="auth-visual-login">
            <div>
                <span class="eyebrow text-white">Welcome back</span>
                <h2>Plan your trip your way.</h2>
                <p class="auth-meta-note">Login to continue with bookings, saved tours, notifications, and your personal travel dashboard.</p>
            </div>

            <div class="auth-badges">
                <div class="auth-badge">
                    <strong>Fast access</strong>
                    <div>Trips, stays, and bookings</div>
                </div>
                <div class="auth-badge">
                    <strong>Support center</strong>
                    <div>Track tickets and updates</div>
                </div>
            </div>
        </section>

        <section class="auth-card-login">
            <div class="auth-card-top">
                <span class="eyebrow">Account access</span>
                <h3>Login</h3>
                <p class="text-muted mb-4">Use the same email you verified during registration.</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                </div>

                <div class="mb-4 password-toggle-wrap">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control pe-5" required id="password">
                    <button type="button" class="password-toggle-btn" onclick="togglePassword()" aria-label="Toggle password visibility">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                <button type="submit" class="auth-submit-login">Login</button>
            </form>

            <p class="auth-footer-note">Don't have an account? <a href="{{ route('register.create') }}">Register here</a></p>
        </section>
    </div>
</div>
@endsection

@push('script')
<script>
    function togglePassword() {
        const password = document.getElementById('password');
        password.type = password.type === 'password' ? 'text' : 'password';
    }
</script>
@endpush
