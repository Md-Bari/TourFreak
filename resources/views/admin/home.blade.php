@extends('admin.admin')

@section('title', 'Admin Dashboard - Tour Freak')

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin_home.css') }}">
@endpush

@section('content')
<div class="container-fluid mt-4">
    <h4 class="mb-4 fw-bold text-primary">Admin Dashboard</h4>

    <!-- Top Stat Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="dashboard-card card-blue">
                <i class="fas fa-boxes"></i>
                <div class="card-title">Total Packages</div>
                <div class="card-value">{{ $totalPackages }}</div>
                <canvas id="packageChart" height="60"></canvas>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card card-green">
                <i class="fas fa-bed"></i>
                <div class="card-title">Total Rooms</div>
                <div class="card-value">{{ $totalRooms }}</div>
                <canvas id="roomChart" height="60"></canvas>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card card-purple">
                <i class="fas fa-bus"></i>
                <div class="card-title">Total Buses</div>
                <div class="card-value">{{ $totalBuses }}</div>
                <canvas id="busChart" height="60"></canvas>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card card-yellow">
                <i class="fas fa-calendar-check"></i>
                <div class="card-title">Total Bookings</div>
                <div class="card-value">{{ $totalBookings }}</div>
                <canvas id="bookingChart" height="60"></canvas>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card card-red">
                <i class="fas fa-users"></i>
                <div class="card-title">User Accounts</div>
                <div class="card-value">{{ $totalUsers }}</div>
                <canvas id="userChart" height="60"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Orders & Charts -->
    <div class="row g-3">
        <div class="col-md-8">
            <div class="chart-container">
                <h6 class="fw-bold mb-3">Recent Bookings</h6>
                <table class="table table-sm table-hover align-middle">
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
                                <td colspan="6" class="text-center text-muted">No recent bookings</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            <div class="chart-container">
                <h6 class="fw-bold">Customer Acquisition</h6>
                <canvas id="customerChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
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
    smallChart('packageChart', '#fff');
    smallChart('roomChart', '#fff');
    smallChart('busChart', '#fff');
    smallChart('bookingChart', '#fff');
    smallChart('userChart', '#fff');

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