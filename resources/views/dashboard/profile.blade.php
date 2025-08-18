@extends('index')

@push('style')
<style>
    body {
        background-color: #f3f4f6;
    }

    .form-card {
        background-color: #ffffff;
        border-radius: 1.5rem;
        padding: 2.5rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .form-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .form-card h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 0.5rem;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        border: 1px solid #d1d5db;
        font-size: 1rem;
        color: #1f2937;
        background-color: #f9fafb;
        transition: border 0.3s, box-shadow 0.3s;
    }

    .form-input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        outline: none;
        background-color: #fff;
    }

    .btn-submit {
        background: linear-gradient(90deg, #4f46e5, #8b5cf6);
        color: white;
        font-weight: 600;
        padding: 0.75rem 2rem;
        border-radius: 1rem;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .btn-submit:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
    }
</style>
@endpush

@section('content')
<div class="main-content px-6 py-12 lg:ml-60 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-3xl">

        <div class="form-card">
            <h2>My Profile</h2>

            <!-- Form Fields -->
            <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" class="form-input" value="{{ Auth::user()->name }}" readonly>
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input" value="{{ Auth::user()->email }}" readonly>
            </div>

            <div class="form-group">
                <label class="form-label">Phone</label>
                <input type="text" class="form-input" value="{{ Auth::user()->phone ?? 'Not Provided' }}" readonly>
            </div>

            <div class="form-group">
                <label class="form-label">Role</label>
                <input type="text" class="form-input" value="{{ ucfirst(Auth::user()->role) }}" readonly>
            </div>

            <div class="form-group">
                <label class="form-label">Joined</label>
                <input type="text" class="form-input" value="{{ Auth::user()->created_at->format('d M, Y') }}" readonly>
            </div>

            <!-- Edit Button -->
            <div class="text-right mt-6">
                <a href="{{ route('profile.edit') }}" class="btn-submit inline-flex items-center gap-2">
                    <i class="fas fa-edit"></i> Edit Profile
                </a>
            </div>
        </div>

    </div>

</div>
@endsection
