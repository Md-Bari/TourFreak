@extends('index')

@push('style')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<style>
  body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f1f5f9;
  }

  .hero {
    background: url('/assets/images/beach.jpg') no-repeat center center/cover;
    padding: 3rem;
    text-align: center;
    color: white;
  }

  .booking-container {
    background: rgba(255, 255, 255, 0.9);
    padding: 1rem;
    border-radius: 8px;
    display: inline-block;
  }

  .tab-buttons {
    display: flex;
    justify-content: center;
    margin-bottom: 1rem;
  }

  .tab-btn {
    padding: 0.5rem 1rem;
    border: none;
    background-color: #ddd;
    margin: 0 5px;
    cursor: pointer;
    border-radius: 5px;
  }

  .tab-btn.active {
    background-color: #ffc107;
    font-weight: bold;
  }

  .booking-form {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
  }

  .booking-form input,
  .booking-form select,
  .booking-form button {
    padding: 0.5rem;
    border-radius: 5px;
    border: 1px solid #ccc;
  }

  .search-btn {
    background: #ffc107;
    font-weight: bold;
    cursor: pointer;
  }
</style>
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
@endsection

@push('script')
<script>
function showTab(tab, event) {
  document.getElementById('flight').style.display = (tab === 'flight') ? 'flex' : 'none';
  document.getElementById('bus').style.display = (tab === 'bus') ? 'flex' : 'none';

  document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
  event.target.classList.add('active');
}

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
@endpush
