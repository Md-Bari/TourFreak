@extends('index')

@section('content')
<div class="main-content px-6 py-10 lg:ml-60">
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-xl p-8 border border-gray-200">

        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Edit Profile</h2>

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label class="block text-gray-700 font-medium mb-2">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-700 font-medium mb-2">Email (cannot change)</label>
                <input type="email" value="{{ $user->email }}" disabled
                    class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 text-gray-500 cursor-not-allowed">
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-gray-700 font-medium mb-2">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('profile') }}" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 rounded-xl text-gray-700 font-medium shadow-sm transition">
                    ← Cancel
                </a>
                <button type="submit"
                    class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold rounded-xl shadow-md transition">
                    💾 Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
