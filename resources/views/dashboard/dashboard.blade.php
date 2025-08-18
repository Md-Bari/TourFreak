@extends('index')

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body {
        background-color: #f4f6f9;
        font-family: 'Segoe UI', sans-serif;
        margin: 0;
        padding: 0;
    }

    .user-wrapper {
        display: flex;
    }

    /* Sidebar */
    .sidebar {
        width: 220px;
        background-color: #2f4050;
        color: #fff;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        padding-top: 60px; /* Topbar height fix */
    }

    .sidebar a {
        color: #fff;
        display: block;
        padding: 12px 20px;
        text-decoration: none;
    }

    .sidebar a:hover,
    .sidebar a.active {
        background-color: #1ab394;
    }

    /* Topbar */
    .topbar {
        position: fixed;
        left: 220px;
        right: 0;
        top: 0;
        height: 60px;
        background-color: #1ab394;
        display: flex;
        align-items: center;
        padding: 0 20px;
        color: #fff;
        justify-content: space-between;
        z-index: 1000;
    }

    /* Main content */
    .main-content {
        margin-left: 220px;
        margin-top: 70px;
        padding: 20px;
        flex-grow: 1;
    }

    .card {
        background: #fff;
        border-radius: 6px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .badge {
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 50rem;
    }

    .bg-danger {
        background-color: #dc3545 !important;
    }
</style>
@endpush

@section('content')
<div class="user-wrapper">

    <div class="sidebar">
        <a href="{{ route('dashboard') }}"><i class="fas fa-home me-2"></i> Dashboard</a>
        <a href="{{ route('profile') }}"><i class="fas fa-user me-2"></i> Profile</a>
        <a href="{{ route('my.bookings') }}"><i class="fas fa-calendar-alt me-2"></i> Bookings</a>
        <a href="{{ route('my-ads') }}"><i class="fas fa-ad me-2"></i> My Ads</a>
       
    
        
        {{-- Wishlist link এখানে যুক্ত করা হয়েছে --}}

        <a href="{{ route('my-wishlist') }}"><i class="fas fa-heart me-2"></i> Wishlist</a>

        <a href="{{ route('notifications.index') }}">
            <i class="fas fa-bell me-2"></i> Notifications
            @php
                $unreadCount = auth()->user()->unreadNotifications()->count();
            @endphp
            @if($unreadCount > 0)
                <span class="badge bg-danger rounded-pill ms-2">{{ $unreadCount }}</span>
            @endif
        </a>
        <a href="#"><i class="fas fa-envelope me-2"></i> Messages</a>
        <a href="#"><i class="fas fa-cog me-2"></i> Settings</a>
         <a href="{{ route('support.index') }}" class="active">
            <i class="fas fa-headset me-2"></i> Support</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <div class="topbar">
        <div>User Dashboard</div>
        <div><i class="fas fa-user-circle"></i> {{ Auth::user()->name }}</div>
    </div>

    <div class="main-content">
        <h2>Welcome, {{ Auth::user()->name }}!</h2>

        <div class="card">
            <h4><i class="fas fa-calendar-check text-success"></i></h4>
            <h5>Your Bookings</h5>
            <p>You have <strong>3 upcoming bookings</strong>.</p>
        </div>

        <div class="card">
            <h4><i class="fas fa-heart text-danger"></i></h4>
            <h5>Wishlist</h5>
            <p>You saved <strong>5 tours</strong> in wishlist.</p>
        </div>

        <div class="card">
            <h4><i class="fas fa-bell text-warning"></i></h4>
            <h5>Notifications</h5>
            @php
                $unreadCount = auth()->user()->unreadNotifications()->count();
            @endphp
            <p>You have <strong>{{ $unreadCount }} new {{ Str::plural('notification', $unreadCount) }}</strong>.</p>
            @if($unreadCount > 0)
                <a href="{{ route('notifications.index') }}" class="btn btn-sm btn-primary mt-2">View Notifications</a>
            @endif
        </div>
    </div>
</div>
@endsection
