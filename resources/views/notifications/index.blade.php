@extends('index')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Card style */
        .card {
            border: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            border-radius: 12px;
        }

        /* Notification items */
        .notification-item {
            padding: 15px;
            border-bottom: 1px solid #e1e8ed;
            transition: background-color 0.3s, transform 0.2s;
        }

        .notification-item:hover {
            background-color: #f1f9f5; /* Light green hover */
            transform: translateX(5px);
        }

        .notification-item.unread {
            background-color: #eaf4ff; /* Soft blue for unread */
        }

        /* Notification time */
        .notification-time {
            font-size: 0.85rem;
            color: #888;
        }

        /* Buttons */
        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #565e64;
        }

        .btn-link {
            color: #28a745; /* Green link */
        }

        .btn-link:hover {
            color: #1e7e34;
            text-decoration: underline;
        }
    </style>
@endpush

@section('content')
<div class="main-content" style="margin-left:220px; margin-top:70px; padding:20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center bg-light">
                        <h4 class="mb-0 text-primary">🔔 Notifications</h4>
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
                                            <h6 class="mb-1 text-dark">{{ $notification->title }}</h6>
                                            <p class="mb-1 text-muted">{{ $notification->message }}</p>
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
                                <p class="mb-0 text-muted">No notifications found.</p>
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
