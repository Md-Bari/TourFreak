@extends('admin.admin')

@section('title', 'Edit Package')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 fw-bold">Edit Package</h2>
    <form action="{{ route('admin.packages.update', $package->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <input type="text" name="title" class="form-control" value="{{ $package->title }}" required>
        </div>
        <div class="mb-3">
            <select name="class" class="form-select" required>
                <option value="mountain" {{ $package->class == 'mountain' ? 'selected' : '' }}>Mountain</option>
                <option value="sea" {{ $package->class == 'sea' ? 'selected' : '' }}>Sea</option>
                <option value="normal" {{ $package->class == 'normal' ? 'selected' : '' }}>Normal</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Current Image:</label><br>
            <img src="{{ asset('assets/images/' . $package->image) }}" alt="Package Image" class="img-thumbnail mb-2" style="max-width: 200px;">
            <div class="mb-3">
            <input type="file" name="image" class="form-control" required>
            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        </div>
        <div class="mb-3">
            <input type="text" name="features" class="form-control" value="{{ $package->features }}" required>
        </div>
        <div class="mb-3">
            <textarea name="description" class="form-control" required>{{ $package->description }}</textarea>
        </div>
        <div class="mb-3">
            <input type="number" name="price" class="form-control" value="{{ $package->price }}" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Package</button>
        <a href="{{ route('admin.packages') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
