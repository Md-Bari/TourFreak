@extends('index')

@section('title', 'User Dashboard')
@section('page_title', 'Your Dashboard')

@section('content')
<div class="page-shell">
    <section class="hero-panel">
        <div>
            <span class="eyebrow">Account overview</span>
            <h2>Welcome back, {{ Auth::user()->name }}.</h2>
            <p>Track your trips, bookings, saved items, and account activity from one simple dashboard built for everyday travelers.</p>
            <div class="hero-actions mt-4">
                <a href="{{ route('my.bookings') }}" class="btn btn-dark">View Bookings</a>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-dark">Edit Profile</a>
            </div>
        </div>
        <div class="hero-orb">
            <span class="eyebrow text-white">Member since</span>
            <strong>{{ Auth::user()->created_at->format('Y') }}</strong>
            <p class="mb-0 text-white-50">Enjoy cleaner access to travel plans, alerts, and account settings.</p>
        </div>
    </section>

    <section class="stats-grid">
        <article class="stats-card">
            <div class="stats-icon"><i class="fas fa-suitcase-rolling"></i></div>
            <h3>{{ $tourBookingsCount }}</h3>
            <p>Tour package bookings</p>
        </article>
        <article class="stats-card">
            <div class="stats-icon"><i class="fas fa-bed"></i></div>
            <h3>{{ $roomBookingsCount }}</h3>
            <p>Room reservations</p>
        </article>
        <article class="stats-card">
            <div class="stats-icon"><i class="fas fa-bus"></i></div>
            <h3>{{ $busBookingsCount }}</h3>
            <p>Bus tickets booked</p>
        </article>
        <article class="stats-card">
            <div class="stats-icon"><i class="fas fa-bell"></i></div>
            <h3>{{ $unreadNotificationsCount }}</h3>
            <p>Unread notifications</p>
        </article>
    </section>

    <section class="content-grid">
        <div class="content-card">
            <div class="section-heading">
                <div>
                    <span class="eyebrow">Latest activity</span>
                    <h3>Recent Tour Bookings</h3>
                </div>
                <a href="{{ route('my.bookings') }}" class="btn btn-sm btn-outline-dark">See all</a>
            </div>

            @if($recentBookings->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-map"></i>
                    <h5>No bookings yet</h5>
                    <p class="muted-text mb-3">When you book a package, your latest trips will appear here.</p>
                    <a href="{{ route('home') }}" class="btn btn-dark">Start Exploring</a>
                </div>
            @else
                <div class="booking-list">
                    @foreach($recentBookings as $booking)
                        <article class="booking-card">
                            <div class="booking-card-header">
                                <div>
                                    <h5 class="mb-1">{{ $booking->package->title ?? 'Travel Package' }}</h5>
                                    <p class="muted-text mb-0">Booked on {{ $booking->created_at->format('d M, Y') }}</p>
                                </div>
                                <span class="status-pill {{ strtolower($booking->status) === 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                            <div class="booking-meta">
                                <span>{{ number_format($booking->amount, 2) }} {{ $booking->currency }}</span>
                                <span>{{ $booking->transaction_id }}</span>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="content-card">
            <div class="section-heading">
                <div>
                    <span class="eyebrow">Profile snapshot</span>
                    <h4>Account Details</h4>
                </div>
            </div>

            <div class="info-list">
                <div class="info-row-card">
                    <span class="meta-label">Full Name</span>
                    <span class="meta-value">{{ Auth::user()->name }}</span>
                </div>
                <div class="info-row-card">
                    <span class="meta-label">Email</span>
                    <span class="meta-value">{{ Auth::user()->email }}</span>
                </div>
                <div class="info-row-card">
                    <span class="meta-label">Phone</span>
                    <span class="meta-value">{{ Auth::user()->phone ?: 'Not provided yet' }}</span>
                </div>
            </div>

            @if($recentRooms->isNotEmpty())
                <div class="section-heading mt-4 mb-3">
                    <h4>Recent Room Stays</h4>
                </div>
                <div class="booking-list">
                    @foreach($recentRooms as $roomBooking)
                        <article class="booking-card">
                            <div class="booking-card-header">
                                <div>
                                    <h6 class="mb-1">{{ $roomBooking->room->title ?? 'Room Booking' }}</h6>
                                    <p class="muted-text mb-0">{{ $roomBooking->check_in }} to {{ $roomBooking->check_out }}</p>
                                </div>
                                <span class="status-pill warning">{{ ucfirst($roomBooking->status ?? 'pending') }}</span>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
