@extends('dashboard.dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4 text-center text-primary">Your Equipment Ads</h2>
        </div>
    </div>

    @php
        $equipmentAds = [
            (object)[
                'id' => 1,
                'title' => 'Camping Tent for Rent',
                'description' => 'High quality waterproof tent suitable for 4 people. Available for daily and weekly rent.',
                'image' => 'https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=800&q=80',
                'status' => 'active'
            ],
            (object)[
                'id' => 2,
                'title' => 'Stylish T-Shirt for Travel',
                'description' => 'Comfortable and breathable t-shirt perfect for your next adventure. Available in multiple sizes and colors.',
                'image' => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?auto=format&fit=crop&w=800&q=80',
                'status' => 'active'
            ],
            (object)[
                'id' => 3,
                'title' => 'Durable Hiking Shoes',
                'description' => 'Durable and comfortable hiking shoes for long treks. Limited stock available.',
                'image' => 'https://images.unsplash.com/photo-1600180758895-4f0cb3b2ff33?auto=format&fit=crop&w=800&q=80', 
                'status' => 'pending'
            ],
            (object)[
                'id' => 4,
                'title' => 'Warm Sleeping Bag',
                'description' => 'Warm and lightweight sleeping bag. Best for winter camping.',
                'image' => 'https://images.unsplash.com/photo-1607214410617-90d6d0c9980e?auto=format&fit=crop&w=800&q=80', 
                'status' => 'inactive'
            ],
        ];
    @endphp

    @if(count($equipmentAds) == 0)
        <div class="row">
            <div class="col-12">
                <div class="card card-body text-center shadow-sm">
                    <p class="h4 text-muted my-3">
                        <i class="fas fa-toolbox me-2"></i> You have not posted any equipment ads yet.
                    </p>
                    <p>Start posting your travel equipment for rent or sale!</p>
                </div>
            </div>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($equipmentAds as $eq)
                <div class="col mb-4">
                    <div class="card h-100 border-0 shadow-lg tour-ad-card" style="border-radius: 15px; overflow: hidden;">
                        <img src="{{ $eq->image }}" class="card-img-top tour-ad-img" alt="{{ $eq->title }}" style="height: 250px; object-fit: cover;">
                        <div class="card-body d-flex flex-column" style="padding: 1.5rem;">
                            <h5 class="card-title text-primary fw-bold">{{ $eq->title }}</h5>
                            <p class="card-text text-secondary mb-3">{{ Str::limit($eq->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="badge 
                                    {{ $eq->status == 'active' ? 'bg-success' : ($eq->status == 'pending' ? 'bg-warning text-dark' : 'bg-danger') }}">
                                    {{ ucfirst($eq->status) }}
                                </span>
                                <a href="#" class="btn btn-sm btn-outline-primary" style="border-radius: 20px;">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .tour-ad-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .tour-ad-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }
    .tour-ad-img {
        transition: transform 0.5s ease;
    }
    .tour-ad-card:hover .tour-ad-img {
        transform: scale(1.05);
    }
</style>
@endsection
