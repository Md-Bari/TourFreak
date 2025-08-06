@extends('admin.admin')

@section('title', 'Admin Dashboard - Tour Freak')

@push('style')
<style>
    body {
        background-color: #f4f6f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .admin-card {
        border: none;
        border-radius: 15px;
        background: linear-gradient(135deg, #ffffff, #f9f9f9);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease-in-out;
    }

    .admin-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
    }

    .admin-icon {
        font-size: 2rem;
        margin-bottom: 10px;
        color: #0d6efd;
    }

    .admin-card-title {
        font-size: 1rem;
        color: #555;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .admin-card-value {
        font-size: 2rem;
        font-weight: 700;
    }

    .btn-sm {
        margin-top: 10px;
        border-radius: 50px;
        font-size: 0.8rem;
        padding: 5px 15px;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@section('content')
<div class="container mt-5 pt-5">
    <h2 class="mb-4 fw-bold text-dark">Welcome, Admin</h2>

    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="card admin-card text-center p-3">
                <div class="card-body">
                    <div class="admin-icon"><i class="fas fa-boxes"></i></div>
                    <div class="admin-card-title">Total Packages</div>
                    <div class="admin-card-value text-primary">12</div>
                    <a href="{{ route('admin.packages') }}" class="btn btn-sm btn-outline-primary">Manage</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card admin-card text-center p-3">
                <div class="card-body">
                    <div class="admin-icon"><i class="fas fa-bed"></i></div>
                    <div class="admin-card-title">Available Rooms</div>
                    <div class="admin-card-value text-success">24</div>
                    <a href="{{ route('room') }}" class="btn btn-sm btn-outline-success">Manage</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card admin-card text-center p-3">
                <div class="card-body">
                    <div class="admin-icon"><i class="fas fa-users"></i></div>
                    <div class="admin-card-title">User Accounts</div>
                    <div class="admin-card-value text-dark">108</div>
                    <a href="#" class="btn btn-sm btn-outline-dark">View</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card admin-card text-center p-3">
                <div class="card-body">
                    <div class="admin-icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="admin-card-title">Bookings</div>
                    <div class="admin-card-value text-warning">45</div>
                    <a href="#" class="btn btn-sm btn-outline-warning">View</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
