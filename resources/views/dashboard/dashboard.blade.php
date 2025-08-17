@extends('index')

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
/* Reset basic styles */
body {
    background-color: #f4f6f9;
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
    padding: 0;
}

.user-wrapper {
    display: flex;
    min-height: 100vh; /* Ensures the wrapper takes full height */
}

/* Sidebar Styling */
.sidebar {
    width: 250px; /* Increased width for better spacing */
    background-color: #2f4050; /* Dark gray-blue color */
    color: #ecf0f1; /* Light gray text color */
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    padding-top: 60px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    transition: width 0.3s ease;
}

.sidebar a {
    color: #fff;
    display: flex; /* Use flexbox for icon and text alignment */
    align-items: center; /* Vertically center icon and text */
    padding: 15px 25px; /* Increased padding for more space */
    text-decoration: none;
    font-weight: 500;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.sidebar a:hover,
.sidebar a.active {
    background-color: #1ab394; /* Green color for hover/active state */
    color: #ffffff;
}

.sidebar a i {
    font-size: 18px;
    margin-right: 15px; /* Space between icon and text */
    width: 25px; /* Fixed width for icons to keep alignment */
    text-align: center;
}

/* Topbar Styling */
.topbar {
    position: fixed;
    left: 250px;
    right: 0;
    top: 0;
    height: 60px;
    background-color: #ffffff;
    border-bottom: 1px solid #e0e0e0;
    display: flex;
    align-items: center;
    padding: 0 20px;
    color: #333;
    justify-content: space-between;
    z-index: 1000;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: left 0.3s ease;
}

/* Main Content Styling */
.main-content {
    margin-left: 250px; /* Matches sidebar width */
    margin-top: 70px;
    padding: 25px; /* Increased padding */
    flex-grow: 1;
}

.card {
    background: #fff;
    border-radius: 8px; /* Slightly more rounded corners */
    padding: 25px; /* Increased padding */
    margin-bottom: 25px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Slightly more prominent shadow */
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px); /* Lift card on hover */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}

.card h4 {
    color: #1ab394;
    font-size: 2.5rem; /* Larger icon size */
    margin-bottom: 10px;
}

.card h5 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #333;
}

.card p {
    color: #666;
}

/* Specific colors for icons */
.text-success { color: #2ecc71; }
.text-primary { color: #3498db; }
.text-danger { color: #e74c3c; }
.text-warning { color: #f1c40f; }
.text-info { color: #3498db; }
.text-secondary { color: #95a5a6; }

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
            <h4><i class="fas fa-bullhorn text-primary"></i></h4>
            <h5>My Ads</h5>
            <p>You have <strong>2 active ads</strong>.</p>
        </div>

        <div class="card">
            <h4><i class="fas fa-heart text-danger"></i></h4>
            <h5>Wishlist</h5>
            <p>You saved <strong>5 tours</strong> in wishlist.</p>
        </div>

        <div class="card">
            <h4><i class="fas fa-bell text-warning"></i></h4>
            <h5>Notifications</h5>
            <p>You have <strong>4 new notifications</strong>.</p>
        </div>
    </div>
</div>
@endsection
