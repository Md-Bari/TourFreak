@extends('index')

@section('title', 'My Ads')
@section('page_title', 'My Ads')

@section('content')
<div class="page-shell">
    <section class="hero-panel">
        <div>
            <span class="eyebrow">Your listings</span>
            <h2>Equipment ads</h2>
            <p>Review the items you have listed for sale or rent in a simpler, cleaner dashboard view.</p>
        </div>
    </section>

    @php
        $equipmentAds = [
            (object)[
                'id' => 1,
                'title' => 'Camping Tent for Rent',
                'description' => 'High quality waterproof tent suitable for 4 people. Available for daily and weekly rent.',
                'status' => 'active'
            ],
            (object)[
                'id' => 2,
                'title' => 'Stylish T-Shirt for Travel',
                'description' => 'Comfortable and breathable t-shirt perfect for your next adventure. Available in multiple sizes and colors.',
                'status' => 'active'
            ],
            (object)[
                'id' => 3,
                'title' => 'Durable Hiking Shoes',
                'description' => 'Durable and comfortable hiking shoes for long treks. Limited stock available.',
                'status' => 'pending'
            ],
            (object)[
                'id' => 4,
                'title' => 'Warm Sleeping Bag',
                'description' => 'Warm and lightweight sleeping bag. Best for winter camping.',
                'status' => 'inactive'
            ],
        ];
    @endphp

    <section class="content-card">
        @if(count($equipmentAds) === 0)
            <div class="empty-state">
                <i class="fas fa-bullhorn"></i>
                <h5>No ads yet</h5>
                <p class="muted-text mb-0">Your posted equipment ads will appear here.</p>
            </div>
        @else
            <div class="row g-4">
                @foreach($equipmentAds as $eq)
                    <div class="col-md-6 col-xl-4">
                        <article class="booking-card h-100">
                            <div class="booking-card-header">
                                <div>
                                    <h5 class="mb-1">{{ $eq->title }}</h5>
                                    <p class="muted-text mb-0">{{ \Illuminate\Support\Str::limit($eq->description, 90) }}</p>
                                </div>
                                <span class="status-pill {{ $eq->status === 'active' ? 'success' : ($eq->status === 'inactive' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($eq->status) }}
                                </span>
                            </div>
                            <div class="action-row mt-3">
                                <a href="#" class="btn btn-outline-dark btn-sm">View Details</a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</div>
@endsection
