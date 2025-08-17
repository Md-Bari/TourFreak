@extends('index')

@section('content')
<div class="main-content" style="margin-left:200px; margin-top:60px; padding:20px; max-width:900px;">

    <h2 class="mb-4" style="font-size:24px; font-weight:bold; color:#333;">My Bookings</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div style="padding:12px; background:#d4edda; color:#155724; margin-bottom:20px; border-radius:8px; border:1px solid #c3e6cb;">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div style="padding:12px; background:#f8d7da; color:#721c24; margin-bottom:20px; border-radius:8px; border:1px solid #f5c6cb;">
            ❌ {{ session('error') }}
        </div>
    @endif

    {{-- Bookings List --}}
    @forelse($orders as $order)
        <div style="background:#fff; padding:20px; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.08); margin-bottom:25px;">

            {{-- Package Title --}}
            <h3 style="margin-bottom:10px; color:#007bff; font-size:20px;">{{ $order->package->title }}</h3>

            {{-- Booking Details --}}
            <p><strong>Amount:</strong> {{ number_format($order->amount, 2) }} {{ $order->currency }}</p>
            <p><strong>Status:</strong>
                <span style="padding:6px 12px; border-radius:20px; font-weight:600;
                    background: {{ $order->status == 'Paid' ? '#d4edda' : '#f8d7da' }};
                    color: {{ $order->status == 'Paid' ? '#155724' : '#721c24' }};">
                    {{ ucfirst($order->status) }}
                </span>
            </p>

            {{-- Existing Review --}}
            @if($order->package->reviews->isNotEmpty())
                <div style="margin-top:20px; background:#f9f9f9; padding:15px; border-radius:10px; border-left:4px solid #007bff;">
                    <h4 style="margin-bottom:10px; font-size:18px;">Your Review:</h4>
                    @foreach($order->package->reviews as $review)
                        <p><strong>Rating:</strong> <span style="color:#ffc107;">{{ str_repeat('★', $review->rating) }}</span></p>
                        <p style="margin:0; color:#555;">{{ $review->comment }}</p>
                    @endforeach
                </div>
            @else
                {{-- Review Form --}}
                <form action="{{ route('reviews.store') }}" method="POST" style="margin-top:20px;">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $order->package->id }}">

                    <label for="rating" style="display:block; margin-bottom:6px; font-weight:600;">Rating:</label>
                    <select name="rating" required style="padding:6px; border-radius:6px; border:1px solid #ccc;">
                        <option value="5">★★★★★ (5)</option>
                        <option value="4">★★★★ (4)</option>
                        <option value="3">★★★ (3)</option>
                        <option value="2">★★ (2)</option>
                        <option value="1">★ (1)</option>
                    </select>

                    <textarea name="comment" rows="3" placeholder="Write your review..."
                              style="width:100%; margin-top:10px; border-radius:8px; padding:10px; border:1px solid #ccc;" required></textarea>

                    <button type="submit"
                            style="margin-top:12px; background:#007bff; color:#fff; font-weight:600; border:none; padding:10px 18px; border-radius:8px; cursor:pointer;">
                        Submit Review
                    </button>
                </form>
            @endif

            {{-- Cancel Order Button (only if not Paid) --}}
            @if($order->status != 'Paid')
                <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="margin-top:15px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Are you sure you want to cancel this booking?');"
                            style="background:#dc3545; color:#fff; font-weight:600; border:none; padding:10px 18px; border-radius:8px; cursor:pointer;">
                        Cancel Booking
                    </button>
                </form>
            @endif

        </div>
    @empty
        <div style="padding:15px; background:#f8d7da; color:#721c24; border-radius:8px; text-align:center;">
            You don’t have any bookings yet.
        </div>
    @endforelse
</div>
@endsection
