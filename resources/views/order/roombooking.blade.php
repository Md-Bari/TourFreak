@extends('index')

@section('content')
    <div class="container py-5" style="font-family: Arial, sans-serif;">

        @if(session('success'))
            <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
        @endif

        <div style="display: flex; flex-wrap: wrap; gap: 20px;">

            {{-- Left Side: Room Info --}}
            <div style="flex: 2; min-width: 300px;">

                <div class="card p-3 mb-4" style="border: 1px solid #ddd; border-radius: 10px;">
                    <h5>Room Information</h5>
                    <div style="display: flex; gap: 15px; margin-top: 10px;">
                        <img src="{{ asset('assets/images/' . $room->image) }}" alt="{{ $room->title }}" width="120"
                            height="120" style="object-fit: cover; border-radius: 6px;">
                        <div>
                            <h6>{{ $room->title }}</h6>
                            <p style="margin:0;"><strong>৳{{ $room->price_per_night }}</strong> / night</p>
                            <small>Number of Days: {{ $days }}</small>
                        </div>
                    </div>

                    {{-- Booking Summary Form --}}
                    <form action="{{ route('roombooking.store') }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <input type="hidden" name="days" value="{{ $days }}">

                        <button type="button" class="btn btn-success w-100 mt-3" onclick="window.location='{{ url('/') }}'">
                            Proceed to Pay
                        </button>

                    </form>
                </div>
            </div>

            {{-- Right Side: Payment Summary --}}
            <div style="flex: 1; min-width: 280px;">
                <div class="card p-3" style="border: 1px solid #ddd; border-radius: 10px;">
                    <h5>Payment Summary</h5>
                    <hr>
                    @php
                        $subtotal = $room->price_per_night * $days;
                        $vat = $subtotal * 0.15;
                        $total = $subtotal + $vat;
                    @endphp
                    <div style="display: flex; justify-content: space-between;">
                        <span>Room Price</span>
                        <span>৳{{ $room->price_per_night }} × {{ $days }} days</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>VAT (15%)</span>
                        <span>৳{{ number_format($vat, 2) }}</span>
                    </div>
                    <hr>
                    <div style="display: flex; justify-content: space-between; font-weight: bold;">
                        <span>Total Amount</span>
                        <span>৳{{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
