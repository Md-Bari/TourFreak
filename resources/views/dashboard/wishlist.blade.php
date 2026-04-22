@extends('index')

@section('title', 'Wishlist')
@section('page_title', 'Your Wishlist')

@section('content')
<div class="page-shell">
    <section class="hero-panel">
        <div>
            <span class="eyebrow">Saved ideas</span>
            <h2>Your wishlist</h2>
            <p>Keep your favorite travel options in one place so you can compare and book them later.</p>
        </div>
    </section>

    <section class="content-card">
        @if($wishlistItems->isEmpty())
            <div class="empty-state">
                <i class="fas fa-heart-crack"></i>
                <h5>Your wishlist is empty</h5>
                <p class="muted-text mb-3">Start exploring our travel options and save the ones you love.</p>
                <a href="{{ route('home') }}" class="btn btn-dark">Explore Trips</a>
            </div>
        @else
            <div class="row g-4">
                @foreach($wishlistItems as $item)
                    <div class="col-md-6 col-xl-4">
                        <article class="booking-card h-100">
                            <div class="booking-card-header">
                                <div>
                                    <h5 class="mb-1">{{ $item->item_details->title ?? 'Saved Item' }}</h5>
                                    <p class="muted-text mb-0">{{ $item->item_details->location ?? 'Location not available' }}</p>
                                </div>
                                <span class="status-pill {{ ($item->item_details->status ?? '') === 'active' ? 'success' : 'warning' }}">
                                    {{ ucfirst($item->item_details->status ?? 'saved') }}
                                </span>
                            </div>

                            <p class="muted-text">{{ \Illuminate\Support\Str::limit($item->item_details->description ?? 'No description available.', 100) }}</p>

                            <div class="booking-meta">
                                <span>{{ $item->item_type ?? 'Travel Item' }}</span>
                                <span>{{ $item->item_details->price ?? 'N/A' }} BDT</span>
                            </div>

                            <div class="action-row mt-3">
                                <form action="{{ route('wishlist.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Remove</button>
                                </form>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</div>
@endsection
