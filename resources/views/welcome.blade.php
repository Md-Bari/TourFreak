@extends('index')

@section('title', 'TourFreak Home')

@push('style')
<style>
    .home-shell {
        display: grid;
        gap: 34px;
    }

    .agency-hero {
        position: relative;
        min-height: 720px;
        padding: 34px;
        border-radius: 34px;
        overflow: hidden;
        background:
            linear-gradient(180deg, rgba(8, 15, 36, 0.2), rgba(8, 15, 36, 0.55)),
            url("{{ asset('assets/images/beach.jpg') }}") center/cover no-repeat;
        box-shadow: 0 30px 80px rgba(16, 24, 40, 0.12);
    }

    .agency-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(13, 27, 62, 0.1), rgba(13, 27, 62, 0.55));
    }

    .hero-nav-glass {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 10px 18px;
        border-radius: 22px;
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: #fff;
    }

    .hero-nav-links {
        display: flex;
        align-items: center;
        gap: 18px;
        font-size: 0.88rem;
        font-weight: 700;
    }

    .hero-nav-links a {
        color: rgba(255, 255, 255, 0.86);
    }

    .hero-nav-links a:hover {
        color: #fff;
    }

    .hero-contact {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.84rem;
        font-weight: 700;
    }

    .hero-headline {
        position: relative;
        z-index: 1;
        max-width: 720px;
        margin: 110px auto 0;
        text-align: center;
        color: #fff;
    }

    .hero-headline .eyebrow {
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 14px;
    }

    .hero-headline h1 {
        margin: 0 0 16px;
        font-size: clamp(3rem, 6vw, 5.2rem);
        line-height: 0.95;
        font-weight: 800;
        letter-spacing: -0.07em;
    }

    .hero-headline p {
        max-width: 600px;
        margin: 0 auto;
        color: rgba(255, 255, 255, 0.84);
        font-size: 1rem;
        line-height: 1.8;
    }

    .booking-panel {
        position: absolute;
        left: 50%;
        bottom: 36px;
        transform: translateX(-50%);
        z-index: 2;
        width: min(1120px, calc(100% - 42px));
        padding: 18px;
        border-radius: 28px;
        background: #fff;
        box-shadow: 0 28px 70px rgba(16, 24, 40, 0.18);
    }

    .booking-tabs {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 14px;
    }

    .booking-tab {
        border: 0;
        padding: 10px 16px;
        border-radius: 999px;
        background: #eef4ff;
        color: #1858d8;
        font-size: 0.82rem;
        font-weight: 800;
    }

    .booking-tab.active {
        background: linear-gradient(135deg, #1677ff, #1aa7ec);
        color: #fff;
    }

    .booking-content {
        display: none;
    }

    .booking-content.active {
        display: block;
    }

    .booking-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr)) 154px;
        gap: 12px;
        align-items: end;
    }

    .booking-field {
        padding: 14px 16px;
        border-radius: 18px;
        border: 1px solid rgba(15, 23, 42, 0.08);
        background: #fff;
    }

    .booking-field label {
        display: block;
        margin-bottom: 6px;
        color: #98a2b3;
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .booking-field .form-control,
    .booking-field .form-select {
        padding: 0;
        border: 0;
        background: transparent;
        box-shadow: none;
        font-size: 0.92rem;
        font-weight: 700;
        color: #111827;
    }

    .booking-submit {
        height: 56px;
        border-radius: 18px;
        font-weight: 800;
    }

    .booking-helper {
        margin-top: 12px;
        color: #98a2b3;
        font-size: 0.8rem;
    }

    .highlights-strip {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-top: 18px;
    }

    .highlight-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 18px;
        border-radius: 22px;
        color: #fff;
    }

    .highlight-card i {
        width: 44px;
        height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.18);
    }

    .highlight-card strong {
        display: block;
        font-size: 0.95rem;
    }

    .highlight-card span {
        color: rgba(255, 255, 255, 0.82);
        font-size: 0.78rem;
    }

    .highlight-card.blue {
        background: linear-gradient(135deg, #1677ff, #1aa7ec);
    }

    .highlight-card.green {
        background: linear-gradient(135deg, #0e9f6e, #22c55e);
    }

    .highlight-card.dark {
        background: linear-gradient(135deg, #111827, #334155);
    }

    .brand-trust {
        padding: 30px 36px;
        border-radius: 30px;
        background: rgba(255, 255, 255, 0.82);
        border: 1px solid rgba(15, 23, 42, 0.08);
        box-shadow: 0 24px 60px rgba(16, 24, 40, 0.07);
        text-align: center;
    }

    .brand-trust p {
        margin: 0 0 20px;
        color: var(--text-soft);
    }

    .brand-logos {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 12px;
    }

    .brand-logo {
        padding: 14px 12px;
        border-radius: 18px;
        background: #fff;
        border: 1px solid rgba(15, 23, 42, 0.06);
        color: #64748b;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-size: 0.76rem;
    }

    .section-block {
        display: grid;
        gap: 20px;
    }

    .section-head {
        text-align: center;
        max-width: 760px;
        margin: 0 auto;
    }

    .section-head h2 {
        margin: 0;
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        letter-spacing: -0.05em;
    }

    .section-head p {
        margin: 10px 0 0;
        color: var(--text-soft);
        line-height: 1.8;
    }

    .offers-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .offer-banner {
        position: relative;
        min-height: 190px;
        padding: 20px;
        border-radius: 26px;
        overflow: hidden;
        color: #fff;
        box-shadow: 0 20px 50px rgba(16, 24, 40, 0.12);
    }

    .offer-banner::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(15, 23, 42, 0.04), rgba(15, 23, 42, 0.5));
    }

    .offer-banner > * {
        position: relative;
        z-index: 1;
    }

    .offer-banner.blue {
        background:
            linear-gradient(135deg, rgba(22, 119, 255, 0.4), rgba(26, 167, 236, 0.2)),
            url("{{ asset('assets/images/beach.jpg') }}") center/cover no-repeat;
    }

    .offer-banner.orange {
        background:
            linear-gradient(135deg, rgba(255, 183, 3, 0.4), rgba(249, 115, 22, 0.25)),
            url("{{ asset('assets/images/beach.jpg') }}") center/cover no-repeat;
    }

    .offer-banner.green {
        background:
            linear-gradient(135deg, rgba(16, 185, 129, 0.42), rgba(34, 197, 94, 0.25)),
            url("{{ asset('assets/images/beach.jpg') }}") center/cover no-repeat;
    }

    .offer-banner .pill {
        display: inline-block;
        margin-bottom: 14px;
        padding: 7px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.18);
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .offer-banner h3 {
        margin: 0 0 8px;
        font-size: 1.5rem;
        font-weight: 800;
    }

    .offer-banner .price {
        font-size: 1.9rem;
        font-weight: 800;
        letter-spacing: -0.05em;
    }

    .feature-points {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .feature-box {
        padding: 22px;
        border-radius: 26px;
        box-shadow: 0 22px 50px rgba(16, 24, 40, 0.07);
    }

    .feature-box i {
        width: 52px;
        height: 52px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.55);
        color: #0f172a;
        font-size: 1.15rem;
    }

    .feature-box h4 {
        margin: 0 0 8px;
        font-size: 1.2rem;
        font-weight: 800;
    }

    .feature-box p {
        margin: 0;
        color: #334155;
        line-height: 1.7;
    }

    .feature-box.mint {
        background: #c7f9cc;
    }

    .feature-box.sky {
        background: #dbeafe;
    }

    .feature-box.sun {
        background: #fef08a;
    }

    .package-grid,
    .room-grid,
    .review-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
        gap: 22px;
    }

    .travel-card {
        border-radius: 28px;
        overflow: hidden;
        background: #fff;
        border: 1px solid rgba(15, 23, 42, 0.08);
        box-shadow: 0 22px 50px rgba(16, 24, 40, 0.08);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .travel-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 28px 60px rgba(16, 24, 40, 0.12);
    }

    .travel-card-image-wrap {
        position: relative;
    }

    .travel-card-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
    }

    .travel-card-badge {
        position: absolute;
        top: 16px;
        left: 16px;
        padding: 8px 12px;
        border-radius: 999px;
        background: #ff4d4f;
        color: #fff;
        font-size: 0.74rem;
        font-weight: 800;
    }

    .travel-card-body {
        padding: 20px;
    }

    .travel-card-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 14px 0 16px;
    }

    .travel-card-meta span {
        padding: 8px 12px;
        border-radius: 999px;
        background: #f3f6fc;
        color: #42526b;
        font-size: 0.78rem;
        font-weight: 700;
    }

    .travel-card h4 {
        margin: 0 0 8px;
        font-size: 1.22rem;
        font-weight: 800;
    }

    .travel-card p {
        margin: 0;
        color: var(--text-soft);
        line-height: 1.7;
    }

    .travel-card-footer {
        display: flex;
        align-items: end;
        justify-content: space-between;
        gap: 12px;
        margin-top: 16px;
    }

    .travel-price {
        font-size: 1.8rem;
        font-weight: 800;
        letter-spacing: -0.05em;
        color: #111827;
    }

    .travel-price small {
        display: block;
        margin-bottom: 4px;
        color: var(--text-soft);
        font-size: 0.74rem;
        letter-spacing: 0;
    }

    .destination-mosaic {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr 0.9fr;
        gap: 18px;
    }

    .destination-card {
        position: relative;
        min-height: 240px;
        border-radius: 28px;
        overflow: hidden;
        color: #fff;
        box-shadow: 0 22px 50px rgba(16, 24, 40, 0.1);
    }

    .destination-card.tall {
        min-height: 500px;
    }

    .destination-card::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(15, 23, 42, 0.08), rgba(15, 23, 42, 0.55));
    }

    .destination-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .destination-card .label {
        position: absolute;
        left: 24px;
        bottom: 22px;
        z-index: 1;
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: -0.05em;
    }

    .destination-stack {
        display: grid;
        gap: 18px;
    }

    .review-card-home {
        padding: 24px;
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.94);
        border: 1px solid rgba(15, 23, 42, 0.08);
        box-shadow: 0 18px 38px rgba(15, 23, 42, 0.06);
    }

    .review-card-home .stars {
        color: #ffb703;
        letter-spacing: 0.08em;
        font-weight: 700;
    }

    .review-card-home small {
        color: var(--text-soft);
    }

    .modal-content {
        border-radius: 24px;
        overflow: hidden;
        border: 0;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.18);
    }

    .modal-header {
        background: linear-gradient(135deg, #111827, #1677ff);
        color: #fff;
    }

    .popup-content {
        background: #fff;
        color: #162032;
        border-radius: 24px;
        max-width: 560px;
    }

    @media (max-width: 1199.98px) {
        .booking-grid,
        .brand-logos,
        .offers-grid,
        .feature-points,
        .highlights-strip,
        .destination-mosaic {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .destination-card.tall {
            min-height: 280px;
        }
    }

    @media (max-width: 991.98px) {
        .agency-hero {
            min-height: auto;
            padding: 22px 20px 340px;
        }

        .hero-headline {
            margin-top: 70px;
        }

        .hero-nav-links,
        .hero-contact {
            display: none;
        }

        .booking-panel {
            bottom: 24px;
            width: calc(100% - 30px);
        }

        .booking-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 767.98px) {
        .agency-hero,
        .booking-panel,
        .brand-trust,
        .travel-card,
        .review-card-home,
        .destination-card {
            border-radius: 24px;
        }

        .agency-hero {
            padding: 16px 14px 22px;
        }

        .hero-headline {
            margin: 42px auto 0;
        }

        .hero-headline h1 {
            font-size: 2.5rem;
        }

        .booking-panel {
            position: static;
            transform: none;
            width: 100%;
            margin-top: 24px;
        }

        .booking-grid,
        .brand-logos,
        .offers-grid,
        .feature-points,
        .highlights-strip,
        .destination-mosaic {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="page-shell home-shell">
    <section class="agency-hero">
        <div class="hero-nav-glass">
            <div class="hero-nav-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('room') }}">Destination</a>
                <a href="{{ route('facilities') }}">Travel Package</a>
                <a href="{{ route('about') }}">Visa</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>
            <div class="hero-contact">
                <span><i class="fas fa-phone me-2"></i>+880 1345 533 865</span>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
                @endguest
            </div>
        </div>

        <div class="hero-headline">
            <span class="eyebrow">All-in-one travel booking</span>
            <h1>Plan your trip, your way.</h1>
            <p>Premium travel agency styling with a brighter hero, floating booking form, trusted highlights, and cleaner sections for tours, hotels, and destination inspiration.</p>
        </div>

        <div class="booking-panel">
            <div class="booking-tabs">
                <button class="booking-tab active" type="button" data-tab-target="tour">
                    <i class="fas fa-earth-asia me-2"></i>Tours
                </button>
                <button class="booking-tab" type="button" data-tab-target="bus">
                    <i class="fas fa-bus me-2"></i>Bus
                </button>
                <button class="booking-tab" type="button" onclick="showFullTourForm()">
                    <i class="fas fa-wand-magic-sparkles me-2"></i>Custom
                </button>
            </div>

            <div id="tour" class="booking-content active">
                <form action="{{ route('tour.search') }}" method="GET">
                    <div class="booking-grid">
                        <div class="booking-field">
                            <label>Destination</label>
                            <select name="class" class="form-select" required>
                                <option value="">Bali Paradise</option>
                                <option value="mountain">Mountain</option>
                                <option value="sea">Sea</option>
                                <option value="forest">Forest</option>
                                <option value="normal">Normal</option>
                            </select>
                        </div>
                        <div class="booking-field">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control">
                        </div>
                        <div class="booking-field">
                            <label>Category</label>
                            <select name="preference" class="form-select">
                                <option value="">Family Tour</option>
                                <option value="adventure">Adventure</option>
                                <option value="relax">Relaxation</option>
                                <option value="culture">Culture</option>
                            </select>
                        </div>
                        <div class="booking-field">
                            <label>Travelers</label>
                            <input type="number" name="travelers" class="form-control" min="1" value="1" required>
                        </div>
                        <button type="submit" class="btn btn-primary booking-submit">Search</button>
                    </div>
                </form>
            </div>

            <div id="bus" class="booking-content">
                <form action="{{ route('bus.search') }}" method="GET">
                    <div class="booking-grid">
                        <div class="booking-field">
                            <label>From</label>
                            <input type="text" name="start" class="form-control" placeholder="Dhaka" required>
                        </div>
                        <div class="booking-field">
                            <label>To</label>
                            <input type="text" name="end" class="form-control" placeholder="Cox's Bazar" required>
                        </div>
                        <div class="booking-field">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <div class="booking-field">
                            <label>Seat Type</label>
                            <select class="form-select">
                                <option>AC</option>
                                <option>Business</option>
                                <option>Standard</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary booking-submit">Search</button>
                    </div>
                </form>
            </div>

            <p class="booking-helper">Can't find what you're looking for? Create your own itinerary with the custom search flow.</p>

            <div class="highlights-strip">
                <div class="highlight-card blue">
                    <i class="fab fa-tripadvisor"></i>
                    <div>
                        <strong>Tripadvisor Inspired</strong>
                        <span>Highly rated, agency-style booking flow.</span>
                    </div>
                </div>
                <div class="highlight-card green">
                    <i class="fas fa-ban"></i>
                    <div>
                        <strong>Easy Cancellation</strong>
                        <span>Flexible booking and smooth rescheduling.</span>
                    </div>
                </div>
                <div class="highlight-card dark">
                    <i class="fas fa-shield-heart"></i>
                    <div>
                        <strong>Secure & Safe</strong>
                        <span>Trusted payment and verified travel support.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="brand-trust">
        <p>These company you can easily trust</p>
        <div class="brand-logos">
            <div class="brand-logo">Traverse</div>
            <div class="brand-logo">TripZone</div>
            <div class="brand-logo">MoveLite</div>
            <div class="brand-logo">GoTrip</div>
            <div class="brand-logo">Travel Hub</div>
            <div class="brand-logo">AirGo</div>
        </div>
    </section>

    <section class="section-block">
        <div class="section-head">
            <span class="eyebrow">Discounts & offers</span>
            <h2>Special offers that look like a real travel agency homepage.</h2>
            <p>The layout now follows the visual rhythm from your references: bold banners, cleaner spacing, strong white surfaces, and blue-accented booking actions.</p>
        </div>

        <div class="offers-grid">
            <article class="offer-banner blue">
                <span class="pill">Island Escape</span>
                <h3>Bali Paradise</h3>
                <p>Total price</p>
                <div class="price">$299.00</div>
            </article>
            <article class="offer-banner orange">
                <span class="pill">Summer Special</span>
                <h3>Egypt Package</h3>
                <p>Limited time deal</p>
                <div class="price">$399.00</div>
            </article>
            <article class="offer-banner green">
                <span class="pill">Premium Relax</span>
                <h3>Maldives Stay</h3>
                <p>Beachfront experience</p>
                <div class="price">$599.00</div>
            </article>
        </div>
    </section>

    <section class="section-block">
        <div class="feature-points">
            <article class="feature-box mint">
                <i class="fas fa-bolt"></i>
                <h4>One Click Booking</h4>
                <p>Search, compare, and reserve tours and rooms from a cleaner, more premium homepage flow.</p>
            </article>
            <article class="feature-box sky">
                <i class="fas fa-tags"></i>
                <h4>Discount & Offers</h4>
                <p>Bring attention to deals with colorful cards and stronger contrast like the examples you shared.</p>
            </article>
            <article class="feature-box sun">
                <i class="fas fa-map-location-dot"></i>
                <h4>Local Expertise</h4>
                <p>Highlight support, guidance, and curated routes so the page feels more like a full agency brand.</p>
            </article>
        </div>
    </section>

    <section class="section-block">
        <div class="section-head">
            <span class="eyebrow">Popular package</span>
            <h2>Featured destinations and curated tour packages.</h2>
            <p>Existing package data is now shown inside brighter, more travel-template-style cards with clearer badges and pricing.</p>
        </div>

        <div class="package-grid">
            @foreach($packages as $package)
                <article class="travel-card">
                    <div class="travel-card-image-wrap">
                        <img class="travel-card-image" src="{{ asset('assets/images/' . $package->image) }}" alt="{{ $package->title }}">
                        <span class="travel-card-badge">Hot Sale</span>
                    </div>
                    <div class="travel-card-body">
                        <h4>{{ $package->title }}</h4>
                        <p>{{ \Illuminate\Support\Str::limit($package->description, 110) }}</p>

                        <div class="travel-card-meta">
                            <span>{{ ucfirst($package->class ?? 'Tour') }}</span>
                            @if(isset($package->duration_day))
                                <span>{{ $package->duration_day }} Day{{ $package->duration_day > 1 ? 's' : '' }}</span>
                            @endif
                            @if(isset($package->duration_night))
                                <span>{{ $package->duration_night }} Night{{ $package->duration_night > 1 ? 's' : '' }}</span>
                            @endif
                        </div>

                        <div class="travel-card-footer">
                            <div class="travel-price">
                                <small>Per person from</small>
                                ${{ number_format($package->price, 2) }}
                            </div>
                            <button
                                class="btn btn-primary"
                                type="button"
                                onclick="openPopup('{{ addslashes($package->title) }}','{{ addslashes($package->description) }}','{{ number_format($package->price, 2) }}','{{ asset(str_replace('\\', '/', ('assets/images/' . $package->image))) }}','{{ $package->duration_day }}','{{ $package->duration_night }}','{{ $package->id }}')">
                                Book now
                            </button>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="section-block">
        <div class="section-head">
            <span class="eyebrow">Popular activities place</span>
            <h2>Destination visuals with a stronger agency-style layout.</h2>
            <p>This section follows the tiled image feel from your examples instead of plain repeated cards.</p>
        </div>

        <div class="destination-mosaic">
            <article class="destination-card tall">
                <img src="{{ asset('assets/images/beach.jpg') }}" alt="Bangladesh beach">
                <div class="label">Cox's Bazar</div>
            </article>
            <div class="destination-stack">
                <article class="destination-card">
                    <img src="{{ asset('assets/images/beach.jpg') }}" alt="Sajek">
                    <div class="label">Sajek</div>
                </article>
                <article class="destination-card">
                    <img src="{{ asset('assets/images/beach.jpg') }}" alt="Sylhet">
                    <div class="label">Sylhet</div>
                </article>
            </div>
            <div class="destination-stack">
                <article class="destination-card">
                    <img src="{{ asset('assets/images/beach.jpg') }}" alt="Bandarban">
                    <div class="label">Bandarban</div>
                </article>
                <article class="destination-card">
                    <img src="{{ asset('assets/images/beach.jpg') }}" alt="Sundarbans">
                    <div class="label">Sundarbans</div>
                </article>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="section-head">
            <span class="eyebrow">Hotel & resort</span>
            <h2>Beautiful stays for modern travelers.</h2>
            <p>The room section also follows the brighter premium card language so the homepage stays visually consistent.</p>
        </div>

        <div class="room-grid">
            @forelse ($rooms as $room)
                <article class="travel-card">
                    <div class="travel-card-image-wrap">
                        <img class="travel-card-image" src="{{ asset('assets/images/' . $room->image) }}" alt="{{ $room->title }}">
                        <span class="travel-card-badge" style="background:#1677ff;">Top Hotel</span>
                    </div>
                    <div class="travel-card-body">
                        <h4>{{ strtoupper($room->title) }}</h4>
                        <p>{{ \Illuminate\Support\Str::limit($room->description, 110) }}</p>

                        <div class="travel-card-footer">
                            <div class="travel-price">
                                <small>Starting from</small>
                                ${{ number_format($room->price, 2) }}
                            </div>
                            <a href="{{ route('room.show', $room->id) }}" class="btn btn-dark">View details</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <i class="fas fa-hotel"></i>
                    <h5>No rooms available right now</h5>
                    <p class="muted-text mb-0">New room listings will appear here soon.</p>
                </div>
            @endforelse
        </div>
    </section>

    <section class="section-block">
        <div class="section-head">
            <span class="eyebrow">Guest voices</span>
            <h2>What travelers are saying.</h2>
            <p>Reviews now sit inside softer cards with clearer spacing so the bottom of the homepage still feels premium.</p>
        </div>

        <div class="d-flex justify-content-center">
            @auth
                <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#reviewModal">Give your review</button>
            @endauth
        </div>

        <div class="review-grid">
            @php $hasReviews = false; @endphp
            @foreach ($packages as $package)
                @foreach ($package->reviews as $review)
                    @php $hasReviews = true; @endphp
                    <article class="review-card-home">
                        <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                            <div>
                                <h5 class="mb-1">{{ $review->user->name ?? 'Guest' }}</h5>
                                <small>{{ $package->title }}</small>
                            </div>
                            <div class="stars">
                                {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                            </div>
                        </div>
                        <p class="mb-3">{{ $review->comment }}</p>
                        <small>{{ $review->created_at->format('d M, Y') }}</small>
                    </article>
                @endforeach
            @endforeach

            @if(! $hasReviews)
                <div class="empty-state">
                    <i class="fas fa-star"></i>
                    <h5>No reviews yet</h5>
                    <p class="muted-text mb-0">Customer feedback will appear here once reviews are submitted.</p>
                </div>
            @endif
        </div>

        @guest
            <p class="text-center text-muted mb-0">Please <a href="{{ route('login') }}">login</a> to write a review.</p>
        @endguest
    </section>
</div>

<div id="fullTourPopup" class="popup-overlay">
    <div class="popup-content">
        <span class="close-btn" onclick="closeFullTourForm()">&times;</span>
        <h3>Specific Tour Plan</h3>
        <form action="{{ route('tour.search') }}" method="GET">
            <div class="mb-3">
                <label class="form-label">Tour Location</label>
                <select name="class" class="form-select" required>
                    <option value="">Select tour class</option>
                    <option value="mountain">Mountain</option>
                    <option value="sea">Sea</option>
                    <option value="forest">Forest</option>
                    <option value="normal">Normal</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Number of Days</label>
                <input type="number" name="days" class="form-control" min="1" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Number of Travelers</label>
                <input type="number" name="travelers" class="form-control" min="1" value="1" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Preferences</label>
                <select name="preference" class="form-select">
                    <option value="">Any preference</option>
                    <option value="adventure">Adventure</option>
                    <option value="relax">Relaxation</option>
                    <option value="culture">Culture</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Maximum Budget</label>
                <input type="number" name="budget_max" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-dark w-100">Search Tours</button>
        </form>
    </div>
</div>

<div id="tourPopup" class="popup-overlay">
    <div class="popup-content">
        <span class="close-btn" onclick="closePopup()">&times;</span>
        <img id="popupImage" src="" alt="Tour Image" style="width:100%;max-width:100%;height:260px;border-radius:18px;margin-bottom:18px;object-fit:cover;" />
        <h2 id="popupTitle">Tour Title</h2>
        <p id="popupDuration" style="font-weight:600;color:#1677ff;margin-bottom:10px;"></p>
        <p id="popupDetails">Package details will appear here.</p>
        <div class="mb-3">
            <label for="travelerQuantity" class="form-label">Number of Travelers</label>
            <input type="number" id="travelerQuantity" value="1" min="1" class="form-control" oninput="updateTotalPrice()" />
        </div>
        <p><strong>Total Price: $<span id="totalPrice">0.00</span></strong></p>
        <a href="#" id="popupOrderBtn" class="btn btn-primary">Order Now</a>
    </div>
</div>

<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Write a Review</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('review.submit') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="package_id" class="form-label">Select Tour Package</label>
                        <select name="package_id" id="package_id" class="form-select" required>
                            <option value="">Choose Package</option>
                            @foreach ($packages as $package)
                                <option value="{{ $package->id }}">{{ $package->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="">Rate this package</option>
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Submit Review</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@push('script')
<script>
    let packagePrice = 0;
    let packageId = 0;

    document.querySelectorAll('[data-tab-target]').forEach((button) => {
        button.addEventListener('click', () => {
            const target = button.getAttribute('data-tab-target');

            document.querySelectorAll('.booking-tab').forEach((btn) => btn.classList.remove('active'));
            document.querySelectorAll('.booking-content').forEach((tab) => tab.classList.remove('active'));

            button.classList.add('active');
            document.getElementById(target).classList.add('active');
        });
    });

    function openPopup(title, description, price, imageUrl, durationDay, durationNight, id) {
        document.getElementById('popupTitle').textContent = title;
        document.getElementById('popupDetails').textContent = description;
        document.getElementById('popupImage').src = imageUrl;
        document.getElementById('popupDuration').textContent = `${durationDay} Day(s), ${durationNight} Night(s)`;

        packagePrice = parseFloat(price);
        packageId = id;
        document.getElementById('travelerQuantity').value = 1;
        updateTotalPrice();
        document.getElementById('tourPopup').style.display = 'flex';
        document.getElementById('popupOrderBtn').href = `/order/${id}?quantity=1`;
    }

    function updateTotalPrice() {
        const qty = parseInt(document.getElementById('travelerQuantity').value) || 1;
        const total = (packagePrice * qty).toFixed(2);
        document.getElementById('totalPrice').textContent = total;
        document.getElementById('popupOrderBtn').href = `/order/${packageId}?quantity=${qty}`;
    }

    function closePopup() {
        document.getElementById('tourPopup').style.display = 'none';
    }

    function showFullTourForm() {
        document.getElementById('fullTourPopup').style.display = 'flex';
    }

    function closeFullTourForm() {
        document.getElementById('fullTourPopup').style.display = 'none';
    }

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Thank you!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: '{{ session('error') }}',
        });
    @endif
</script>
@endpush
