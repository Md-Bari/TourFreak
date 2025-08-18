@extends('index')

@push('style')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
/* ===== Light Animated Background ===== */
body {
    background: linear-gradient(-45deg, #a3e2f2, #ede9fe, #cffafe, #facccc);
    background-size: 400% 400%;
    animation: gradientBG 3s ease infinite; /* faster animation */
}

@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* ===== Glassmorphic Container ===== */
.contact-container {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    max-width: 1000px;
    width: 100%;
    background: rgba(255, 255, 255, 0.35);
    backdrop-filter: blur(15px);
    border-radius: 2rem;
    border: 2px solid rgba(255, 255, 255, 0.6);
    padding: 2rem;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    animation: floatIn 0.6s ease forwards;
}

/* Floating animation */
@keyframes floatIn {
    0% { transform: translateY(-20px); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
}

/* Columns */
.contact-info, .contact-form {
    flex: 1 1 300px;
    min-width: 300px;
}

/* Gradient Text for Headings */
.gradient-text {
    background: linear-gradient(90deg, #4f46e5, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: 800;
    font-size: 1.75rem;
    margin-bottom: 1.5rem;
}

/* Contact details */
.contact-detail {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1.5rem;
}

.contact-detail i {
    font-size: 1.5rem;
    margin-right: 1rem;
    color: #8b5cf6;
    flex-shrink: 0;
}

.contact-detail p {
    margin: 0;
    color: #1e3a8a;
    font-weight: 600;
}

.contact-detail p.font-semibold {
    font-weight: 700;
    color: #4f46e5;
}

/* Labels & Inputs */
.contact-form label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 700;
    color: #1e3a8a;
}

.contact-form input,
.contact-form textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    border-radius: 1rem;
    border: 2px solid rgba(30, 30, 50, 0.3);
    background: rgba(255, 255, 255, 0.5);
    color: #1e3a8a;
    margin-bottom: 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    backdrop-filter: blur(8px);
}

.contact-form input::placeholder,
.contact-form textarea::placeholder {
    color: rgba(30, 30, 50, 0.7);
    font-weight: 500;
}

.contact-form input:focus,
.contact-form textarea:focus {
    outline: none;
    border-color: #4f46e5;
    box-shadow: 0 0 12px rgba(79, 70, 229, 0.5);
    background: rgba(255, 255, 255, 0.6);
}

/* Submit button */
.contact-form button {
    padding: 0.75rem 2rem;
    border-radius: 1rem;
    border: none;
    font-weight: 700;
    color: white;
    background: linear-gradient(90deg, #4f46e5, #8b5cf6);
    cursor: pointer;
    transition: transform 0.3s, box-shadow 0.3s;
}

.contact-form button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(99, 102, 241, 0.5);
}

/* Responsive */
@media (max-width: 768px) {
    .contact-container {
        flex-direction: column;
    }
}
</style>
@endpush

@section('content')
<div class="py-10 px-4 mt-5 mb-5 d-flex justify-content-center">
    <div class="contact-container">

        <!-- Left Column: Office Info -->
        <div class="contact-info">
            <h2 class="gradient-text">Contact Details</h2>
            <div class="contact-detail">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <p class="font-semibold">Location</p>
                    <p>Daffodil International University, Dhaka, Bangladesh</p>
                    <!-- Mini Google Map -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.357097003469!2d90.37990711539996!3d23.78058039464961!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c3d52eeaa0e3%3A0x36a6de5d49bffda0!2sDaffodil%20International%20University!5e0!3m2!1sen!2sbd!4v1690000000000!5m2!1sen!2sbd"
                        width="100%" height="180" style="border:0; border-radius:12px;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="contact-detail">
                <i class="fas fa-phone-alt"></i>
                <div>
                    <p class="font-semibold">Phone</p>
                    <p>+880 1739842346</p>
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
            <h2 class="gradient-text">Contact Form</h2>
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
