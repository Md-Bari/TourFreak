@extends('index')

@section('content')
<div class="container py-5" style="font-family: Arial, sans-serif;">
    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
    @endif

    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        {{-- Left Side --}}
        <div style="flex: 2; min-width: 300px;">
            {{-- Shipping Info --}}
            <div class="card p-3 mb-4" style="border: 1px solid #ddd; border-radius: 10px;">
                <h5>Shipping & Billing</h5>
                <p>
                    <strong>{{ Auth::user()->name }}</strong><br>
                    {{ Auth::user()->phone }}<br>
                    <span style="background: #f45b0c; color: white; padding: 2px 8px; border-radius: 5px; font-size: 12px;">HOME</span>
                    Enyatganj, Hazaribagh, Dhaka - South, Dhaka
                </p>
            </div>

            {{-- Package Summary --}}
            <div class="card p-3">
                <h5>Package Details</h5>
                <div style="display: flex; gap: 15px;">
                    <img src="{{ asset('assets/images/' . $package->image) }}"
                         alt="{{ $package->title }}"
                         width="120" height="120"
                         style="object-fit: cover; border-radius: 6px;">
                    <div>
                        <h6>{{ $package->title }}</h6>
                        <p style="margin: 0;"><strong>৳{{ $package->price }}</strong></p>
                        <small>{{ $package->duration_day }} Days / {{ $package->duration_night }} Nights</small>
                    </div>
                </div>

                {{-- Order Form --}}
                <form action="{{ route('order.store') }}" method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $package->id }}">

                    <div class="form-group mb-2">
                        <label for="person_count">Number of Persons</label>
                        <input type="number"
                               name="person_count"
                               id="person_count"
                               class="form-control"
                               required min="1"
                               value="{{ $quantity }}"
                               oninput="updateSummary()">
                    </div>

                    <div class="form-group mb-3">
                        <label for="extra_package">Extra Package (optional)</label>
                        <input type="text"
                               name="extra_package"
                               id="extra_package"
                               class="form-control"
                               placeholder="e.g. Photography, Meal Plan">
                    </div>

                    <button type="submit" class="btn btn-success w-100">Proceed to Pay</button>
                </form>
            </div>
        </div>

        {{-- Right Side: Summary --}}
        <div style="flex: 1; min-width: 280px;">
            <div class="card p-3" style="border: 1px solid #ddd; border-radius: 10px;">
                <h5>Order Summary</h5>
                <hr>
                @php
                    $vat = $package->price * 0.15 * $quantity;
                    $total = ($package->price * $quantity) + $vat;
                @endphp
                <div style="display: flex; justify-content: space-between;">
                    <span>Package Price</span>
                    <span>৳{{ $package->price }} × {{ $quantity }}</span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span>VAT (15%)</span>
                    <span>৳{{ number_format($vat, 2) }}</span>
                </div>
                <hr>
                <div style="display: flex; justify-content: space-between; font-weight: bold;">
                    <span>Total</span>
                    <span id="totalPrice">৳{{ number_format($total, 2) }}</span>
                </div>
                <p class="text-muted" style="font-size: 12px;">VAT included</p>
            </div>
        </div>
    </div>
</div>

<script>
    const packagePrice = {{ $package->price }};
    const vatRate = 0.15;

    function updateSummary() {
        const persons = parseInt(document.getElementById('person_count').value) || 1;
        const vat = packagePrice * vatRate * persons;
        const total = (packagePrice * persons) + vat;
        document.getElementById('totalPrice').textContent = '৳' + total.toFixed(2);
    }

    // ✅ Auto-update summary on page load
    document.addEventListener("DOMContentLoaded", () => {
        updateSummary();
    });
</script>
@endsection
