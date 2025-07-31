@extends('index')

@push('style')
<style>
    .order-container {
        max-width: 600px;
        margin: 40px auto;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        padding: 2.5rem 2rem;
    }
    .order-summary {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    .order-summary img {
        width: 100%;
        max-width: 320px;
        border-radius: 10px;
        margin-bottom: 1rem;
    }
    .order-label {
        font-weight: 600;
        color: #0d6efd;
    }
    .total-row {
        font-size: 1.2rem;
        font-weight: 700;
        color: #198754;
    }
    .payment-methods label {
        margin-right: 1.5rem;
        font-weight: 500;
    }
</style>
@endpush

@section('content')
<div class="order-container">
    <h2 class="mb-4 fw-bold text-center">Order Summary</h2>
    {{-- Assume $package is passed from controller --}}
    <div class="order-summary text-center">
        <img src="{{ asset($package->image) }}" alt="{{ $package->title }}">
        <h4>{{ $package->title }}</h4>
        <p><span class="order-label">Features:</span> {{ $package->features }}</p>
        <p><span class="order-label">Description:</span> {{ $package->description }}</p>
        <p>
            <span class="order-label">Duration:</span>
            {{ $package->duration_day }} Day{{ $package->duration_day > 1 ? 's' : '' }},
            {{ $package->duration_night }} Night{{ $package->duration_night > 1 ? 's' : '' }}
        </p>
        <p><span class="order-label">Base Price:</span> $<span id="basePrice">{{ number_format($package->price, 2) }}</span> per person</p>
    </div>

    <form method="POST" action="{{ route('order.place', $package->id) }}">
        @csrf
        <div class="mb-3">
            <label for="people" class="form-label">Number of People</label>
            <input type="number" id="people" name="people" class="form-control" value="1" min="1" max="20" required onchange="calculateTotal()">
        </div>
        <div class="mb-3">
            <label class="form-label">Payment Method</label>
            <div class="payment-methods">
                <label><input type="radio" name="payment_method" value="card" checked> Credit/Debit Card</label>
                <label><input type="radio" name="payment_method" value="bkash"> bKash</label>
                <label><input type="radio" name="payment_method" value="cash"> Cash</label>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">VAT (5%):</label>
            <span id="vatAmount">$0.00</span>
        </div>
        <div class="mb-3">
            <label class="form-label">Tax (2%):</label>
            <span id="taxAmount">$0.00</span>
        </div>
        <div class="mb-3 total-row">
            <label class="form-label">Total Price:</label>
            <span id="totalPrice">${{ number_format($package->price, 2) }}</span>
        </div>
        <button type="submit" class="btn btn-success w-100">Place Order</button>
    </form>
</div>

@push('script')
<script>
    function calculateTotal() {
        let base = parseFloat(document.getElementById('basePrice').innerText.replace(/,/g, ''));
        let people = parseInt(document.getElementById('people').value) || 1;
        let subtotal = base * people;
        let vat = subtotal * 0.05;
        let tax = subtotal * 0.02;
        let total = subtotal + vat + tax;
        document.getElementById('vatAmount').innerText = '$' + vat.toFixed(2);
        document.getElementById('taxAmount').innerText = '$' + tax.toFixed(2);
        document.getElementById('totalPrice').innerText = '$' + total.toFixed(2);
    }
    document.addEventListener('DOMContentLoaded', calculateTotal);
</script>
@endpush
@endsection