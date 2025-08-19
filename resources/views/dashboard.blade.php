<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - @yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Container for sidebar + main */
        .content-wrapper {
            display: flex;
            flex: 1;
        }

        /* Sidebar (not fixed anymore!) */
        .sidebar {
            width: 220px;
            background: #0d3b66;
            color: white;
            padding: 20px 0;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar a {
            color: white;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background: #145c9e;
        }

        /* Main content */
        .main-content {
            flex: 1;
            padding: 20px;
            background: #f4f6f9;
        }

        /* Footer always after content */
        footer {
            background: #222;
            color: white;
            padding: 20px;
            text-align: center;
        }

        /* Responsive (mobile) */
        @media (max-width: 768px) {
            .content-wrapper {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                flex-direction: row;
                overflow-x: auto;
            }
            .sidebar a {
                flex: 1;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <div class="content-wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
            <a href="{{ route('profile') }}"><i class="fas fa-user me-2"></i> Profile</a>
            <a href="{{ route('my.bookings') }}"><i class="fas fa-calendar me-2"></i> Bookings</a>
            <a href="{{ route('my-ads') }}"><i class="fas fa-ad me-2"></i> My Ads</a>
            <a href="{{ route('my-wishlist') }}"><i class="fas fa-heart me-2"></i> Wishlist</a>
            <a href="{{ route('notifications.index') }}"><i class="fas fa-bell me-2"></i> Notifications</a>
            <a href="{{ route('messages') }}"><i class="fas fa-envelope me-2"></i> Messages</a>
            <a href="{{ route('settings.index') }}"><i class="fas fa-cog me-2"></i> Settings</a>
            <a href="{{ route('support.index') }}"><i class="fas fa-question-circle me-2"></i> Support</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
            </form>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 TourFreak. All rights reserved.</p>
    </footer>

</body>
</html>
