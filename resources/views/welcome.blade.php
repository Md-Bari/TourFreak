@extends('index')

@push('style')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<style>
.hero {
    height: 100vh;
    background-image: url("/assets/images/beach.jpg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
</style>

@endpush

@section('content')
<section class="hero">
    <div class="booking-container">
        <div class="tab-buttons">
            <button class="tab-btn active" onclick="showTab('flight')">✈️ Flight</button>
            <button class="tab-btn" onclick="showTab('bus')">🚌 Bus</button>
        </div>

        <!-- Flight Booking -->
        <form id="flight" class="booking-form horizontal-booking" action="{{ route('flight.search') }}" method="GET">
            @csrf
            <label class="radio-group">
                <input type="radio" name="trip_type" value="one_way" checked> One Way
            </label>
            <label class="radio-group">
                <input type="radio" name="trip_type" value="round"> Round Way
            </label>
            <label class="radio-group">
                <input type="radio" name="trip_type" value="multi"> Multi City
            </label>

            <input type="text" name="from" placeholder="From: Dhaka" required>
            <input type="text" name="to" placeholder="To: Cox's Bazar" required>
            <input type="date" name="journey_date" value="2025-07-15" required>
            <input type="date" name="return_date" placeholder="Return Date">

            <select name="traveler_class" required>
                <option value="1">1 Traveler, Economy</option>
                <option value="2">2 Travelers, Business</option>
            </select>

            <button type="submit" class="search-btn">Search</button>
        </form>

        <!-- Bus Booking -->
        <form id="bus" class="booking-form horizontal-booking" action="{{ route('bus.search') }}" method="GET" style="display: none;">
            @csrf
            <input type="text" name="from" placeholder="From: Dhaka" required>
            <input type="text" name="to" placeholder="To: Chittagong" required>
            <input type="date" name="journey_date" required>

            <select name="seat_class" required>
                <option value="AC">AC</option>
                <option value="Non-AC">Non-AC</option>
            </select>

            <button type="submit" class="search-btn">Search</button>
        </form>
    </div>
</section>

<script>
function showTab(tab) {
    document.getElementById('flight').style.display = (tab === 'flight') ? 'flex' : 'none';
    document.getElementById('bus').style.display = (tab === 'bus') ? 'flex' : 'none';

    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
}
</script>
@endsection
