@extends('index')

@push('style')
<link rel="stylesheet" href="{{ asset('css/room.css') }}">
@endpush

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Room Image -->
        <div class="col-md-6">
            <img src="{{ asset('assets/images/' . $room->image) }}"
                 alt="{{ $room->title }}"
                 class="img-fluid rounded shadow">
        </div>

        <!-- Room Details -->
        <div class="col-md-6">
            <h2 class="mb-3">{{ strtoupper($room->title) }}</h2>
            <p class="text-muted">{{ $room->description }}</p>
            <h4 class="text-primary">Price per Night: ${{ number_format($room->price, 2) }}</h4>

            <!-- Days Selection -->
            <form action="{{ url('/order/room/' . $room->id) }}" method="GET" id="roomOrderForm">
                <div class="mb-3">
                    <label for="days" class="form-label">Number of Days</label>
                    <input type="number" id="days" name="days" class="form-control" min="1" value="1" required oninput="updateRoomTotal()">
                </div>

                <!-- Show Total Price -->
                <p><strong>Total Price: $<span id="totalRoomPrice">{{ number_format($room->price, 2) }}</span></strong></p>

                <button type="submit" class="btn btn-success w-100">Book Now</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    let roomPrice = {{ $room->price }};

    function updateRoomTotal() {
        let days = document.getElementById('days').value || 1;
        let total = (roomPrice * days).toFixed(2);
        document.getElementById('totalRoomPrice').textContent = total;
    }
</script>
@endpush
