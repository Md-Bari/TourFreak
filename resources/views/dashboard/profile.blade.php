@extends('index')

@section('content')
<div class="main-content px-6 py-10 lg:ml-60">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-8 border border-gray-200">

        <!-- Profile Header -->
        <div class="flex items-center space-x-6 border-b pb-6 mb-6">
            <div class="w-24 h-24 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center text-white text-4xl font-bold shadow-lg">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
                <p class="text-gray-500">Member since {{ Auth::user()->created_at->format('F Y') }}</p>
            </div>
        </div>

        <!-- Profile Info Table -->
        <div class="overflow-hidden rounded-xl border border-gray-200 shadow-sm">
            <table class="w-full text-left border-collapse">
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-semibold text-gray-600">Name</td>
                        <td class="px-6 py-4 text-gray-800">{{ Auth::user()->name }}</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-semibold text-gray-600">Email</td>
                        <td class="px-6 py-4 text-gray-800">{{ Auth::user()->email }}</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-semibold text-gray-600">Phone</td>
                        <td class="px-6 py-4 text-gray-800">{{ Auth::user()->phone ?? 'Not Provided' }}</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-semibold text-gray-600">Role</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-sm rounded-full
                                {{ Auth::user()->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                {{ ucfirst(Auth::user()->role) }}
                            </span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-semibold text-gray-600">Joined</td>
                        <td class="px-6 py-4 text-gray-800">{{ Auth::user()->created_at->format('d M, Y') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Edit Button -->
        <div class="mt-6 text-right">
            <a href="{{ route('profile.edit') }}"
               class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold rounded-xl shadow-md transition">
               ✏️ Edit Profile
            </a>
        </div>
    </div>
</div>
@endsection
