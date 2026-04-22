@extends('index')

@section('title', 'Profile')
@section('page_title', 'Your Profile')

@section('content')
<div class="page-shell">
    <section class="hero-panel">
        <div>
            <span class="eyebrow">Profile center</span>
            <h2>{{ Auth::user()->name }}</h2>
            <p>Review your account information, contact details, and membership timeline in one polished view.</p>
            <div class="hero-actions mt-4">
                <a href="{{ route('profile.edit') }}" class="btn btn-dark">Edit Profile</a>
                <a href="{{ route('settings.index') }}" class="btn btn-outline-dark">Open Settings</a>
            </div>
        </div>
        <div class="hero-orb">
            <span class="eyebrow text-white">Member since</span>
            <strong>{{ Auth::user()->created_at->format('M Y') }}</strong>
            <p class="mb-0 text-white-50">Your account is ready for bookings, saved trips, and support requests.</p>
        </div>
    </section>

    <section class="split-grid">
        <article class="content-card">
            <div class="section-heading">
                <div>
                    <span class="eyebrow">Basic details</span>
                    <h3>Account Information</h3>
                </div>
            </div>

            <div class="info-list">
                <div class="info-row-card">
                    <span class="meta-label">Full Name</span>
                    <span class="meta-value">{{ Auth::user()->name }}</span>
                </div>
                <div class="info-row-card">
                    <span class="meta-label">Email Address</span>
                    <span class="meta-value">{{ Auth::user()->email }}</span>
                </div>
                <div class="info-row-card">
                    <span class="meta-label">Phone Number</span>
                    <span class="meta-value">{{ Auth::user()->phone ?: 'Not provided yet' }}</span>
                </div>
                <div class="info-row-card">
                    <span class="meta-label">Joined Date</span>
                    <span class="meta-value">{{ Auth::user()->created_at->format('d M, Y') }}</span>
                </div>
            </div>
        </article>

        <article class="content-card">
            <div class="section-heading">
                <div>
                    <span class="eyebrow">Quick actions</span>
                    <h3>Manage Account</h3>
                </div>
            </div>

            <div class="info-list">
                <div class="info-row-card">
                    <span class="meta-label">Profile Update</span>
                    <p class="muted-text mb-3">Keep your name and phone number current.</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-dark btn-sm">Edit Information</a>
                </div>
                <div class="info-row-card">
                    <span class="meta-label">Security and Preferences</span>
                    <p class="muted-text mb-3">Manage password, email alerts, and booking notifications.</p>
                    <a href="{{ route('settings.index') }}" class="btn btn-outline-dark btn-sm">Go to Settings</a>
                </div>
            </div>
        </article>
    </section>
</div>
@endsection
