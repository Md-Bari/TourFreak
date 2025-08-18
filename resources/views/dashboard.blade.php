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
            <a href="#">Dashboard</a>
            <a href="#">Profile</a>
            <a href="#">Bookings</a>
            <a href="#">My Ads</a>
            <a href="#">Wishlist</a>
            <a href="#">Notifications</a>
            <a href="#">Messages</a>
            <a href="#">Settings</a>
            <a href="#">Support</a>
            <a href="#">Logout</a>
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
