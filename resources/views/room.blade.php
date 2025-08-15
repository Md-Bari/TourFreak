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

                <!-- Button to trigger custom popup -->
                <button class="btn btn-primary w-100"
                    onclick="openRoomPopup(
                        '{{ addslashes($room->title) }}',
                        '{{ addslashes($room->description) }}',
                        '{{ $room->price }}',
                        '{{ asset('assets/images/' . $room->image) }}'
                    )">
                    View Details
                </button>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p class="text-center">No rooms available at the moment.</p>
        </div>
        @endforelse
    </div>
</section>

<!-- ===== Room Popup Modal ===== -->
<div id="roomPopup" class="popup-overlay" style="display:none;">
    <div class="popup-content">
        <span class="close-btn" onclick="closeRoomPopup()">×</span>
        <img id="roomPopupImage" src="" alt="Room Image"
            style="width:100%;max-width:400px;min-height:220px;max-height:260px;border-radius:12px;margin-bottom:18px;object-fit:cover;" />
        <h2 id="roomPopupTitle">Room Title</h2>
        <p id="roomPopupDetails">Room details will appear here.</p>
        <p id="roomPopupPrice" style="font-weight:600;color:#0d6efd;margin-bottom:10px;"></p>
        <a href="#" id="roomPopupOrderBtn" class="btn btn-success">Book Now</a>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openRoomPopup(title, description, price, imageUrl) {
    document.getElementById('roomPopupTitle').textContent = title;
    document.getElementById('roomPopupDetails').textContent = description;
    document.getElementById('roomPopupPrice').textContent = `Price: $${price}`;
    document.getElementById('roomPopupImage').src = imageUrl;
    document.getElementById('roomPopupOrderBtn').href = `/order/room/${encodeURIComponent(title)}`;
    document.getElementById('roomPopup').style.display = 'flex';
}

function closeRoomPopup() {
    document.getElementById('roomPopup').style.display = 'none';
}
</script>
@endpush
