@extends('index')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .settings-nav .nav-link {
            color: #495057;
            border-radius: 0;
            padding: 1rem;
        }
        .settings-nav .nav-link.active {
            color: #1ab394;
            background-color: #f8f9fa;
            border-left: 3px solid #1ab394;
        }
        .settings-content {
            background: #fff;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
    </style>
@endpush

@section('content')
<div class="main-content" style="margin-left:220px; margin-top:70px; padding:20px;">
    <div class="container">
        <div class="row">
            <!-- Settings Navigation -->
            <div class="col-md-3">
                <div class="list-group settings-nav">
                    <a class="list-group-item list-group-item-action active" id="profile-tab" data-bs-toggle="pill" href="#profile">
                        <i class="fas fa-user me-2"></i> Profile Settings
                    </a>
                    <a class="list-group-item list-group-item-action" id="security-tab" data-bs-toggle="pill" href="#security">
                        <i class="fas fa-lock me-2"></i> Security
                    </a>
                    <a class="list-group-item list-group-item-action" id="notifications-tab" data-bs-toggle="pill" href="#notifications">
                        <i class="fas fa-bell me-2"></i> Notifications
                    </a>
                </div>
            </div>

            <!-- Settings Content -->
            <div class="col-md-9">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="tab-content settings-content">
                    <!-- Profile Settings -->
                    <div class="tab-pane fade show active" id="profile">
                        <h4 class="mb-4">Profile Settings</h4>
                        <form action="{{ route('settings.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    id="name" name="name" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                    id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>

                    <!-- Security Settings -->
                    <div class="tab-pane fade" id="security">
                        <h4 class="mb-4">Change Password</h4>
                        <form action="{{ route('settings.password.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                    id="current_password" name="current_password">
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                    id="password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" 
                                    id="password_confirmation" name="password_confirmation">
                            </div>

                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </form>
                    </div>

                    <!-- Notification Settings -->
                    <div class="tab-pane fade" id="notifications">
                        <h4 class="mb-4">Notification Preferences</h4>
                        <form action="{{ route('settings.notifications.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="email_notifications" 
                                        name="email_notifications" {{ $user->email_notifications ? 'checked' : '' }}>
                                    <label class="form-check-label" for="email_notifications">
                                        Email Notifications
                                    </label>
                                </div>
                                <small class="text-muted">Receive notifications via email</small>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="booking_notifications" 
                                        name="booking_notifications" {{ $user->booking_notifications ? 'checked' : '' }}>
                                    <label class="form-check-label" for="booking_notifications">
                                        Booking Updates
                                    </label>
                                </div>
                                <small class="text-muted">Get notified about your booking status</small>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="promotional_notifications" 
                                        name="promotional_notifications" {{ $user->promotional_notifications ? 'checked' : '' }}>
                                    <label class="form-check-label" for="promotional_notifications">
                                        Promotional Notifications
                                    </label>
                                </div>
                                <small class="text-muted">Receive updates about promotions and offers</small>
                            </div>

                            <button type="submit" class="btn btn-primary">Save Preferences</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    // Activate Bootstrap tabs
    document.addEventListener('DOMContentLoaded', function() {
        var triggerTabList = [].slice.call(document.querySelectorAll('.settings-nav a'))
        triggerTabList.forEach(function(triggerEl) {
            triggerEl.addEventListener('click', function(e) {
                e.preventDefault()
                triggerTabList.forEach(tab => tab.classList.remove('active'));
                this.classList.add('active');
                var tabTrigger = new bootstrap.Tab(triggerEl)
                tabTrigger.show()
            })
        })
    });
</script>
@endpush
