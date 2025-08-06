@extends('index')

@push('style')
<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Custom Dashboard Styles -->
<style>
   body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', sans-serif;
    background-color: #f4f6f9;
}

/* ✅ Fixed Sidebar */
.sidebar {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    width: 200px;
    background-color: #2f4050;
    padding-top: 80px;
    z-index: 999;
}

.sidebar a {
    display: block;
    padding: 12px 20px;
    color: white;
    text-decoration: none;
}

.sidebar a:hover,
.sidebar a.active {
    background-color: #1ab394;
}

/* ✅ Fixed Topbar */
.topbar {
    position: fixed;
    top: 0;
    left: 200px; /* push right of sidebar */
    right: 0;
    height: 60px;
    background-color: #1ab394;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    z-index: 1000;
}

/* ✅ Main Content Area */
.main-content {
    margin-left: 200px; /* push right of sidebar */
    margin-top: 80px;   /* push below topbar */
    padding: 20px;
}

/* ✅ Header card */
.dashboard-header {
    background: linear-gradient(to right, #00c6ff, #0072ff);
    color: white;
    padding: 2rem;
    border-radius: 20px;
    margin-bottom: 40px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}
    .dashboard-header h2 {
        font-weight: bold;
        margin: 0;
    }

    .stat-card {
        border-radius: 16px;
        padding: 25px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        transition: 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .stat-card .icon {
        background: rgba(255, 255, 255, 0.2);
        padding: 16px;
        border-radius: 50%;
    }

    .card-users {
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .card-bookings {
        background: linear-gradient(135deg, #43e97b, #38f9d7);
    }

    .card-revenue {
        background: linear-gradient(135deg, #f7971e, #ffd200);
        color: #212529;
    }

    .recent-bookings {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.07);
        overflow: hidden;
    }

    .card-table thead {
        background-color: #f8f9fa;
    }

    .card-table tbody tr:hover {
        background-color: #f0f4f8;
    }

    /* Info Cards */
    .info-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        text-align: center;
        margin-bottom: 20px;
    }

    .info-card i {
        font-size: 30px;
        margin-bottom: 10px;
    }

</style>
@endpush

@section('content')

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
    <div><strong>User Dashboard</strong></div>
    <div><i class="fas fa-user-circle"></i> {{ auth()->user()->name ?? 'Guest' }}</div>
</div>

<div class="main-content">
    <!-- Header -->
    <div class="dashboard-header">
        <h2>  {{ auth()->user()->name ?? '' }}</h2>
        <p>Here’s a quick overview of your activity</p>
    </div>

    <!-- Stat Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card card-users">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Users</h6>
                        <h2>{{ $totalUsers }}</h2>
                    </div>
                    <div class="icon"><i class="fas fa-users fa-2x text-white"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card card-bookings">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Bookings</h6>
                        <h2>{{ $totalBookings }}</h2>
                    </div>
                    <div class="icon"><i class="fas fa-calendar-check fa-2x text-white"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card card-revenue">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Total Revenue</h6>
                        <h2>${{ number_format($totalRevenue) }}</h2>
                    </div>
                    <div class="icon"><i class="fas fa-dollar-sign fa-2x text-dark"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="info-card">
                <i class="fas fa-calendar-check text-success"></i>
                <h5>Your Bookings</h5>
                <p>You have <strong>3 upcoming bookings</strong>.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-card">
                <i class="fas fa-bullhorn text-primary"></i>
                <h5>My Ads</h5>
                <p>You have <strong>2 active ads</strong>.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-card">
                <i class="fas fa-envelope text-info"></i>
                <h5>Messages</h5>
                <p>No new messages.</p>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="recent-bookings">
        <div class="p-3 border-bottom">
            <h5 class="fw-bold mb-0">Recent Bookings</h5>
        </div>
        <div class="table-responsive">
            <table class="table card-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Booking Name</th>
                        <th>Email</th>
                        <th>Amount</th>
                        <th>Booked At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentBookings as $index => $booking)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->email }}</td>
                            <td>${{ number_format($booking->amount, 2) }}</td>
                            <td>{{ $booking->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No recent bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
