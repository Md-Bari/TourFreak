@extends('index')

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body {
        background-color: #f4f6f9;
        font-family: 'Segoe UI', sans-serif;
    }

    .admin-wrapper {
        display: flex;
        transition: all 0.3s ease;
    }

    .sidebar {
        width: 220px;
        background-color: #2f4050;
        color: #fff;
        position: fixed;
        top: 0;
        bottom: 0;
        padding-top: 60px;
        transition: all 0.3s ease;
    }

    .sidebar-collapsed .sidebar {
        margin-left: -220px; /* hide sidebar */
    }

    .sidebar a {
        color: #fff;
        display: block;
        padding: 12px 20px;
        text-decoration: none;
    }

    .sidebar a:hover, .sidebar a.active {
        background-color: #1ab394;
    }

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
        transition: all 0.3s ease;
    }

    .sidebar-collapsed .topbar {
        left: 0;
    }

    .sidebar-toggle-btn {
        font-size: 24px;
        cursor: pointer;
        background: none;
        border: none;
        color: #fff;
        margin-right: 15px;
    }

    .main-content {
        margin-left: 220px;
        margin-top: 60px;
        padding: 20px;
        flex-grow: 1;
        transition: all 0.3s ease;
    }

    .sidebar-collapsed .main-content {
        margin-left: 0;
    }

    .card {
        background: #fff;
        border-radius: 6px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        text-align: center;
    }

    .card h4 {
        margin-bottom: 10px;
    }

    .chart-container {
        position: relative;
        height: 250px;
    }

    .hidden {
        display: none;
    }
</style>
@endpush

@section('content')
<div id="adminWrapper" class="admin-wrapper">

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="active" onclick="showSection('dashboard')"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
        <a href="#" onclick="showSection('packages')"><i class="fas fa-box me-2"></i> Packages</a>
        <a href="#" onclick="showSection('photos')"><i class="fas fa-image me-2"></i> Photos</a>
        <a href="#" onclick="showSection('pricing')"><i class="fas fa-dollar-sign me-2"></i> Pricing</a>
        <a href="#" onclick="showSection('bookings')"><i class="fas fa-book me-2"></i> Bookings</a>
        <a href="#" onclick="showSection('reports')"><i class="fas fa-chart-line me-2"></i> Reports</a>
    </div>

    <!-- Topbar -->
    <div class="topbar">
        <button class="sidebar-toggle-btn" onclick="toggleSidebar()">☰</button>
        <div>Dashboard</div>
        <div>
            <i class="fas fa-search me-3"></i>
            <i class="fas fa-bell me-3"></i>
            <i class="fas fa-user-circle"></i>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <!-- Dashboard Section -->
        <section id="dashboard" class="content-section">
            <div class="row" style="display:flex; gap:20px; flex-wrap: wrap;">
                <div style="flex:1; min-width:200px;">
                    <div class="card">
                        <h4><i class="fas fa-image text-primary"></i></h4>
                        <h5>Activated Ads</h5>
                        <p class="fs-4">4105</p>
                    </div>
                </div>
                <div style="flex:1; min-width:200px;">
                    <div class="card">
                        <h4><i class="fas fa-ban text-danger"></i></h4>
                        <h5>Unactivated Ads</h5>
                        <p class="fs-4">553</p>
                    </div>
                </div>
                <div style="flex:1; min-width:200px;">
                    <div class="card">
                        <h4><i class="fas fa-user-plus text-success"></i></h4>
                        <h5>User Registration</h5>
                        <p class="fs-4">1250</p>
                    </div>
                </div>
                <div style="flex:1; min-width:200px;">
                    <div class="card">
                        <h4><i class="fas fa-building text-info"></i></h4>
                        <h5>Listed Companies</h5>
                        <p class="fs-4">2150</p>
                    </div>
                </div>
            </div>

            <div class="row" style="display:flex; gap:20px; flex-wrap: wrap;">
                <div style="flex:1; min-width:300px;">
                    <div class="card">
                        <h4>Job Statistics</h4>
                        <div class="chart-container">
                            <canvas id="jobStatsChart"></canvas>
                        </div>
                    </div>
                </div>
                <div style="flex:1; min-width:300px;">
                    <div class="card">
                        <h4>Ads Stats</h4>
                        <div class="chart-container">
                            <canvas id="adsStatsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Packages Section -->
        <section id="packages" class="content-section hidden">
            <h2>Packages</h2>
            <p>Manage packages here.</p>
        </section>

        <!-- Photos Section -->
        <section id="photos" class="content-section hidden">
            <h2>Photos</h2>
            <p>Manage photos here.</p>
        </section>

        <!-- Pricing Section -->
        <section id="pricing" class="content-section hidden">
            <h2>Pricing</h2>
            <p>Manage pricing here.</p>
        </section>

        <!-- Bookings Section -->
        <section id="bookings" class="content-section hidden">
            <h2>Bookings</h2>
            <p>View bookings here.</p>
        </section>

        <!-- Reports Section -->
        <section id="reports" class="content-section hidden">
            <h2>Reports</h2>
            <p>View reports here.</p>
        </section>

    </div>

</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function toggleSidebar() {
        document.getElementById('adminWrapper').classList.toggle('sidebar-collapsed');
    }

    function showSection(sectionId) {
        document.querySelectorAll('.content-section').forEach(section => {
            section.classList.add('hidden');
        });
        document.getElementById(sectionId).classList.remove('hidden');

        // Update active link in sidebar
        document.querySelectorAll('.sidebar a').forEach(link => {
            link.classList.remove('active');
            if(link.getAttribute('onclick')?.includes(sectionId)) {
                link.classList.add('active');
            }
        });
    }

    // Chart.js initialization
    const ctxJob = document.getElementById('jobStatsChart').getContext('2d');
    new Chart(ctxJob, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Jobs',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: '#1ab394'
            }]
        },
        options: { responsive: true }
    });

    const ctxAds = document.getElementById('adsStatsChart').getContext('2d');
    new Chart(ctxAds, {
        type: 'line',
        data: {
            labels: ['Apr 02', 'Apr 06', 'Apr 10', 'Apr 14', 'Apr 18', 'Apr 22', 'Apr 26'],
            datasets: [{
                label: 'Ads Views',
                data: [5000, 10000, 7500, 15000, 12000, 17000, 14000],
                borderColor: '#f8ac59',
                fill: false,
                tension: 0.4
            },
            {
                label: 'Clicks',
                data: [3000, 6000, 5000, 9000, 7000, 11000, 9000],
                borderColor: '#23c6c8',
                fill: false,
                tension: 0.4
            }]
        },
        options: { responsive: true }
    });
</script>
@endpush
@endsection
