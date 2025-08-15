<?php
@extends('index')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">My Ads</h2>
        {{-- Example ads list --}}
        @if(isset($ads) && count($ads))
            <div class="row g-3">
                @foreach($ads as $ad)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100">
                            <img src="{{ asset($ad->image) }}" class="card-img-top" alt="{{ $ad->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $ad->title }}</h5>
                                <p class="card-text">{{ Str::limit($ad->description, 100) }}</p>
                                <p class="card-text"><strong>Price:</strong> ${{ number_format($ad->price, 2) }}</p>
                                <a href="{{ route('ads.edit', $ad->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ route('ads.delete', $ad->id) }}" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>You have not posted any ads yet.</p>
        @endif
    </div>
@endsection