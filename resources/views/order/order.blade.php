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
            <div class="card p-3" style="border: 1px solid #ddd; border-radius: 10px;">
                <h5>Package Details</h5>
                <div style="display: flex; gap: 15px;">
                    <img src="{{ asset($package->image) }}" alt="{{ $package->title }}" width="120" height="120" style="object-fit: cover; border-radius: 6px;">
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
                    <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="user_phone" value="{{ Auth::user()->phone }}">

                    <div class="form-group mb-2">
                        <label for="person_count">Number of Persons</label>
                        <input type="number" name="person_count" id="person_count" class="form-control" required min="1" value="1">
                    </div>

                    <div class="form-group mb-3">
                        <label for="extra_package">Extra Package (optional)</label>
                        <input type="text" name="extra_package" id="extra_package" class="form-control" placeholder="e.g. Photography, Meal Plan">
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
                <div style="display: flex; justify-content: space-between;">
                    <span>Package Price</span>
                    <span>৳{{ $package->price }}</span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span>Delivery Fee</span>
                    <span>৳60</span>
                </div>
                <hr>
                <div style="display: flex; justify-content: space-between; font-weight: bold;">
                    <span>Total</span>
                    <span>৳{{ $package->price + 60 }}</span>
                </div>
                <p class="text-muted" style="font-size: 12px;">VAT included, where applicable</p>
            </div>
        </div>
    </div>
</div>
@endsection
