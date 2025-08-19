@extends('index')

@push('style')
<style>
    /* Background Gradient Animation */
    .bg-animated {
        background: linear-gradient(-45deg, #6366f1, #ec4899, #06b6d4, #f59e0b);
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
    }
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Animations */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(25px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp { animation: fadeInUp 0.8s ease forwards; }

    /* Glass Card */
    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 1.5rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        padding: 2rem;
    }

    /* Inputs */
    .input-field {
        width: 100%;
        border: 2px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 0.85rem 1rem;
        font-size: 1rem;
        background: #f9fafb;
        transition: 0.3s;
    }
    .input-field:focus {
        border-color: #6366f1;
        background: #fff;
        box-shadow: 0 0 10px rgba(99,102,241,0.3);
        outline: none;
    }

    /* Buttons */
    .btn-gradient {
        background: linear-gradient(90deg, #6366f1, #ec4899, #f59e0b);
        background-size: 200% 100%;
        color: #fff;
        font-weight: bold;
        padding: 0.85rem 2rem;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }
    .btn-gradient:hover {
        background-position: 100% 0;
        transform: scale(1.05);
        box-shadow: 0px 6px 20px rgba(99,102,241,0.4);
    }
</style>
@endpush

@section('content')

<div class="main-content px-6 py-16 lg:ml-60 min-h-screen flex items-center justify-center bg-animated">

    <div class="w-full max-w-2xl glass-card">

        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 animate-fadeInUp">✨ Edit Profile</h2>
            <p class="text-gray-500 mt-2">Keep your profile up-to-date and stylish!</p>
        </div>

        <!-- Form -->
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="animate-fadeInUp">
                <label class="block text-gray-700 font-semibold mb-2">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input-field">
            </div>

            <!-- Email -->
            <div class="animate-fadeInUp delay-200">
                <label class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" value="{{ $user->email }}" disabled class="input-field bg-gray-100 text-gray-500 cursor-not-allowed">
            </div>

            <!-- Phone -->
            <div class="animate-fadeInUp delay-300">
                <label class="block text-gray-700 font-semibold mb-2">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="input-field">
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('profile') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 rounded-lg text-gray-700 font-medium shadow">
                    ← Cancel
                </a>
                <button type="submit" class="btn-gradient">💾 Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection
