@extends('admin.admin')


@push('style')
<link rel="stylesheet" href="{{ asset('css/package.css') }}">
@endpush


@section('content')
<div class="page-shell">
    <div class="page-hero">
        <div>
            <span class="eyebrow">Manage tours</span>
            <h1>Packages</h1>
            <p>Create, edit, and organize travel packages with a cleaner admin experience.</p>
        </div>
    </div>

    <div class="admin-grid">
        <section class="glass-panel">
            <div class="panel-heading">
                <div>
                    <span class="section-kicker">Create package</span>
                    <h2 class="panel-title">Add New Package</h2>
                </div>
            </div>

            <form action="{{ url('/admin/packages/store') }}" method="POST" enctype="multipart/form-data" class="modern-form">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Package Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Sajek Valley Escape" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="class" class="form-select" required>
                        <option value="">Select a package type</option>
                        <option value="mountain">Mountain</option>
                        <option value="sea">Sea</option>
                        <option value="forest">Forest</option>
                        <option value="normal">Normal</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Package Image</label>
                    <input type="file" name="image" class="form-control" required>
                    @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Highlights</label>
                    <input type="text" name="features" class="form-control" placeholder="Transport, meals, guide, hotel" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="5" placeholder="Write a short package overview..." required></textarea>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-sm-6">
                        <label class="form-label">Days</label>
                        <input type="number" name="duration_day" class="form-control" placeholder="3" min="0" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">Nights</label>
                        <input type="number" name="duration_night" class="form-control" placeholder="2" min="0" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Price Per Person</label>
                    <input type="number" name="price" class="form-control" placeholder="5500" step="0.01" required>
                </div>

                <button type="submit" class="btn btn-primary modern-submit">Add Package</button>
            </form>
        </section>

        <section class="content-stack">
            <div class="panel-heading">
                <div>
                    <span class="section-kicker">Existing entries</span>
                    <h2 class="panel-title">All Packages</h2>
                </div>
            </div>

            <div class="package-grid">
                @foreach($packages as $package)
                    <article class="package">
                        <div class="package-media">
                            <img src="{{ asset('assets/images/' . $package->image) }}" alt="{{ $package->title }}">
                            <span class="package-badge">{{ ucfirst($package->class) }}</span>
                        </div>
                        <div class="package-body">
                            <h2>{{ $package->title }}</h2>
                            <p class="features">{{ $package->features }}</p>
                            <p class="description">{{ $package->description }}</p>
                        </div>

                        @if(isset($package->duration_day) && isset($package->duration_night))
                            <div class="package-meta">
                                <span>{{ $package->duration_day }} Day{{ $package->duration_day > 1 ? 's' : '' }}</span>
                                <span>{{ $package->duration_night }} Night{{ $package->duration_night > 1 ? 's' : '' }}</span>
                            </div>
                        @endif

                        <p class="price">
                            Price Per Person <span>{{ number_format($package->price, 2) }}</span>
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
                    </article>
                @endforeach
            </div>
        </section>
    </div>
</div>
@endsection
