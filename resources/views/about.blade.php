@extends('index')

@push('style')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
<style>
    .stats {
        display: flex;
        justify-content: center;
        gap: 3rem;
        margin-top: 2rem;
    }

    .stat-item {
        text-align: center;
    }

    .team {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 2rem;
    }

    .team-member {
        width: 200px;
        text-align: center;
    }

    .team-member img {
        width: 100%;
        border-radius: 100px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
</style>
@endpush

@section('content')
<section class="about-hero">
    <div class="about-hero-content">
        <h1>About Us</h1>
        <p>Tour Freak is your go-to travel companion, dedicated to making your journeys unforgettable with seamless planning, unique experiences, and personalized travel services you can trust.</p>
    </div>
</section>

<section class="container py-5 text-center">
    <h2 class="mb-4">Our Mission</h2>
    <p>We aim to transform your travel dreams into reality by providing affordable, reliable, and exciting travel solutions tailored to your preferences. Whether you seek adventure, relaxation, or exploration, we are here to craft the perfect journey for you.</p>
</section>

<section class="container py-5 text-center">
    <h2 class="mb-4">Our Core Values</h2>
    <p>We believe in trust, innovation, and excellence. Our team is committed to creating travel experiences that reflect our passion for discovery and customer satisfaction.</p>
</section>

<section class="container py-5 text-center">
    <h2 class="mb-4">Meet the Team Members</h2>
    <div class="team">
        <div class="team-member">
            <img src="{{ asset('images/bg-img.jpg') }}" alt="Team Member 1">
            <h5>Abir Hassan</h5>
            <p></p>
        </div>
        <div class="team-member">
            <img src="{{ asset('images/team2.jpg') }}" alt="Team Member 2">
            <h5>MD.Rofiqul Bari</h5>
            <p></p>
        </div>
        <div class="team-member">
            <img src="{{ asset('images/team3.jpg') }}" alt="Team Member 3">
            <h5>Jannatul Ferdaus</h5>
            <p></p>
        </div>
        <div class="team-member">
            <img src="{{ asset('images/team3.jpg') }}" alt="Team Member 4">
            <h5>Mim Khan</h5>
            <p></p>
        </div>
    </div>
</section>

<section class="container py-5 text-center">
    <h2 class="mb-4">Our Achievements</h2>
    <div class="stats">
        <div class="stat-item">
            <h3>10K+</h3>
            <p>Happy Travelers</p>
        </div>
        <div class="stat-item">
            <h3>50+</h3>
            <p>Destinations</p>
        </div>
        <div class="stat-item">
            <h3>500+</h3>
            <p>Trips Planned</p>
        </div>
    </div>
</section>

<section class="container py-5 text-center">
    <h2 class="mb-4">Ready to Explore?</h2>
    <p>Join us and start planning your next adventure with Tour Freak today.</p>
    <a href="{{ route('contact') }}" class="btn btn-primary mt-3">Contact Us</a>
</section>
@endsection
