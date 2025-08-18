@extends('index')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/room.css') }}">
@endpush

@section('content')

    <section class="hero">
        <div class="booking-container">
            <div class="tab-buttons">
                <button class="tab-btn active" onclick="showTab('tour',event)">🏞️ Tour</button>
                <button class="tab-btn" onclick="showTab('flight', event)">✈️ Flight</button>
                <button class="tab-btn" onclick="showTab('bus', event)">🚌 Bus</button>
            </div>

            <!-- =================== Tour Search Minimized =================== -->
            <div id="tour" class="tab-content">
                <div class="tour-search-card">
                    <form action="{{ route('tour.search') }}" method="GET" class="tour-form">
                        <h3>Quick Tour Search</h3>

                        <!-- Location only -->
                        <div class="form-group">
                            <label>Tour Location</label>
                            <select name="class" class="form-control" required>
                                <option value="">-- Select Tour Class --</option>
                                <option value="mountain">Mountain</option>
                                <option value="sea">Sea</option>
                                <option value="normal">Normal</option>
                            </select>
                        </div>

                        <!-- Show full form button -->
                        <button type="button" class="btn btn-secondary w-100" onclick="showFullTourForm()">
                            Want a more specific tour plan?
                        </button>
                        <button type="submit" class="btn btn-primary w-100 mt-2">Quick Search</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- =================== Full Tour Form Popup =================== -->
    <div id="fullTourPopup" class="popup-overlay" style="display:none;">
        <div class="popup-content">
            <span class="close-btn" onclick="closeFullTourForm()">×</span>
            <h3>Specific Tour Plan</h3>
            <form action="{{ route('tour.search') }}" method="GET" class="tour-form-popup">
                @csrf
                <!-- Location -->
                <div class="form-group">
                    <label>Tour Location</label>
                    <select name="class" class="form-control" required>
                        <option value="">-- Select Tour Class --</option>
                        <option value="mountain">Mountain</option>
                        <option value="sea">Sea</option>
                        <option value="normal">Normal</option>
                    </select>
                </div>

                <!-- Number of Days -->
                <div class="form-group">
                    <label>Number of Days</label>
                    <input type="number" name="days" class="form-control" min="1" placeholder="How many days?" required>
                </div>

                <!-- Number of Travelers -->
                <div class="form-group">
                    <label>Number of Travelers</label>
                    <input type="number" name="travelers" class="form-control" min="1" value="1" required>
                </div>

                <!-- Preferences -->
                <div class="form-group">
                    <label>Preferences</label>
                    <select name="preference" class="form-control">
                        <option value="">-- Any Preference --</option>
                        <option value="adventure">Adventure</option>
                        <option value="relax">Relaxation</option>
                        <option value="culture">Culture</option>
                    </select>
                </div>

                <!-- Budget (highest range only) -->
                <div class="form-group">
                    <label>Maximum Budget ($)</label>
                    <input type="number" name="budget_max" class="form-control" placeholder="Enter highest budget only"
                        required>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-2">Search Tours</button>
            </form>
        </div>
    </div>
    <div class="Upper-package">
        <h1> Packages Around Bangladesh</h1>
    </div>

    <section class="tour-packages-wrapper">
        <div class="tour-scroll-wrapper">
            <div class="tour-packages">
                @foreach($packages as $package)
                    <div class="package">
                        <img src="{{ asset('assets/images/' . $package->image) }}" alt="{{ $package->title }}">
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

                        <p class="price">
                            Price Per Person: <br>
                            <span>${{ number_format($package->price, 2) }}</span>
                        </p>

                        <button onclick="openPopup(
                                                                            '{{ addslashes($package->title) }}',
                                                                            '{{ addslashes($package->description) }}',
                                                                            '{{ number_format($package->price, 2) }}',
                                                                            '{{ asset(str_replace('\\', '/', ('assets/images/' . $package->image))) }}',
                                                                            '{{ $package->duration_day }}',
                                                                            '{{ $package->duration_night }}',
                                                                            '{{ $package->id }}'
                                                                        )">
                            Tour Details ➤
                        </button>

                    </div>
                @endforeach
            </div>
        </div>
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

            <!-- Quantity Selection -->
            <div style="margin:10px 0;">
                <label for="travelerQuantity">Number of Travelers:</label>
                <input type="number" id="travelerQuantity" value="1" min="1" style="width:60px; margin-left:5px;"
                    oninput="updateTotalPrice()" />
            </div>

            <p><strong>Total Price: $<span id="totalPrice">0.00</span></strong></p>

            <a href="#" id="popupOrderBtn" class="btn btn-success">Order Now</a>
        </div>
    </div>


    {{-- Dynamic Rooms Section --}}
    <div class="Upper-package">
        <h1> Hotels In Bangladesh</h1>
    </div>

    {{-- Dynamic Rooms Section --}}
    <section class="container py-5">
        <div class="row g-4">
            @forelse ($rooms as $room)
                <div class="col-md-6 col-lg-3">
                    <div class="room-card">
                        <img src="{{ asset('assets/images/' . $room->image) }}" alt="{{ $room->image }}" class="room-img">
                        <h5 class="room-title">{{ strtoupper($room->title) }}</h5>
                        <p class="room-price">start from <span class="price">${{ $room->price }}</span></p>
                        <p class="room-description">
                            {{ Str::limit($room->description, 150) }}
                        </p>
                        <a href="{{ route('room.show', $room->id) }}" class="btn btn-primary w-100">
                            View Details ➤
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">No rooms available at the moment.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- ===== Room Popup Modal ===== -->
    <div id="roomPopup" class="popup-overlay">
        <div class="popup-content">
            <span class="close-btn" onclick="closeRoomPopup()">×</span>
            <img id="roomPopupImage" src="" alt="Room Image"
                style="width:100%;max-width:400px;min-height:220px;max-height:260px;border-radius:12px;margin-bottom:18px;object-fit:cover;" />
            <h2 id="roomPopupTitle">Room Title</h2>
            <p id="roomPopupDetails">Room details will appear here.</p>
            <p id="roomPopupPrice" style="font-weight:600;color:#0d6efd;margin-bottom:10px;"></p>
            <a href="#" id="popupOrderBtn" class="btn btn-success">Order Now</a>
        </div>
    </div>
    {{-- ========== Review Section ========== --}}
    <div class="Upper-package">
        <h1> Customer Reviews</h1>
    </div>

    <section class="container py-4">
        @foreach ($packages as $package)
            @if ($package->reviews->count())
                <div class="mb-5">
                    <h3 class="mb-3">{{ $package->title }}</h3>
                    @foreach ($package->reviews as $review)
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $review->user->name ?? 'Guest' }}
                                    <span class="text-warning">
                                        {!! str_repeat('★', $review->rating) !!}
                                        {!! str_repeat('☆', 5 - $review->rating) !!}
                                    </span>
                                </h5>
                                <p class="card-text">{{ $review->comment }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach

        @auth
            {{-- ===== Review Form ===== --}}
            <div class="review-card-wrapper">
                <div class="card review-card">
                    <div class="card-header">Write a Review</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('review.submit') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="package_id" class="form-label">Select Tour Package</label>
                                <select name="package_id" id="package_id" class="form-select" required>
                                    <option value="">-- Choose Package --</option>
                                    @foreach ($packages as $package)
                                        <option value="{{ $package->id }}">{{ $package->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating</label>
                                <select name="rating" id="rating" class="form-select" required>
                                    <option value="">-- Rate --</option>
                                    @for ($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment</label>
                                <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary submit-btn">Submit Review</button>
                        </form>
                    </div>
                </div>

        @else
                <p class="text-center mt-4">Please <a href="{{ route('login') }}">login</a> to write a review.</p>
            @endauth
        </div>


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

            let packagePrice = 0;
            let packageId = 0;

            function openPopup(title, description, price, imageUrl, durationDay, durationNight, id) {
                document.getElementById('popupTitle').textContent = title;
                document.getElementById('popupDetails').textContent = description;
                document.getElementById('popupImage').src = imageUrl;
                document.getElementById('popupDuration').textContent = `${durationDay} Day(s), ${durationNight} Night(s)`;

                // Set package price and ID for calculation & order
                packagePrice = parseFloat(price);
                packageId = id;

                // Reset quantity and total price
                document.getElementById('travelerQuantity').value = 1;
                updateTotalPrice();

                document.getElementById('tourPopup').style.display = 'flex';

                // Update Order link
                document.getElementById('popupOrderBtn').href = `/order/${id}?quantity=1`;
            }

            function updateTotalPrice() {
                const qty = parseInt(document.getElementById('travelerQuantity').value) || 1;
                const total = (packagePrice * qty).toFixed(2);
                document.getElementById('totalPrice').textContent = total;

                // Update order link with selected quantity
                document.getElementById('popupOrderBtn').href = `/order/${packageId}?quantity=${qty}`;
            }

            function closePopup() {
                document.getElementById('tourPopup').style.display = 'none';
            }
            function openRoomPopup(title, description, price, imageUrl) {
                document.getElementById('roomPopupTitle').textContent = title;
                document.getElementById('roomPopupDetails').textContent = description;
                document.getElementById('roomPopupPrice').textContent = `Price: $${price}`;
                document.getElementById('roomPopupImage').src = imageUrl;
                document.getElementById('roomPopup').style.display = 'flex';
                document.getElementById('popupOrderBtn').href = `/order/${packageId}`;
            }

            function closeRoomPopup() {
                document.getElementById('roomPopup').style.display = 'none';
            }
            function showTab(tab, event) {
                document.getElementById('flight').style.display = (tab === 'flight') ? 'flex' : 'none';
                document.getElementById('bus').style.display = (tab === 'bus') ? 'flex' : 'none';
                document.getElementById('tour').style.display = (tab === 'tour') ? 'block' : 'none';
                document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
                event.target.classList.add('active');
            }

            // Show full tour popup
            function showFullTourForm() {
                document.getElementById('fullTourPopup').style.display = 'flex';
            }
            function closeFullTourForm() {
                document.getElementById('fullTourPopup').style.display = 'none';
            }
        </script>
    @endpush
