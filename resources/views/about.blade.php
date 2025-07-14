@extends('index')

@push('style')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
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
@endsection