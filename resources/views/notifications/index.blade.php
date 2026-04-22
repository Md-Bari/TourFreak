@extends('index')

@section('title', 'Notifications')
@section('page_title', 'Notifications')

@section('content')
<div class="page-shell">
    <section class="hero-panel">
        <div>
            <span class="eyebrow">Updates</span>
            <h2>Stay in the loop</h2>
            <p>See unread alerts, booking updates, and account activity from one cleaner notification center.</p>
        </div>
        @if(auth()->user()->unreadNotifications()->count() > 0)
            <div class="hero-actions">
                <form action="{{ route('notifications.markAllRead') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-dark">Mark All as Read</button>
                </form>
            </div>
        @endif
    </section>

    <section class="content-card">
        @if($notifications->count() > 0)
            <div class="notification-list">
                @foreach($notifications as $notification)
                    <article class="notification-card {{ !$notification->read ? 'border border-primary-subtle' : '' }}">
                        <div class="notification-card-header">
                            <div>
                                <h5 class="mb-1">{{ $notification->title }}</h5>
                                <p class="muted-text mb-2">{{ $notification->message }}</p>
                                <small class="muted-text">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                            @if(!$notification->read)
                                <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-dark">Mark as Read</button>
                                </form>
                            @endif
                        </div>

                        @if($notification->link)
                            <a href="{{ $notification->link }}" class="btn btn-sm btn-link px-0">View Details</a>
                        @endif
                    </article>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-bell-slash"></i>
                <h5>No notifications found</h5>
                <p class="muted-text mb-0">When something important happens, it will show up here.</p>
            </div>
        @endif

        <div class="mt-4">
            {{ $notifications->links() }}
        </div>
    </section>
</div>
@endsection
