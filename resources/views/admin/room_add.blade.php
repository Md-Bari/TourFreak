@extends('admin.admin')

@section('title', 'Add Room')

@section('content')
<div class="page-shell">
    <div class="page-hero">
        <div>
            <span class="eyebrow">Room management</span>
            <h1>Add New Room</h1>
            <p>Create a room listing with a simple, polished form.</p>
        </div>
    </div>

    <section class="glass-panel form-panel">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data" class="modern-form">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Room Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Deluxe Sea View Room" required>
                @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Room Image</label>
                <input type="file" name="image" class="form-control" required>
                @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" class="form-control" step="0.01" value="{{ old('price') }}" placeholder="4500" required>
                @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="form-label">Room Description</label>
                <textarea name="description" class="form-control" rows="5" placeholder="Describe the room, facilities, and view..." required>{{ old('description') }}</textarea>
                @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary modern-submit">Add Room</button>
        </form>
    </section>
</div>
@endsection
