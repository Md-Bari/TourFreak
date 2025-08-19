@extends('admin.admin')


@push('style')
<link rel="stylesheet" href="{{ asset('css/package.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush


@section('content')
<div class="container">
    <!-- Add Package Form -->
    <h2 class="fw-bold">Add New Package</h2>
    <form action="{{ url('/admin/packages/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" class="form-control" placeholder="Title" required>
        <select name="class" class="form-select" required>
            <option value="">-- Select Class --</option>
            <option value="mountain">Mountain</option>
            <option value="sea">Sea</option>
            <option value="forest">Forest</option>
            <option value="normal">Normal</option>
        </select>
        <label class="form-label">Package Image</label>
        <input type="file" name="image" class="form-control" required>
        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        <input type="text" name="features" class="form-control" placeholder="Features" required>
        <textarea name="description" class="form-control" placeholder="Description" required></textarea>
        <div class="row mb-3">
            <div class="col">
                <input type="number" name="duration_day" class="form-control" placeholder="Days" min="0" required>
            </div>
            <div class="col">
                <input type="number" name="duration_night" class="form-control" placeholder="Nights" min="0" required>
            </div>
        </div>
        <input type="number" name="price" class="form-control mb-3" placeholder="Price" step="0.01" required>
        <button type="submit">+ Add Package</button>
    </form>

    <!-- All Packages Section -->
    <h2 class="fw-bold mt-5">All Packages</h2>
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
