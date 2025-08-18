@extends('index')

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
/* ===== Animated Background ===== */
body {
    background: linear-gradient(-45deg, #fef3c7, #ede9fe, #cffafe, #fee2e2);
    background-size: 400% 400%;
    animation: gradientBG 10s ease infinite;
}

@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* ===== Glassmorphic Card ===== */
.form-card {
    background: rgba(255, 255, 255, 0.35);
    backdrop-filter: blur(15px);
    border-radius: 2rem;
    padding: 2.5rem 3rem;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    border: 1.5px solid rgba(255, 255, 255, 0.4);
    max-width: 800px;
    margin: auto;
    transition: transform 0.5s ease, box-shadow 0.5s ease;
}

.form-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
}

/* ===== Profile Header ===== */
.profile-header {
    display: flex;
    align-items: center;
    gap: 2rem;
    margin-bottom: 2rem;
}

.profile-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4f46e5, #8b5cf6, #ec4899);
    background-size: 400% 400%;
    animation: gradientBG 8s ease infinite;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    font-weight: 800;
    color: white;
    box-shadow: 0 0 15px rgba(139, 92, 246, 0.6), 0 0 30px rgba(236, 72, 153, 0.4);
}

.profile-info h2 {
    font-size: 2rem;
    font-weight: 800;
    color: #1f2937;
    margin-bottom: 0.3rem;
}

.profile-info p {
    color: #6b7280;
    font-size: 0.95rem;
}

/* ===== Info Cards ===== */
.info-cards {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-top: 2rem;
}

.info-card {
    background: rgba(255, 255, 255, 0.45);
    backdrop-filter: blur(10px);
    border-radius: 1.5rem;
    padding: 1rem 1.5rem;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
}

.info-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}

.info-card h3 {
    font-weight: 600;
    color: #4f46e5;
    margin-bottom: 0.3rem;
    font-size: 1rem;
}

.info-card p {
    font-weight: 700;
    color: #1f2937;
    font-size: 0.95rem;
}

/* ===== Joined & Button Inline ===== */
.info-row {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}

.info-row .info-card {
    flex: 1;
}

/* ===== Button ===== */
.btn-submit {
    background: linear-gradient(90deg, #4f46e5, #8b5cf6);
    color: white;
    font-weight: 700;
    padding: 0.65rem 1.8rem;
    border-radius: 1rem;
    transition: transform 0.3s, box-shadow 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-submit:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(99, 102, 241, 0.4);
}

/* ===== Centering & Responsiveness ===== */
.main-content {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 3rem 1rem;
}

@media (max-width: 600px) {
    .profile-header {
        flex-direction: column;
        text-align: center;
    }
    .info-row {
        flex-direction: column;
    }
}
</style>
@endpush

@section('content')
<div class="main-content">

    <div class="form-card">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div class="profile-info">
                <h2>{{ Auth::user()->name }}</h2>
                <p>Member since {{ Auth::user()->created_at->format('F Y') }}</p>
            </div>
        </div>

        <!-- Info Cards -->
        <div class="info-cards">
            <div class="info-card">
                <h3>Name</h3>
                <p>{{ Auth::user()->name }}</p>
            </div>
            <div class="info-card">
                <h3>Email</h3>
                <p>{{ Auth::user()->email }}</p>
            </div>
        </div>

        <!-- Phone & Joined in same row -->
        <div class="info-row">
            <div class="info-card">
                <h3>Phone</h3>
                <p>{{ Auth::user()->phone ?? 'Not Provided' }}</p>
            </div>
            <div class="info-card">
                <h3>Joined</h3>
                <p>{{ Auth::user()->created_at->format('d M, Y') }}</p>
            </div>
        </div>

        <!-- Edit Button -->
        <div class="text-center mt-5">
            <a href="{{ route('profile.edit') }}" class="btn-submit">
                <i class="fas fa-edit"></i> Edit Profile
            </a>
        </div>
    </div>

</div>
@endsection
