@extends('index')

@push('style')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@section('content')
<div class="py-10 px-4 mt-5 mb-5 d-flex justify-content-center">
    <div class="contact-container">

        <!-- Left Column: Office Info -->
        <div class="contact-info">
            <h2>Contact Details</h2>
            <div class="contact-detail">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <p class="font-semibold">Location</p>
                    <p>123 Main Street, Dhaka, Bangladesh</p>
                </div>
            </div>
            <div class="contact-detail">
                <i class="fas fa-phone-alt"></i>
                <div>
                    <p class="font-semibold">Phone</p>
                    <p>+880 123 456 789</p>
                </div>
            </div>
            <div class="contact-detail">
                <i class="fas fa-clock"></i>
                <div>
                    <p class="font-semibold">Hours</p>
                    <p>Mon–Fri: 9AM–5PM</p>
                </div>
            </div>
        </div>

        <!-- Right Column: Contact Form -->
        <div class="contact-form">
            <h2>Contact Form</h2>
            <form method="POST" action="{{ route('contact.submit') }}">
                @csrf
                <div>
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Your name" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" required>
                </div>
                <div>
                    <label for="message">Comment or message</label>
                    <textarea id="message" name="message" rows="4" placeholder="Your message..." required></textarea>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>

    </div>
</div>
@endsection
