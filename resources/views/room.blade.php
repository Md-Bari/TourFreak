@extends('index')

@push('style')
<link rel="stylesheet" href="{{ asset('css/room.css') }}">
@endpush

@section('content')
<section class="rooms-hero">
    <div class="rooms-hero-content">
        <h1>Rooms</h1>
        <p>See our rooms!</p>
    </div>
</section>

<section class="container py-5">
    <div class="row g-4">

        <!-- Single Room -->
        <div class="col-md-6 col-lg-3">
            <div class="room-card">
                <img src="/assets/images/s.jpg" alt="Single Room" class="room-img">
                <h5 class="room-title">SINGLE ROOM</h5>
                <p class="room-price">start from <span class="price">$110</span></p>
                <p class="room-description">
                    Our single room is the perfect choice for travellers seeking comfortable and convenient accommodations. The room features a comfortable single bed, a desk and chair, and a private bathroom with a shower.
                </p>
                <a href="{{ route('room.details', ['type' => 'single']) }}" class="btn btn-primary w-100">View Details</a>
            </div>
        </div>

        <!-- Double Room -->
        <div class="col-md-6 col-lg-3">
            <div class="room-card">
                <img src="/assets/images/d.jpg" alt="Double Room" class="room-img">
                <h5 class="room-title">DOUBLE ROOM</h5>
                <p class="room-price">start from <span class="price">$90</span></p>
                <p class="room-description">
                    Our double room is perfect for couples or friends travelling together, featuring two comfortable double beds, a desk and chair, and a private bathroom with a shower.
                </p>
                <a href="{{ route('room.details', ['type' => 'double']) }}" class="btn btn-primary w-100">View Details</a>
            </div>
        </div>

        <!-- Family Room -->
        <div class="col-md-6 col-lg-3">
            <div class="room-card">
                <img src="/assets/images/f.jpeg" alt="Family Room" class="room-img">
                <h5 class="room-title">FAMILY ROOM</h5>
                <p class="room-price">start from <span class="price">$160</span></p>
                <p class="room-description">
                    Our family room is ideal for families, featuring two comfortable double beds, a sofa bed, a desk and chair, and a private bathroom with a shower.
                </p>
                <a href="{{ route('room.details', ['type' => 'family']) }}" class="btn btn-primary w-100">View Details</a>
            </div>
        </div>

        <!-- Apartment -->
        <div class="col-md-6 col-lg-3">
            <div class="room-card">
                <img src="/assets/images/ap.jpg" alt="Apartment" class="room-img">
                <h5 class="room-title">APARTMENT</h5>
                <p class="room-price">start from <span class="price">$230</span></p>
                <p class="room-description">
                    Our 2-bed apartment offers space and privacy, featuring two comfortable bedrooms, a double bed, and plenty of storage space.
                </p>
                <a href="{{ route('room.details', ['type' => 'apartment']) }}" class="btn btn-primary w-100">View Details</a>
            </div>
        </div>

    </div>
</section>
@endsection
