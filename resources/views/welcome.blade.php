@extends('index')

@push('style')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/room.css') }}">
@endpush

@section('content')
<section class="hero">
    <div class="booking-container">
        <div class="tab-buttons">
            <button class="tab-btn" onclick="showTab('tour',event)">🏞️ Tour</button>
            <button class="tab-btn active" onclick="showTab('flight', event)">✈️ Flight</button>
            <button class="tab-btn" onclick="showTab('bus', event)">🚌 Bus</button>

        </div>
        <!-- Tour Page -->

        <form id="bus" class="booking-form horizontal-booking" action="{{ route('tour.search') }}" method="GET" style="display: none;">
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

        <!-- Flight Booking -->
        <form id="flight" class="booking-form horizontal-booking" action="{{ route('flight.search') }}" method="GET">
            @csrf
            <label class="radio-group">
                <input type="radio" name="trip_type" value="one_way" checked> One Way
            </label>
            <label class="radio-group">
                <input type="radio" name="trip_type" value="round"> Round Trip
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
<div class="Upper-package">
    <h1> Packages Around Bangladesh</h1>
</div>
<section class="tour-packages">

    <div class="package">
        <img src="/assets/images/sundorban.jpg" alt="Sundarbans Forest">
        <h2>Journey To Sundarbans Forest</h2>
        <p class="features">Features: <span>6 Days & 5 Nights / Adventure / Road & Boat Trip / Sightseeing</span></p>
        <p class="description">Journey to Sundarban is full of exciting & adventurous safari. Sundarban is the world's largest mangrove forest and a UNESCO World Heritage Site.</p>
        <p class="price">Price Per Person: Starting Price <br><span>$1,500.00</span></p>
        <button>Tour Details ➤</button>
    </div>

    <div class="package">
        <img src="/assets/images/kaptai.jpg" alt="Hill Districts & Sea Beach">
        <h2>Hill Districts & World’s Longest Sea Beach</h2>
        <p class="features">Features: <span>11 Days & 10 Nights / Road Trip / Sightseeing</span></p>
        <p class="description">Rangamati and Bandarban hill districts including Cox’s Bazar the World's Longest Sea beach is the best tourist attraction in Bangladesh.</p>
        <p class="price">Price Per Person: Starting Price <br><span>$2,200.00</span></p>
        <button>Tour Details ➤</button>
    </div>

    <div class="package">
        <img src="/assets/images/cbazar.jpg" alt="Cox’s Bazar Sea Beach">
        <h2>World’s Longest Sea Beach</h2>
        <p class="features">Features: <span>8 Days & 7 Nights / Road Trip / Sightseeing</span></p>
        <p class="description">World Longest Sea Beach 100 k.m. long sea beach is Cox’s Bazar, one of the most attractive tourist spots in the world, enjoy moon boats and sea fishing.</p>
        <p class="price">Price Per Person: Starting Price <br><span>$1,800.00</span></p>
        <button>Tour Details ➤</button>
    </div>
    <div class="package">
        <img src="/assets/images/sundorban.jpg" alt="Sundarbans Forest">
        <h2>Journey To Sundarbans Forest</h2>
        <p class="features">Features: <span>6 Days & 5 Nights / Adventure / Road & Boat Trip / Sightseeing</span></p>
        <p class="description">Journey to Sundarban is full of exciting & adventurous safari. Sundarban is the world's largest mangrove forest and a UNESCO World Heritage Site.</p>
        <p class="price">Price Per Person: Starting Price <br><span>$1,500.00</span></p>
        <button>Tour Details ➤</button>
    </div>

    <div class="package">
        <img src="/assets/images/kaptai.jpg" alt="Hill Districts & Sea Beach">
        <h2>Hill Districts & World’s Longest Sea Beach</h2>
        <p class="features">Features: <span>11 Days & 10 Nights / Road Trip / Sightseeing</span></p>
        <p class="description">Rangamati and Bandarban hill districts including Cox’s Bazar the World's Longest Sea beach is the best tourist attraction in Bangladesh.</p>
        <p class="price">Price Per Person: Starting Price <br><span>$2,200.00</span></p>
        <button>Tour Details ➤</button>
    </div>

    <div class="package">
        <img src="/assets/images/cbazar.jpg" alt="Cox’s Bazar Sea Beach">
        <h2>World’s Longest Sea Beach</h2>
        <p class="features">Features: <span>8 Days & 7 Nights / Road Trip / Sightseeing</span></p>
        <p class="description">World Longest Sea Beach 100 k.m. long sea beach is Cox’s Bazar, one of the most attractive tourist spots in the world, enjoy moon boats and sea fishing.</p>
        <p class="price">Price Per Person: Starting Price <br><span>$1,800.00</span></p>
        <button>Tour Details ➤</button>
    </div>
    <div class="package">
        <img src="/assets/images/sundorban.jpg" alt="Sundarbans Forest">
        <h2>Journey To Sundarbans Forest</h2>
        <p class="features">Features: <span>6 Days & 5 Nights / Adventure / Road & Boat Trip / Sightseeing</span></p>
        <p class="description">Journey to Sundarban is full of exciting & adventurous safari. Sundarban is the world's largest mangrove forest and a UNESCO World Heritage Site.</p>
        <p class="price">Price Per Person: Starting Price <br><span>$1,500.00</span></p>
        <button>Tour Details ➤</button>
    </div>

    <div class="package">
        <img src="/assets/images/kaptai.jpg" alt="Hill Districts & Sea Beach">
        <h2>Hill Districts & World’s Longest Sea Beach</h2>
        <p class="features">Features: <span>11 Days & 10 Nights / Road Trip / Sightseeing</span></p>
        <p class="description">Rangamati and Bandarban hill districts including Cox’s Bazar the World's Longest Sea beach is the best tourist attraction in Bangladesh.</p>
        <p class="price">Price Per Person: Starting Price <br><span>$2,200.00</span></p>
        <button>Tour Details ➤</button>
    </div>

    <div class="package">
        <img src="/assets/images/cbazar.jpg" alt="Cox’s Bazar Sea Beach">
        <h2>World’s Longest Sea Beach</h2>
        <p class="features">Features: <span>8 Days & 7 Nights / Road Trip / Sightseeing</span></p>
        <p class="description">World Longest Sea Beach 100 k.m. long sea beach is Cox’s Bazar, one of the most attractive tourist spots in the world, enjoy moon boats and sea fishing.</p>
        <p class="price">Price Per Person: Starting Price <br><span>$1,800.00</span></p>
        <button>Tour Details ➤</button>
    </div>
