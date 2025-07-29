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
            <form action="{{ route('tour.search') }}" method="GET">
                <select name="class" required>
                    <option value="">-- Select Tour Class --</option>
                    <option value="mountain">Mountain</option>
                    <option value="sea">Sea</option>
                    <option value="normal">Normal</option>
                </select>
                <button type="submit">Search</button>
            </form>


            <form id="bus" class="booking-form horizontal-booking" action="{{ route('tour.search') }}" method="GET"
                style="display: none;">
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
            <form id="bus" class="booking-form horizontal-booking" action="{{ route('bus.search') }}" method="GET"
                style="display: none;">
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
        @foreach($packages as $package)
            <div class="package">
                <img src="{{ asset($package->image) }}" alt="{{ $package->title }}" width="300">
                <h2>{{ $package->title }}</h2>
                <p class="features">Features: <span>{{ $package->features }}</span></p>
                <p class="description">{{ $package->description }}</p>
                <p class="price">Price Per Person: Starting Price <br><span>${{ number_format($package->price, 2) }}</span></p>
                <button onclick="openPopup('{{ $package->title }}')">Tour Details ➤</button>
            </div>
        @endforeach
    </section>


    <!-- ===== Popup Modal ===== -->
    <div id="tourPopup" class="popup-overlay">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">×</span>
            <h2 id="popupTitle">Tour Title</h2>
            <p id="popupDetails">Package details will appear here.</p>
            <a href="order.html" class="order-btn">Order Now</a>
        </div>
    </div>

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
                <a href="{{ route('room.details', ['type' => 'single']) }}" class="btn btn-primary w-100">View Details</a>
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
                <a href="{{ route('room.details', ['type' => 'double']) }}" class="btn btn-primary w-100">View Details</a>
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
                <a href="{{ route('room.details', ['type' => 'family']) }}" class="btn btn-primary w-100">View Details</a>
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
                <a href="{{ route('room.details', ['type' => 'apartment']) }}" class="btn btn-primary w-100">View Details</a>
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

        // const backgrounds = [
        //     "/assets/images/beach.jpg",
        //     "/assets/images/bangladesh.jpeg",
        //     "/assets/images/sajek.jpeg"
        // ];
        let current = 0;
        setInterval(() => {
            current = (current + 1) % backgrounds.length;
            document.querySelector(".hero").style.backgroundImage = `url('${backgrounds[current]}')`;
        }, 5000);

        function openPopup(packageName) {
            const details = {
                'Sundarbans': {
                    title: 'Journey To Sundarbans Forest',
                    description: '6 Days & 5 Nights / Adventure / Road & Boat Trip / Sightseeing<br><br>Journey to Sundarban is full of exciting & adventurous safari. Sundarban is the world\'s largest mangrove forest and a UNESCO World Heritage Site.<br><br>Price Per Person: $1,500.00'
                },
                'Hill': {
                    title: 'Hill Districts & Sea Beach',
                    description: '11 Days & 10 Nights / Road Trip / Sightseeing<br><br>Rangamati and Bandarban hill districts including Cox’s Bazar the World\'s Longest Sea beach is the best tourist attraction in Bangladesh.<br><br>Price Per Person: $2,200.00'
                },
                'CoxsBazar': {
                    title: 'World’s Longest Sea Beach',
                    description: '8 Days & 7 Nights / Road Trip / Sightseeing<br><br>Enjoy the 100 km long sandy beach, moon boats, sea fishing, and relaxing sunsets.<br><br>Price Per Person: $1,800.00'
                }
            };

            const popup = document.getElementById('tourPopup');
            const data = details[packageName];

            if (data) {
                document.getElementById('popupTitle').innerHTML = data.title;
                document.getElementById('popupDetails').innerHTML = data.description;
                popup.style.display = 'block';
            }
        }

        function closePopup() {
            document.getElementById('tourPopup').style.display = 'none';
        }
    </script>
@endpush
