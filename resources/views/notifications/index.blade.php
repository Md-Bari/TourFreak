@extends('index')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .notification-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
            transition: background-color 0.3s;
        }
        .notification-item:hover {
            background-color: #f8f9fa;
        }
        .notification-item.unread {
            background-color: #f0f7ff;
        }
        .notification-time {
            font-size: 0.85rem;
            color: #6c757d;
        }
    </style>
@endpush

@section('content')
<div class="main-content" style="margin-left:220px; margin-top:70px; padding:20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Notifications</h4>
                        @if(auth()->user()->unreadNotifications()->count() > 0)
                            <form action="{{ route('notifications.markAllRead') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-secondary">Mark All as Read</button>
                            </form>
                        @endif
                    </div>
                    <div class="card-body p-0">
                        @if($notifications->count() > 0)
                            @foreach($notifications as $notification)
                                <div class="notification-item {{ !$notification->read ? 'unread' : '' }}">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1">{{ $notification->title }}</h6>
                                            <p class="mb-1">{{ $notification->message }}</p>
                                            <span class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                                        </div>
                                        @if(!$notification->read)
                                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary">Mark as Read</button>
                                            </form>
                                        @endif
                                    </div>
                                    @if($notification->link)
                                        <div class="mt-2">
                                            <a href="{{ $notification->link }}" class="btn btn-sm btn-link p-0">View Details</a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="p-4 text-center">
                                <p class="mb-0">No notifications found.</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mt-3">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
