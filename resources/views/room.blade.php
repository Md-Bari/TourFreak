@extends('index')

@push('style')
<link rel="stylesheet" href="{{ asset('css/room.css') }}">
<!-- Add Bootstrap CSS if not included globally -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#roomModal{{ $room->id }}">
                    View Details
                </button>

                <!-- Modal -->
                <div class="modal fade" id="roomModal{{ $room->id }}" tabindex="-1" aria-labelledby="roomModalLabel{{ $room->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="roomModalLabel{{ $room->id }}">{{ $room->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('assets/images/' . $room->image) }}" alt="{{ $room->title }}" class="img-fluid mb-3">
                                <p>{{ $room->description }}</p>
                                <p><strong>Price: ${{ $room->price }}</strong></p>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ route('order.page', ['type' => 'room', 'id' => $room->id]) }}" class="btn btn-success">Book Now</a>

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

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

@push('scripts')
<!-- Add Bootstrap JS Bundle if not included globally -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
