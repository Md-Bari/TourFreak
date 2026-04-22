@extends('index')

@section('title', 'Settings')
@section('page_title', 'Account Settings')

@section('content')
<div class="page-shell form-shell">
    <section class="hero-panel">
        <div>
            <span class="eyebrow">Preferences</span>
            <h2>Account settings</h2>
            <p>Update profile details, change your password, and control how you want to receive travel updates.</p>
        </div>
    </section>

    <div class="settings-grid">
        <aside class="content-card">
            <div class="settings-tabs">
                <a class="settings-tab active" id="profile-tab" data-bs-toggle="pill" href="#profile">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
                <a class="settings-tab" id="security-tab" data-bs-toggle="pill" href="#security">
                    <i class="fas fa-lock"></i>
                    <span>Security</span>
                </a>
                <a class="settings-tab" id="notifications-tab" data-bs-toggle="pill" href="#notifications">
                    <i class="fas fa-bell"></i>
                    <span>Notifications</span>
                </a>
            </div>
        </aside>

        <section class="form-card">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="tab-content">
                <div class="tab-pane fade show active" id="profile">
                    <div class="section-heading">
                        <div>
                            <span class="eyebrow">Profile settings</span>
                            <h3>Update Profile</h3>
                        </div>
                    </div>

                    <form action="{{ route('settings.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-dark">Update Profile</button>
                    </form>
                </div>

                <div class="tab-pane fade" id="security">
                    <div class="section-heading">
                        <div>
                            <span class="eyebrow">Security settings</span>
                            <h3>Change Password</h3>
                        </div>
                    </div>

                    <form action="{{ route('settings.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>

                        <button type="submit" class="btn btn-dark">Change Password</button>
                    </form>
                </div>

                <div class="tab-pane fade" id="notifications">
                    <div class="section-heading">
                        <div>
                            <span class="eyebrow">Notification settings</span>
                            <h3>Notification Preferences</h3>
                        </div>
                    </div>

                    <form action="{{ route('settings.notifications.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="preference-card mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="email_notifications" name="email_notifications" {{ $user->email_notifications ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="email_notifications">Email Notifications</label>
                            </div>
                            <small class="text-muted">Receive notifications via email</small>
                        </div>

                        <div class="preference-card mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="booking_notifications" name="booking_notifications" {{ $user->booking_notifications ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="booking_notifications">Booking Updates</label>
                            </div>
                            <small class="text-muted">Get notified about your booking status</small>
                        </div>

                        <div class="preference-card mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="promotional_notifications" name="promotional_notifications" {{ $user->promotional_notifications ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="promotional_notifications">Promotional Notifications</label>
                            </div>
                            <small class="text-muted">Receive updates about promotions and offers</small>
                        </div>

                        <button type="submit" class="btn btn-dark">Save Preferences</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const triggerTabList = [].slice.call(document.querySelectorAll('.settings-tab'));

        triggerTabList.forEach(function(triggerEl) {
            triggerEl.addEventListener('click', function(e) {
                e.preventDefault();
                triggerTabList.forEach(tab => tab.classList.remove('active'));
                this.classList.add('active');
                new bootstrap.Tab(triggerEl).show();
            });
        });
    });
</script>
@endpush
