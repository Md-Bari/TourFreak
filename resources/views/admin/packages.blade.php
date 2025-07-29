@extends('admin.admin')

@push('style')
<link rel="stylesheet" href="{{ asset('css/package.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@section('content')
<h2>Add New Package</h2>
<form action="{{ url('/admin/packages/store') }}" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Title" required><br>
    <select name="class" required>
        <option value="">-- Select Class --</option>
        <option value="mountain">Mountain</option>
        <option value="sea">Sea</option>
        <option value="normal">Normal</option>
    </select><br>
    <input type="text" name="image" placeholder="Image Path" required><br>
    <input type="text" name="features" placeholder="Features" required><br>
    <textarea name="description" placeholder="Description" required></textarea><br>
    <input type="number" name="price" placeholder="Price" step="0.01" required><br>
    <button type="submit">Add Package</button>
</form>

<h2>All Packages</h2>
@foreach($packages as $package)
    <div>
        <strong>{{ $package->title }}</strong> - {{ $package->class }}
        <form action="{{ url('/admin/packages/delete/' . $package->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">❌ Delete</button>
        </form>
    </div>
@endforeach

@endsection
