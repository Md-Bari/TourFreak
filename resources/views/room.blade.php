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
        @forelse ($rooms as $room)
        <div class="col-md-6 col-lg-3">
            <div class="room-card">
                <img src="{{ asset('assets/images/' . $room->image) }}" alt="{{ $room->image }}" class="room-img">
                <h5 class="room-title">{{ strtoupper($room->title) }}</h5>
                <p class="room-price">start from <span class="price">${{ $room->price }}</span></p>
                <p class="room-description">
                    {{ Str::limit($room->description, 150) }}
                </p>
                <a href="{{ route('room.details', ['type' => strtolower($room->title)]) }}" class="btn btn-primary w-100">View Details</a>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p class="text-center">No rooms available at the moment.</p>
        </div>
        @endforelse
    </div>
</section>
@endsection
