@extends('admin.admin')

@section('title', 'Admin Dashboard - Tour Freak')

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    body {
        background-color: #f4f6f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Sidebar Improvements */
    .sidebar {
        background: linear-gradient(180deg, #1e3c72, #2a5298);
        min-height: 100vh;
        color: #fff;
    }
    .sidebar a {
        color: #d1d5db;
        font-weight: 500;
        padding: 12px 18px;
        display: block;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .sidebar a:hover, 
    .sidebar .active {
        background: rgba(255,255,255,0.15);
        color: #fff;
        transform: translateX(4px);
    }

    /* Colorful Dashboard Cards */
    .dashboard-card {
        border-radius: 16px;
        padding: 20px;
        color: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    }
    .dashboard-card i {
        font-size: 28px;
        opacity: 0.9;
    }
    .card-title {
        font-size: 14px;
        font-weight: 500;
        margin-top: 10px;
    }
    .card-value {
        font-size: 26px;
        font-weight: 700;
        margin-top: 5px;
    }

    /* Unique card colors */
    .card-blue { background: linear-gradient(135deg, #4e73df, #224abe); }
    .card-green { background: linear-gradient(135deg, #1cc88a, #13855c); }
    .card-yellow { background: linear-gradient(135deg, #f6c23e, #dda20a); }
    .card-red { background: linear-gradient(135deg, #e74a3b, #be2617); }

    /* Stylish Booking Table */
    .chart-container {
        background: #fff;
        padding: 20px;
        border-radius: 16px;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        height: 100%;
    }
    table.table-hover tbody tr {
        transition: all 0.2s ease;
    }
    table.table-hover tbody tr:hover {
        background: rgba(78, 115, 223, 0.08);
        transform: scale(1.01);
    }
    thead {
        background: #f8f9fc;
    }
    .badge {
        font-size: 0.75rem;
        padding: 5px 8px;
        border-radius: 12px;
    }
</style>
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
