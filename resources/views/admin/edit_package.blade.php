@extends('admin.admin')

@section('title', 'Edit Package')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">Edit Package</h2>
    <form action="{{ route('admin.packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="mb-3">
            <input type="text" name="title" class="form-control" value="{{ $package->title }}" required>
        </div>

        {{-- Class --}}
        <div class="mb-3">
            <select name="class" class="form-select" required>
                <option value="mountain" {{ $package->class == 'mountain' ? 'selected' : '' }}>Mountain</option>
                <option value="sea" {{ $package->class == 'sea' ? 'selected' : '' }}>Sea</option>
                <option value="forest" {{ $package->class == 'forest' ? 'selected' : '' }}>Forest</option>
                <option value="normal" {{ $package->class == 'normal' ? 'selected' : '' }}>Normal</option>
            </select>
        </div>

        {{-- Image --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Current Image:</label><br>
            <img src="{{ asset('assets/images/' . $package->image) }}"
                 alt="Package Image"
                 class="img-thumbnail mb-2"
                 style="max-width: 250px; height:auto;">

            <div class="mt-2">
                <label class="form-label">Change Image (optional):</label>
                <input type="file" name="image" class="form-control">
                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Features --}}
        <div class="mb-3">
            <input type="text" name="features" class="form-control" value="{{ $package->features }}" required>
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <textarea name="description" class="form-control" required>{{ $package->description }}</textarea>
        </div>

        {{-- Duration --}}
        <div class="mb-3 row">
            <div class="col">
                <input type="number" name="duration_day" class="form-control" value="{{ $package->duration_day }}" placeholder="Days" min="0" required>
            </div>
            <div class="col">
                <input type="number" name="duration_night" class="form-control" value="{{ $package->duration_night }}" placeholder="Nights" min="0" required>
            </div>
        </div>

        {{-- Price --}}
        <div class="mb-3">
            <input type="number" name="price" class="form-control" value="{{ $package->price }}" step="0.01" required>
        </div>

        {{-- Buttons --}}
        <button type="submit" class="btn btn-primary">Update Package</button>
        <a href="{{ route('admin.packages') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
