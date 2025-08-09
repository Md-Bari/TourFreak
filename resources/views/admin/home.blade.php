@extends('admin.admin')

@section('title', 'Admin Dashboard - Tour Freak')

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    body {
        background-color: #f4f6f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .dashboard-card {
        border-radius: 12px;
        background: #fff;
        padding: 20px;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        height: 100%;
    }
    .card-title {
        font-size: 14px;
        font-weight: 600;
        color: #777;
    }
    .card-value {
        font-size: 24px;
        font-weight: 700;
        margin-top: 8px;
    }
    .card-change {
        font-size: 12px;
        color: #28a745;
    }
    .chart-container {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        height: 100%;
    }
</style>
@endpush

@section('content')
<div class="container-fluid mt-4">
    <h4 class="mb-4 fw-bold">Admin Dashboard</h4>

    <!-- Top Stat Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="dashboard-card">
                <i class="fas fa-boxes fa-2x text-primary"></i>
                <div class="card-title mt-2">Total Packages</div>
                <div class="card-value text-primary">{{ $totalPackages }}</div>
                <canvas id="packageChart" height="60"></canvas>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <i class="fas fa-bed fa-2x text-success"></i>
                <div class="card-title mt-2">Total Rooms</div>
                <div class="card-value text-success">{{ $totalRooms }}</div>
                <canvas id="roomChart" height="60"></canvas>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <i class="fas fa-calendar-check fa-2x text-warning"></i>
                <div class="card-title mt-2">Total Bookings</div>
                <div class="card-value text-warning">{{ $totalBookings }}</div>
                <canvas id="bookingChart" height="60"></canvas>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <i class="fas fa-users fa-2x text-danger"></i>
                <div class="card-title mt-2">User Accounts</div>
                <div class="card-value text-danger">{{ $totalUsers }}</div>
                <canvas id="userChart" height="60"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Orders & Charts -->
    <div class="row g-3">
        <div class="col-md-8">
            <div class="chart-container">
                <h6>Recent Bookings</h6>
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Booking ID</th>
                            <th>Package</th>
                            <th>User</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBookings as $index => $booking)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->package->name ?? 'N/A' }}</td>
                                <td>{{ $booking->user->name ?? 'N/A' }}</td>
                                <td>{{ $booking->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : 'warning' }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No recent bookings</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            <div class="chart-container">
                <h6>Customer Acquisition</h6>
                <canvas id="customerChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Small stat charts
    const smallChart = (id, color) => {
        new Chart(document.getElementById(id), {
            type: 'line',
            data: {
                labels: ["Mon","Tue","Wed","Thu","Fri"],
                datasets: [{
                    data: [12, 19, 3, 5, 2],
                    borderColor: color,
                    backgroundColor: 'transparent',
                    tension: 0.4
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { x: { display: false }, y: { display: false } }
            }
        });
    };
    smallChart('packageChart', '#0d6efd');
    smallChart('roomChart', '#198754');
    smallChart('bookingChart', '#ffc107');
    smallChart('userChart', '#dc3545');

    // Customer acquisition chart
    new Chart(document.getElementById('customerChart'), {
        type: 'line',
        data: {
            labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
            datasets: [
                {
                    label: 'Returning',
                    data: [2, 4, 5, 3, 6, 8, 7],
                    borderColor: '#0d6efd',
                    fill: false,
                    tension: 0.4
                },
                {
                    label: 'First Time',
                    data: [1, 3, 4, 6, 5, 7, 9],
                    borderColor: '#dc3545',
                    fill: false,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
@endpush
@endsection
