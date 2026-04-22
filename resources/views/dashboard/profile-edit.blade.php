@extends('index')

@section('title', 'Edit Profile')
@section('page_title', 'Edit Profile')

@section('content')
<div class="page-shell form-shell">
    <section class="hero-panel">
        <div>
            <span class="eyebrow">Account update</span>
            <h2>Edit your profile</h2>
            <p>Refresh your personal information so future bookings and account activity stay accurate.</p>
        </div>
    </section>

    <section class="form-card">
        <div class="section-heading">
            <div>
                <span class="eyebrow">Profile form</span>
                <h3>Update Your Details</h3>
            </div>
        </div>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" value="{{ $user->email }}" disabled class="form-control">
            </div>

            <div class="mb-4">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control @error('phone') is-invalid @enderror">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="action-row">
                <a href="{{ route('profile') }}" class="btn btn-outline-dark">Cancel</a>
                <button type="submit" class="btn btn-dark">Save Changes</button>
            </div>
        </form>
    </section>
</div>
@endsection
