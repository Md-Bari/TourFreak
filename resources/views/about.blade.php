@extends('index')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <style>
        /* ================= UNIFORM STYLING ================= */
        .stats {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            width: 150px;
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-item h3 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: #0d6efd;
        }

        .stat-item p {
            font-size: 0.9rem;
            color: #333;
        }

        .team {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
        }

        .team-member {
            width: 220px;
            /* uniform width */
            text-align: center;
            flex: 1 1 220px;
            /* allows wrapping on smaller screens */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .team-member img {
            width: 200px;
            /* uniform width */
            height: 200px;
            /* uniform height */
            object-fit: cover;
            border-radius: 50%;
            /* circular images */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            transition: transform 0.3s ease;
        }

        .team-member img:hover {
            transform: scale(1.05);
        }

        .team-member h5 {
            font-size: 1rem;
            margin-bottom: 0.3rem;
        }

        .team-member p {
            font-size: 0.9rem;
            color: #555;
        }

        /* ================= HERO ================= */
        .about-hero {
            background: linear-gradient(120deg, #4facfe, #00f2fe, #ff6a88, #ff99ac);
            background-size: 300% 300%;
            animation: gradientBG 15s ease infinite;
            color: #fff;
            text-align: center;
            padding: 100px 20px;
            position: relative;
        }

        .about-hero-content {
            max-width: 800px;
            margin: auto;
        }

        .about-hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .about-hero p {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* ================= BUTTON ================= */
        .btn-primary,
        .btn-success {
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover,
        .btn-success:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 768px) {
            .team-member {
                flex: 1 1 150px;
                width: 150px;
            }

            .team-member img {
                width: 150px;
                height: 150px;
            }

            .stat-item {
                width: 120px;
            }

            .about-hero h1 {
                font-size: 2rem;
            }

            .about-hero p {
                font-size: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <section class="about-hero">
        <div class="about-hero-content">
            <h1>About Us</h1>
            <p>TourFreak is a trusted travel partner that makes planning simple and reliable. The platform combines
                end-to-end trip planning with curated experiences and personalized support, so you can book with confidence
                and focus on the journey. From quick getaways to complex itineraries, TourFreak helps turn every trip into a
                memorable one.</p>
        </div>
    </section>



    <section class="container py-5 text-center">
        <h2 class="mb-4">Meet the Team Members</h2>
        <div class="team">
            <div class="team-member">
                <img src="{{ asset('assets/images/shitol.jpg') }}" alt="Team Member 2">
                <h5>MD. Rofiqul Bari</h5>
                <p>221-15-5598</p>
            </div>
            <br>
            <div class="team-member">
                <img src="{{ asset('assets/images/diya.jpg') }}" alt="Team Member 3">
                <h5>Jannatul Ferdaus</h5>
                <p>221-15-4982</p>
            </div>
            <div class="team-member">
                <img src="{{ asset('assets/images/abir.jpg') }}" alt="Team Member 1">
                <h5>Abir Hassan</h5>
                <p>221-15-5121</p>
            </div>


            <div class="team-member">
                <img src="{{ asset('assets/images/mim.jpeg') }}" alt="Team Member 4">
                <h5>Mim Khan</h5>
                <p>221-15-5924</p>
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
        <h2 class="mb-4">Our Mission</h2>
        <p>We aim to turn your travel dreams into reality by offering affordable, reliable, and inspiring solutions tailored
            to your preferences. Whether you’re seeking adventure or a peaceful retreat, we design personalized itineraries
            and provide attentive support so you can travel with confidence.</p>
    </section>

    <section class="container py-5 text-center">
        <h2 class="mb-4">Our Core Values</h2>
        <p>We believe in trust, innovation, and excellence. Our team is committed to creating travel experiences that
            reflect our passion for discovery and customer satisfaction.</p>
    </section>
    <section class="container py-5 text-center">
        <h2 class="mb-4">Ready to Explore?</h2>
        <p>Join us and start planning your next adventure with Tour Freak today.</p>
        <a href="{{ route('contact') }}" class="btn btn-primary mt-3">Contact Us</a>
    </section>
@endsection
