@extends('index')

@push('style')
<style>
    /* Background gradient animation for avatar */
    .avatar-gradient {
        background: linear-gradient(135deg, #4f46e5, #8b5cf6, #ec4899);
        background-size: 400% 400%;
        animation: gradientBG 8s ease infinite;
    }

    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Card hover effect */
    .profile-card {
        transition: transform 0.5s, box-shadow 0.5s;
    }

    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    /* Table row hover effect */
    .profile-table tr:hover {
        background-color: #f0f4f8;
    }

    /* Button hover animation */
    .btn-gradient:hover {
        transform: scale(1.05);
    }

    /* Soft glow effect for the avatar */
    .avatar-glow {
        box-shadow: 0 0 15px rgba(139, 92, 246, 0.6), 0 0 30px rgba(236, 72, 153, 0.4);
    }
</style>
@endpush

@section('content')
<div class="main-content px-6 py-12 lg:ml-60 bg-gray-100 min-h-screen">

    <div class="max-w-4xl mx-auto">

        <!-- Profile Card -->
        <div class="bg-white rounded-3xl border border-gray-200 shadow-xl p-10 profile-card">

            <!-- Profile Header -->
            <div class="flex items-center space-x-6 border-b pb-6 mb-6">
                <div class="w-28 h-28 rounded-full avatar-gradient avatar-glow flex items-center justify-center text-white text-5xl font-extrabold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-4xl font-extrabold text-gray-800">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-500 text-lg mt-1">Member since <span class="font-medium">{{ Auth::user()->created_at->format('F Y') }}</span></p>
                </div>
            </div>

            <!-- Profile Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-indigo-50 rounded-2xl p-6 shadow hover:shadow-lg transition">
                    <h3 class="text-gray-500 font-semibold mb-2">Name</h3>
                    <p class="text-gray-800 font-bold text-lg">{{ Auth::user()->name }}</p>
                </div>
                <div class="bg-purple-50 rounded-2xl p-6 shadow hover:shadow-lg transition">
                    <h3 class="text-gray-500 font-semibold mb-2">Email</h3>
                    <p class="text-gray-800 font-bold text-lg">{{ Auth::user()->email }}</p>
                </div>
                <div class="bg-green-50 rounded-2xl p-6 shadow hover:shadow-lg transition">
                    <h3 class="text-gray-500 font-semibold mb-2">Phone</h3>
                    <p class="text-gray-800 font-bold text-lg">{{ Auth::user()->phone ?? 'Not Provided' }}</p>
                </div>
                <div class="bg-red-50 rounded-2xl p-6 shadow hover:shadow-lg transition">
                    <h3 class="text-gray-500 font-semibold mb-2">Role</h3>
                    <span class="px-4 py-2 text-sm rounded-full 
                        {{ Auth::user()->role === 'admin' ? 'bg-red-200 text-red-800' : 'bg-green-200 text-green-800' }}">
                        {{ ucfirst(Auth::user()->role) }}
                    </span>
                </div>
                <div class="bg-yellow-50 rounded-2xl p-6 shadow hover:shadow-lg transition md:col-span-2">
                    <h3 class="text-gray-500 font-semibold mb-2">Joined</h3>
                    <p class="text-gray-800 font-bold text-lg">{{ Auth::user()->created_at->format('d M, Y') }}</p>
                </div>
            </div>

            <!-- Edit Button -->
            <div class="text-right">
                <a href="{{ route('profile.edit') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold rounded-2xl shadow-lg btn-gradient transition transform">
                   <i class="fas fa-edit"></i> Edit Profile
                </a>
            </div>

        </div>
    </div>

</div>
@endsection
