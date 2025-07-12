@extends('index')

@push('style')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
<section class="hero">
    <div class="booking-container">
        <div class="tab-buttons">
            <button class="tab-btn active" onclick="showTab('flight', event)">✈️ Flight</button>
            <button class="tab-btn" onclick="showTab('bus', event)">🚌 Bus</button>
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
function showTab(tab, event) {
    document.getElementById('flight').style.display = (tab === 'flight') ? 'flex' : 'none';
    document.getElementById('bus').style.display = (tab === 'bus') ? 'flex' : 'none';

    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
}

// Slideshow
const backgrounds = [
    "/assets/images/beach.jpg",
    "/assets/images/bangladesh.jpeg",
    "/assets/images/sajek.jpeg"
];
let current = 0;
setInterval(() => {
    current = (current + 1) % backgrounds.length;
    document.querySelector(".hero").style.backgroundImage = `url('${backgrounds[current]}')`;
}, 5000);

</script>
@endsection
