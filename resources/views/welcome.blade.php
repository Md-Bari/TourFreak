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
                    @if(isset($package->duration_day) && isset($package->duration_night))
                        <p class="duration">
                            <strong>Duration:</strong>
                            {{ $package->duration_day }} Day{{ $package->duration_day > 1 ? 's' : '' }},
                            {{ $package->duration_night }} Night{{ $package->duration_night > 1 ? 's' : '' }}
                        </p>
                    @endif
                    <p class="price">Price Per Person: Starting Price <br><span>${{ number_format($package->price, 2) }}</span></p>
                    <button onclick="openPopup(
                '{{ addslashes($package->title) }}',
                '{{ addslashes($package->description) }}',
                '{{ number_format($package->price, 2) }}',
                '{{ asset($package->image) }}',
                '{{ $package->duration_day }}',
                '{{ $package->duration_night }}',
                '{{ $package->id }}'
            )">
                        Tour Details ➤
                    </button>

                </div>
        @endforeach
    </section>


    <!-- ===== Popup Modal ===== -->
    <div id="tourPopup" class="popup-overlay">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">×</span>
            <img id="popupImage" src="" alt="Tour Image"
                style="width:100%;max-width:400px;min-height:220px;max-height:260px;border-radius:12px;margin-bottom:18px;object-fit:cover;" />
            <h2 id="popupTitle">Tour Title</h2>
            <p id="popupDuration" style="font-weight:600;color:#0d6efd;margin-bottom:10px;"></p>
            <p id="popupDetails">Package details will appear here.</p>
            <a href="#" id="popupOrderBtn" class="btn btn-success">Order Now</a>
        </div>
    </div>


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
                        Our single room is the perfect choice for travellers seeking comfortable and convenient
                        accommodations. The room features a comfortable single bed, a desk and chair, and a private bathroom
                        with a shower.
                    </p>
                    <a href="{{ route('room.details', ['type' => 'single']) }}" class="btn btn-primary w-100">View
                        Details</a>
                </div>
            </div>

            <!-- Double Room -->
            <div class="col-md-6 col-lg-3">
                <div class="room-card">
                    <img src="/assets/images/d.jpg" alt="Double Room" class="room-img">
                    <h5 class="room-title">DOUBLE ROOM</h5>
                    <p class="room-price">start from <span class="price">$90</span></p>
                    <p class="room-description">
                        Our double room is perfect for couples or friends travelling together, featuring two comfortable
                        double beds, a desk and chair, and a private bathroom with a shower.
                    </p>
                    <a href="{{ route('room.details', ['type' => 'double']) }}" class="btn btn-primary w-100">View
                        Details</a>
                </div>
            </div>

            <!-- Family Room -->
            <div class="col-md-6 col-lg-3">
                <div class="room-card">
                    <img src="/assets/images/f.jpeg" alt="Family Room" class="room-img">
                    <h5 class="room-title">FAMILY ROOM</h5>
                    <p class="room-price">start from <span class="price">$160</span></p>
                    <p class="room-description">
                        Our family room is ideal for families, featuring two comfortable double beds, a sofa bed, a desk and
                        chair, and a private bathroom with a shower.
                    </p>
                    <a href="{{ route('room.details', ['type' => 'family']) }}" class="btn btn-primary w-100">View
                        Details</a>
                </div>
            </div>

            <!-- Apartment -->
            <div class="col-md-6 col-lg-3">
                <div class="room-card">
                    <img src="/assets/images/ap.jpg" alt="Apartment" class="room-img">
                    <h5 class="room-title">APARTMENT</h5>
                    <p class="room-price">start from <span class="price">$230</span></p>
                    <p class="room-description">
                        Our 2-bed apartment offers space and privacy, featuring two comfortable bedrooms, a double bed, and
                        plenty of storage space.
                    </p>
                    <a href="{{ route('room.details', ['type' => 'apartment']) }}" class="btn btn-primary w-100">View
                        Details</a>
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

        function openPopup(title, description, price, imageUrl, durationDay, durationNight, packageId) {
            document.getElementById('popupTitle').textContent = title;
            document.getElementById('popupDetails').textContent = description;
            document.getElementById('popupImage').src = imageUrl;
            document.getElementById('popupDuration').textContent = `${durationDay} Day(s), ${durationNight} Night(s)`;

            // Set the "Order Now" button href dynamically
            const orderBtn = document.getElementById('popupOrderBtn');
            orderBtn.href = `/order/${packageId}`;

            // Show the popup
            document.getElementById('tourPopup').style.display = 'block';
            document.getElementById('tourPopup').style.display = 'flex';
        }
        function closePopup() {
            document.getElementById('tourPopup').style.display = 'none';
        }
    </script>
@endpush
