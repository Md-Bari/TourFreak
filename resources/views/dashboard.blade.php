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
        transition: all 0.3s ease;
    }

    .topbar {
        position: fixed;
        left: 200px;
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

    .sidebar {
        width: 200px;
        background-color: #2f4050;
        color: #fff;
        position: fixed;
        top: 60px;
        bottom: 0;
        z-index: 999;
        padding-top: 20px;
        transition: all 0.3s ease;
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

    .main-content {
        margin-left: 200px;
        margin-top: 60px;
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
</style>
@endpush

@section('content')
<div class="user-wrapper">

    <!-- Sidebar -->
   <div class="sidebar">
    <a href="{{ route('dashboard') }}"><i class="fas fa-home me-2"></i> Dashboard</a>
    <a href="{{ route('profile') }}"><i class="fas fa-user me-2"></i> Profile</a>
    <a href="{{ route('bookings') }}"><i class="fas fa-calendar-alt me-2"></i> Bookings</a>
    <a href="#"><i class="fas fa-ad me-2"></i> My Ads</a>
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt me-2"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>

    <!-- Topbar -->
    <div class="topbar">
        <div>User Dashboard</div>
        <div><i class="fas fa-user-circle"></i> {{ Auth::user()->name }}</div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Welcome, {{ Auth::user()->name }}!</h2>

        <div class="card">
            <h4><i class="fas fa-calendar-check text-success"></i></h4>
            <h5>Your Bookings</h5>
            <p>You have <strong>3 upcoming bookings</strong>.</p>
        </div>

        <div class="card">
            <h4><i class="fas fa-bullhorn text-primary"></i></h4>
            <h5>My Ads</h5>
            <p>You have <strong>2 active ads</strong>.</p>
        </div>

        <div class="card">
            <h4><i class="fas fa-envelope text-info"></i></h4>
            <h5>Messages</h5>
            <p>No new messages.</p>
        </div>
    </div>
</div>
@endsection