</section>
<div class="Upper-package">
    <h1> Hotels In Bangladesh</h1>
</div>
<section class="container py-5">
    <div class="row g-4">
        <!-- Single Room -->
        <div class="col-md-6 col-lg-3">
            <div class="room-card">
                <img src="/assets/images/s.jpg" alt="Single Room" class="room-img">
                <h5 class="room-title">SINGLE ROOM</h5>
                <p class="room-price">start from <span class="price">$110</span></p>
                <p class="room-description">
                    Our single room is the perfect choice for travellers seeking comfortable and convenient accommodations. The room features a comfortable single bed, a desk and chair, and a private bathroom with a shower.
                </p>
                <a href="#" class="btn btn-primary w-100">View Details</a>
            </div>
        </div>

        <!-- Double Room -->
        <div class="col-md-6 col-lg-3">
            <div class="room-card">
                <img src="/assets/images/d.jpg" alt="Double Room" class="room-img">
                <h5 class="room-title">DOUBLE ROOM</h5>
                <p class="room-price">start from <span class="price">$90</span></p>
                <p class="room-description">
                    Our double room is perfect for couples or friends travelling together, featuring two comfortable double beds, a desk and chair, and a private bathroom with a shower.
                </p>
                <a href="#" class="btn btn-primary w-100">View Details</a>
            </div>
        </div>

        <!-- Family Room -->
        <div class="col-md-6 col-lg-3">
            <div class="room-card">
                <img src="/assets/images/f.jpeg" alt="Family Room" class="room-img">
                <h5 class="room-title">FAMILY ROOM</h5>
                <p class="room-price">start from <span class="price">$160</span></p>
                <p class="room-description">
                    Our family room is ideal for families, featuring two comfortable double beds, a sofa bed, a desk and chair, and a private bathroom with a shower.
                </p>
                <a href="#" class="btn btn-primary w-100">View Details</a>
            </div>
        </div>

        <!-- Apartment -->
        <div class="col-md-6 col-lg-3">
            <div class="room-card">
                <img src="/assets/images/ap.jpg" alt="Apartment" class="room-img">
                <h5 class="room-title">APARTMENT</h5>
                <p class="room-price">start from <span class="price">$230</span></p>
                <p class="room-description">
                    Our 2-bed apartment offers space and privacy, featuring two comfortable bedrooms, a double bed, and plenty of storage space.
                </p>
                <a href="#" class="btn btn-primary w-100">View Details</a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('script')
<script>
    function showTab(tab, event) {
        document.getElementById('flight').style.display = (tab === 'flight') ? 'flex' : 'none';
        document.getElementById('bus').style.display = (tab === 'bus') ? 'flex' : 'none';
        document.getElementById('tour').style.display = (tab === 'tour') ? 'flex' : 'none';

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
