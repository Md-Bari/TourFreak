@extends('admin.admin')

@push('style')
<link rel="stylesheet" href="{{ asset('css/package.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">Add New Package</h2>
    <form action="{{ url('/admin/packages/store') }}" method="POST" class="mb-5">
        @csrf
        <div class="mb-3">
            <input type="text" name="title" class="form-control" placeholder="Title" required>
        </div>
        <div class="mb-3">
            <select name="class" class="form-select" required>
                <option value="">-- Select Class --</option>
                <option value="mountain">Mountain</option>
                <option value="sea">Sea</option>
                <option value="normal">Normal</option>
            </select>
        </div>
        <div class="mb-3">
            <input type="text" name="image" class="form-control" placeholder="Image Path" required>
        </div>
        <div class="mb-3">
            <input type="text" name="features" class="form-control" placeholder="Features" required>
        </div>
        <div class="mb-3">
            <textarea name="description" class="form-control" placeholder="Description" required></textarea>
        </div>
        <div class="mb-3">
            <input type="number" name="price" class="form-control" placeholder="Price" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Package</button>
    </form>

    <h2 class="mb-3 fw-bold">All Packages</h2>
    <div class="list-group">
        @foreach($packages as $package)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $package->title }}</strong>
                    <span class="badge bg-secondary">{{ ucfirst($package->class) }}</span>
                    <span class="text-muted ms-2">${{ number_format($package->price, 2) }}</span>
                </div>
                <div>
                    <a href="{{ url('/admin/packages/edit/' . $package->id) }}" class="btn btn-sm btn-outline-info me-2">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                    <form action="{{ url('/admin/packages/delete/' . $package->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
