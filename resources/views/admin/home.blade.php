@extends('admin.admin')

@section('title', 'Admin Dashboard - Tour Freak')

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/admin_home.css') }}">
@endpush

@section('content')
<div class="dashboard-page">
    <div class="dashboard-hero">
        <div>
            <span class="eyebrow">Admin overview</span>
            <h1>Dashboard</h1>
            <p>Track packages, rooms, buses, bookings, and customer activity from one clean workspace.</p>
        </div>
        <div class="hero-badge">
            <i class="fas fa-chart-line"></i>
            <span>Live summary</span>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="dashboard-card card-blue">
                <div class="card-icon"><i class="fas fa-boxes"></i></div>
                <div class="card-title">Total Packages</div>
                <div class="card-value">{{ $totalPackages }}</div>
                <canvas id="packageChart" height="60"></canvas>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card card-green">
                <div class="card-icon"><i class="fas fa-bed"></i></div>
                <div class="card-title">Total Rooms</div>
                <div class="card-value">{{ $totalRooms }}</div>
                <canvas id="roomChart" height="60"></canvas>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card card-purple">
                <div class="card-icon"><i class="fas fa-bus"></i></div>
                <div class="card-title">Total Buses</div>
                <div class="card-value">{{ $totalBuses }}</div>
                <canvas id="busChart" height="60"></canvas>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card card-yellow">
                <div class="card-icon"><i class="fas fa-calendar-check"></i></div>
                <div class="card-title">Total Bookings</div>
                <div class="card-value">{{ $totalBookings }}</div>
                <canvas id="bookingChart" height="60"></canvas>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card card-red">
                <div class="card-icon"><i class="fas fa-users"></i></div>
                <div class="card-title">User Accounts</div>
                <div class="card-value">{{ $totalUsers }}</div>
                <canvas id="userChart" height="60"></canvas>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-8">
            <div class="chart-container">
                <div class="section-heading">
                    <div>
                        <span class="section-kicker">Recent activity</span>
                        <h6 class="fw-bold mb-0">Recent Bookings</h6>
                    </div>
                </div>
                <table class="table table-sm table-hover align-middle" id="bookingTable">
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
                        @foreach($recentBookings as $index => $booking)
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
                        @endforeach

                        @foreach($allBookings->skip(10) as $index => $booking)
                            <tr class="extra-bookings d-none">
                                <td>{{ $index + 11 }}</td>
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
                        @endforeach
                    </tbody>
                </table>
                <button id="toggleBookings" class="btn btn-soft-primary btn-sm">Show All</button>
            </div>
        </div>

        <div class="col-md-4">
            <div class="chart-container">
                <div class="section-heading">
                    <div>
                        <span class="section-kicker">Inbox</span>
                        <h6 class="fw-bold mb-0">Customer Messages</h6>
                    </div>
                </div>
                <ul class="list-group message-list">
                    @forelse($messages as $msg)
                        <li class="list-group-item">
                            <strong>{{ $msg->name }}</strong> <br>
                            <small class="text-muted">{{ $msg->email }}</small> <br>
                            <p class="mb-0">{{ Str::limit($msg->message, 100) }}</p>
                        </li>
                    @empty
                        <li class="list-group-item text-muted text-center">No messages yet</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Mini stat cards sparkline charts
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

    document.getElementById('toggleBookings').addEventListener('click', function () {
        const extraRows = document.querySelectorAll('.extra-bookings');
        const isHidden = extraRows[0]?.classList.contains('d-none');
        extraRows.forEach(row => row.classList.toggle('d-none'));
        this.textContent = isHidden ? 'Show Less' : 'Show All';
    });
</script>
@endpush
@endsection
