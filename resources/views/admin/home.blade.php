@extends('admin.admin')

@section('title', 'Admin Dashboard - Tour Freak')

@push('style')
<style>
    .admin-card {
        border-left: 5px solid #0d6efd;
        transition: all 0.3s ease;
    }
    .admin-card:hover {
        transform: scale(1.02);
    }
</style>
@endpush

@section('content')
<div class="container mt-5 pt-5">
    <h2 class="mb-4 fw-bold">Welcome, Admin</h2>

    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm admin-card">
                <div class="card-body">
                    <h5 class="card-title">Total Packages</h5>
                    <p class="card-text fs-4 fw-bold text-primary">12</p>
                    <a href="{{ route('admin.packages') }}" class="btn btn-sm btn-outline-primary">Manage Packages</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm admin-card">
                <div class="card-body">
                    <h5 class="card-title">Available Rooms</h5>
                    <p class="card-text fs-4 fw-bold text-success">24</p>
                    <a href="{{ route('room') }}" class="btn btn-sm btn-outline-success">Manage Rooms</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm admin-card">
                <div class="card-body">
                    <h5 class="card-title">User Accounts</h5>
                    <p class="card-text fs-4 fw-bold text-dark">108</p>
                    <a href="#" class="btn btn-sm btn-outline-dark">View Users</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm admin-card">
                <div class="card-body">
                    <h5 class="card-title">Bookings</h5>
                    <p class="card-text fs-4 fw-bold text-warning">45</p>
                    <a href="#" class="btn btn-sm btn-outline-warning">View Bookings</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
