@extends('index')

@section('content')
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f4f7fa;
    }

    .stat-card {
        border-radius: 20px;
        padding: 2rem;
        color: white;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
    }

    .stat-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 20px 35px rgba(0, 0, 0, 0.2);
    }

    .stat-card .icon {
        background: rgba(255, 255, 255, 0.2);
        padding: 18px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
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

    .card-revenue .icon {
        background: rgba(0, 0, 0, 0.1);
    }

    .dashboard-header {
        background: linear-gradient(to right, #00c6ff, #0072ff);
        color: white;
        padding: 2.5rem 2rem;
        border-radius: 20px;
        margin-bottom: 40px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .dashboard-header h2 {
        font-weight: bold;
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .dashboard-header p {
        opacity: 0.85;
        font-size: 1.1rem;
    }

    .table th {
        background-color: #f8f9fa;
    }

    .table-hover tbody tr:hover {
        background-color: #f0f4f8;
        transition: 0.2s;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .table-rounded {
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        background-color: #fff;
        border-bottom: 2px solid #eaeaea;
    }
</style>

<div class="container mt-5">

    {{-- HEADER --}}
    <div class="dashboard-header text-white">
        <h2> Welcome, {{ auth()->user()->name ?? 'Guest' }}</h2>
        <p></p>
    </div>

    {{-- STAT CARDS --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="stat-card card-users">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Users</h6>
                        <h2 class="fw-bold">{{ $totalUsers }}</h2>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card card-bookings">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50">Total Bookings</h6>
                        <h2 class="fw-bold">{{ $totalBookings }}</h2>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-check fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card card-revenue">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-dark-50">Total Revenue</h6>
                        <h2 class="fw-bold">${{ number_format($totalRevenue) }}</h2>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign fa-2x text-dark"></i>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    {{-- RECENT BOOKINGS --}}
    <div class="card shadow-sm border-0 table-rounded">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold"> Recent Bookings</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
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

