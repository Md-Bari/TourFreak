@extends('index')

@push('style')
<link rel="stylesheet" href="{{ asset('css/room.css') }}">
<style>
/* Glassmorphism for popup */
.popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(15, 23, 42, 0.5);
    backdrop-filter: blur(6px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
}

.popup-overlay.show {
    opacity: 1;
    visibility: visible;
}

.popup-content {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 2rem;
    max-width: 450px;
    width: 90%;
    text-align: center;
    position: relative;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    animation: floatIn 0.5s ease forwards;
}

@keyframes floatIn {
    0% { transform: translateY(-50px); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
}

.close-btn {
    position: absolute;
    top: 15px;
    right: 20px;
    font-size: 1.5rem;
    font-weight: bold;
    color: white;
    cursor: pointer;
    transition: transform 0.2s;
}

.close-btn:hover {
    transform: rotate(90deg);
    color: #f87171;
}

.popup-content h2 {
    color: #f9fafb;
    font-size: 1.75rem;
    margin-bottom: 0.75rem;
}

.popup-content p {
    color: #e5e7eb;
    margin-bottom: 1rem;
}

.popup-content .btn {
    border-radius: 12px;
    font-weight: 600;
    transition: transform 0.3s, box-shadow 0.3s;
}

.popup-content .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
}
</style>
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
<div id="roomPopup" class="popup-overlay">
    <div class="popup-content">
        <span class="close-btn" onclick="closeRoomPopup()">×</span>
        <img id="roomPopupImage" src="" alt="Room Image"
            style="width:100%;max-width:400px;min-height:220px;max-height:260px;border-radius:12px;margin-bottom:18px;object-fit:cover;" />
        <h2 id="roomPopupTitle">Room Title</h2>
        <p id="roomPopupDetails">Room details will appear here.</p>
        <p id="roomPopupPrice" style="font-weight:600;color:#0d6efd;margin-bottom:10px;"></p>
        <a href="#" id="roomPopupOrderBtn" class="btn btn-success w-100">Book Now</a>
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
    document.getElementById('roomPopup').classList.add('show');
}

function closeRoomPopup() {
    document.getElementById('roomPopup').classList.remove('show');
}
</script>
@endpush
w
