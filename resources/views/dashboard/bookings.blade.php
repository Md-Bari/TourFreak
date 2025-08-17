@extends('index')

@section('content')
<div class="main-content" style="margin-left:200px; margin-top:60px; padding:20px; max-width:1000px;">

    <h2 class="mb-4" style="font-size:28px; font-weight:700; color:#222; text-align:center;">
        🌍 My Tour Bookings
    </h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div style="padding:12px; background:#d4edda; color:#155724; margin-bottom:20px; border-radius:10px; border:1px solid #c3e6cb; text-align:center;">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div style="padding:12px; background:#f8d7da; color:#721c24; margin-bottom:20px; border-radius:10px; border:1px solid #f5c6cb; text-align:center;">
            ❌ {{ session('error') }}
        </div>
    @endif

    {{-- Bookings List --}}
    @forelse($orders as $order)
        <div style="background:#fff; padding:25px; border-radius:16px; box-shadow:0 6px 16px rgba(0,0,0,0.08); margin-bottom:30px; transition:all .3s ease;"
             onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.15)';"
             onmouseout="this.style.transform=''; this.style.boxShadow='0 6px 16px rgba(0,0,0,0.08)';">

            {{-- Transport + Title --}}
            <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap;">
                <h3 style="color:#007bff; font-size:22px; font-weight:700; margin-bottom:10px;">
                    @php
                        $icons = [
                            'plane' => '✈️',
                            'bus' => '🚌',
                            'train' => '🚆',
                            'ship' => '🚢',
                        ];
                        $transport = $order->package->transport_type ?? 'plane';
                    @endphp
                    {{ $icons[$transport] ?? '🌍' }} {{ $order->package->title }}
                </h3>
                <span style="padding:8px 16px; border-radius:20px; font-weight:600;
                    background: {{ $order->status == 'Paid' ? '#d4edda' : '#f8d7da' }};
                    color: {{ $order->status == 'Paid' ? '#155724' : '#721c24' }};">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            {{-- Booking Info --}}
            <p style="margin:8px 0;"><strong>💰 Amount:</strong> {{ number_format($order->amount, 2) }} {{ $order->currency }}</p>
            <p style="margin:8px 0;"><strong>📅 Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>

            {{-- Review Section --}}
            @if($order->package->reviews->isNotEmpty())
                <div style="margin-top:20px; background:#f9f9f9; padding:15px; border-radius:10px; border-left:4px solid #007bff;">
                    <h4 style="margin-bottom:10px; font-size:18px; font-weight:600;">⭐ Your Review:</h4>
                    @foreach($order->package->reviews as $review)
                        <p><strong>Rating:</strong> <span style="color:#ffc107;">{{ str_repeat('★', $review->rating) }}</span></p>
                        <p style="margin:0; color:#555;">{{ $review->comment }}</p>
                    @endforeach
                </div>
            @else
                <form action="{{ route('reviews.store') }}" method="POST" style="margin-top:20px;">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $order->package->id }}">

                    <label style="font-weight:600;">Rating:</label>
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

            {{-- Cancel Button --}}
            @if($order->status != 'Paid')
                <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="margin-top:15px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Are you sure you want to cancel this booking?');"
                            style="background:#dc3545; color:#fff; font-weight:600; border:none; padding:10px 18px; border-radius:8px; cursor:pointer;">
                        ❌ Cancel Booking
                    </button>
                </form>
            @endif

        </div>
    @empty
        <div style="padding:20px; background:#f8d7da; color:#721c24; border-radius:10px; text-align:center; font-size:16px;">
            You don’t have any bookings yet. Start exploring 🌍✈️🚌🚆🚢
        </div>
    @endforelse
</div>
@endsection
