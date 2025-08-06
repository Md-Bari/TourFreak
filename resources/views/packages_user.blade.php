@extends('index') {{-- or your layout file --}}
@push('style')
<link rel="stylesheet" href="{{ asset('css/user_package.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush
@section('content')
<h2>Tour Packages - Class: {{ ucfirst($class) }}</h2>

<section class="tour-packages">
    @forelse($packages as $package)
    <div class="package">
        <img src="{{ asset($package->image) }}" alt="{{ $package->title }}" width="300">
        <h2>{{ $package->title }}</h2>
        <p class="features">Features: <span>{{ $package->features }}</span></p>
        <p class="description">{{ $package->description }}</p>
        <p class="price">Price Per Person: Starting Price <br><span>${{ number_format($package->price, 2) }}</span></p>
        <button onclick="openPopup('{{ $package->title }}')">Tour Details ➤</button>
    </div>
    @empty
    <p>No packages found in this class.</p>
    @endforelse
</section>
@endsection
