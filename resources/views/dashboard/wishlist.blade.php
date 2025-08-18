@extends('dashboard.dashboard')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4 text-center text-primary">Your Wishlist</h2>
            </div>
        </div>

        @if($wishlistItems->isEmpty())
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-body text-center shadow-sm p-5">
                        <p class="h4 text-muted my-3">
                            <i class="fas fa-heart-broken me-2"></i> Your wishlist is empty.
                        </p>
                        <p class="mb-4">Start exploring our amazing travel options and add the ones you love!</p>
                        <a href="{{ route('home') }}" class="btn btn-primary btn-lg d-inline-flex align-items-center justify-content-center mx-auto" style="max-width: 250px;">
                            <i class="fas fa-plus me-2"></i> Add Items to Wishlist
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach($wishlistItems as $item)
                    <div class="col mb-4">
                        <div class="card h-100 border-0 shadow-lg tour-ad-card" style="border-radius: 15px; overflow: hidden;">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $item->item_details->image) }}" class="card-img-top tour-ad-img" alt="{{ $item->item_details->title }}" style="height: 250px; object-fit: cover;">
                                <span class="badge {{ $item->item_details->status == 'active' ? 'bg-success' : ($item->item_details->status == 'pending' ? 'bg-warning text-dark' : 'bg-danger') }} position-absolute top-0 start-0 m-3">{{ ucfirst($item->item_details->status) }}</span>
                            </div>
                            <div class="card-body d-flex flex-column" style="padding: 1.5rem;">
                                {{-- Item Type & Title --}}
                                <div class="d-flex align-items-center mb-2">
                                    @php
                                        $icon = '';
                                        if ($item->item_type == 'Tour') {
                                            $icon = 'fas fa-plane';
                                        } elseif ($item->item_type == 'Hotel') {
                                            $icon = 'fas fa-hotel';
                                        } elseif ($item->item_type == 'Activity') {
                                            $icon = 'fas fa-biking';
                                        } elseif ($item->item_type == 'Flight') {
                                            $icon = 'fas fa-ticket-alt';
                                        }
                                    @endphp
                                    <h5 class="card-title text-primary fw-bold mb-0">
                                        <i class="{{ $icon }} me-2"></i> {{ $item->item_details->title }}
                                    </h5>
                                </div>
                                <hr class="my-2">
                                
                                {{-- Details --}}
                                <div class="mb-3">
                                    <p class="card-text text-secondary mb-1"><i class="fas fa-map-marker-alt me-2"></i> {{ $item->item_details->location ?? 'N/A' }}</p>
                                    <p class="card-text text-secondary mb-1"><i class="fas fa-dollar-sign me-2"></i> Current Price: <span class="fw-bold">{{ $item->item_details->price }} BDT</span></p>
                                    
                                    {{-- Price Tracking Feature --}}
                                    @if($item->price_status == 'increase')
                                        <p class="card-text text-danger small"><i class="fas fa-arrow-up me-1"></i> Price Increased!</p>
                                    @elseif($item->price_status == 'decrease')
                                        <p class="card-text text-success small"><i class="fas fa-arrow-down me-1"></i> Price Dropped!</p>
                                    @endif

                                    {{-- Custom Notes Feature --}}
                                    @if($item->notes)
                                        <p class="card-text mt-2"><i class="fas fa-sticky-note me-2"></i> <span class="fw-bold">Note:</span> {{ $item->notes }}</p>
                                    @endif
                                </div>

                                {{-- Action Buttons --}}
                                <div class="mt-auto d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                                    {{-- Move to Booking --}}
                                    <a href="{{ route('booking.create', $item->id) }}" class="btn btn-primary btn-sm w-100"><i class="fas fa-shopping-cart me-1"></i> Move to Booking</a>
                                    
                                    <div class="d-flex gap-2 w-100">
                                        {{-- Share Option --}}
                                        <button class="btn btn-outline-info btn-sm w-100" data-bs-toggle="tooltip" data-bs-placement="top" title="Share this item"><i class="fas fa-share-alt"></i></button>

                                        {{-- Remove from Wishlist --}}
                                        <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" class="w-100">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100"><i class="fas fa-trash"></i> Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection