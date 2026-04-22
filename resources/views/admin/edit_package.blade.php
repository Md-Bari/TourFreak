@extends('admin.admin')

@section('title', 'Edit Package')

@section('content')
<div class="page-shell">
    <div class="page-hero">
        <div>
            <span class="eyebrow">Update package</span>
            <h1>Edit Package</h1>
            <p>Refine package details, media, duration, and pricing from one tidy form.</p>
        </div>
    </div>

    <section class="glass-panel form-panel">
        <form action="{{ route('admin.packages.update', $package->id) }}" method="POST" enctype="multipart/form-data" class="modern-form">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Package Title</label>
                <input type="text" name="title" class="form-control" value="{{ $package->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="class" class="form-select" required>
                    <option value="mountain" {{ $package->class == 'mountain' ? 'selected' : '' }}>Mountain</option>
                    <option value="sea" {{ $package->class == 'sea' ? 'selected' : '' }}>Sea</option>
                    <option value="forest" {{ $package->class == 'forest' ? 'selected' : '' }}>Forest</option>
                    <option value="normal" {{ $package->class == 'normal' ? 'selected' : '' }}>Normal</option>
                </select>
            </div>

            <div class="image-preview-card mb-3">
                <div>
                    <label class="form-label">Current Image</label>
                    <img src="{{ asset('assets/images/' . $package->image) }}"
                        alt="Package Image"
                        class="img-thumbnail package-preview-image">
                </div>

                <div class="w-100">
                    <label class="form-label">Change Image (optional)</label>
                    <input type="file" name="image" class="form-control">
                    @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Highlights</label>
                <input type="text" name="features" class="form-control" value="{{ $package->features }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="5" required>{{ $package->description }}</textarea>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-sm-6">
                    <label class="form-label">Days</label>
                    <input type="number" name="duration_day" class="form-control" value="{{ $package->duration_day }}" placeholder="Days" min="0" required>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Nights</label>
                    <input type="number" name="duration_night" class="form-control" value="{{ $package->duration_night }}" placeholder="Nights" min="0" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control" value="{{ $package->price }}" step="0.01" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary modern-submit">Update Package</button>
                <a href="{{ route('admin.packages') }}" class="btn btn-light modern-cancel">Cancel</a>
            </div>
        </form>
    </section>
</div>
@endsection
