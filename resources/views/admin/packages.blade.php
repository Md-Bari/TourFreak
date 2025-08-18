@extends('admin.admin')

@push('style')
<link rel="stylesheet" href="{{ asset('css/package.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    /* Card Layout */
    .tour-packages-wrapper {
        margin-top: 30px;
    }
    .tour-scroll-wrapper {
        overflow-x: auto;
        padding-bottom: 15px;
    }
    .tour-packages {
        display: flex;
        gap: 20px;
    }
    .package {
        flex: 0 0 280px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    .package:hover {
        transform: translateY(-5px);
    }
    .package img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }
    .package h2 {
        font-size: 20px;
        margin: 15px;
        font-weight: bold;
        color: #333;
    }
    .package p {
        margin: 0 15px 10px;
        font-size: 14px;
        color: #555;
    }
    .package .price span {
        font-size: 18px;
        font-weight: bold;
        color: #007bff;
    }
    .package .btn-group {
        display: flex;
        justify-content: space-between;
        padding: 15px;
    }
    .package .btn-custom {
        border-radius: 25px;
        padding: 6px 15px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-edit {
        background: #0d6efd;
        color: #fff;
    }
    .btn-edit:hover {
        background: #0b5ed7;
    }
    .btn-delete {
        background: #dc3545;
        color: #fff;
    }
    .btn-delete:hover {
        background: #bb2d3b;
    }
</style>
@endpush

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">Add New Package</h2>
    <form action="{{ url('/admin/packages/store') }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        <div class="mb-3">
            <input type="text" name="title" class="form-control" placeholder="Title" required>
        </div>
        <div class="mb-3">
            <select name="class" class="form-select" required>
                <option value="">-- Select Class --</option>
                <option value="mountain">Mountain</option>
                <option value="sea">Sea</option>
                <option value="forest">Forest</option>
                <option value="normal">Normal</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Package Image</label>
            <input type="file" name="image" class="form-control" required>
            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <input type="text" name="features" class="form-control" placeholder="Features" required>
        </div>
        <div class="mb-3">
            <textarea name="description" class="form-control" placeholder="Description" required></textarea>
        </div>
        <div class="mb-3 row">
            <div class="col">
                <input type="number" name="duration_day" class="form-control" placeholder="Days" min="0" required>
            </div>
            <div class="col">
                <input type="number" name="duration_night" class="form-control" placeholder="Nights" min="0" required>
            </div>
        </div>
        <div class="mb-3">
            <input type="number" name="price" class="form-control" placeholder="Price" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-success px-4">+ Add Package</button>
    </form>

    <h2 class="mb-3 fw-bold">All Packages</h2>

    <section class="tour-packages-wrapper">
        <div class="tour-scroll-wrapper">
            <div class="tour-packages">
                @foreach($packages as $package)
                    <div class="package">
                        <img src="{{ asset('assets/images/' . $package->image) }}" alt="{{ $package->title }}">
                        <h2>{{ $package->title }}</h2>
                        <p class="features"><strong>Features:</strong> {{ $package->features }}</p>
                        <p class="description">{{ $package->description }}</p>

                        @if(isset($package->duration_day) && isset($package->duration_night))
                            <p class="duration">
                                <strong>Duration:</strong>
                                {{ $package->duration_day }} Day{{ $package->duration_day > 1 ? 's' : '' }},
                                {{ $package->duration_night }} Night{{ $package->duration_night > 1 ? 's' : '' }}
                            </p>
                        @endif

                        <p class="price">
                            Price Per Person: <span>{{ number_format($package->price, 2) }}</span>
                        </p>

                        <div class="btn-group">
                            <a href="{{ url('/admin/packages/edit/' . $package->id) }}" class="btn btn-custom btn-edit">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <form action="{{ url('/admin/packages/delete/' . $package->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-custom btn-delete">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
