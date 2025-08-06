@extends('index')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Room Details: {{ strtoupper($type) }}</h2>
    <p class="text-center">
        This page will show detailed information for the <strong>{{ $type }}</strong> room.
    </p>

    <!-- Example Placeholder - You can expand this -->
    <div class="text-center mt-4">
        <img src="{{ asset('assets/images/' . substr($type, 0, 1) . '.jpg') }}" alt="{{ $type }} room" style="max-width: 400px; width: 100%;">
    </div>
</div>
@endsection
