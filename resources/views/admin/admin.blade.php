<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
            position: fixed;
            width: 220px;
        }

        .sidebar a {
            color: #fff;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
        }

        .sidebar a:hover, .sidebar .active {
            background-color: #495057;
        }

        .main-content {
            margin-left: 220px;
            padding: 30px;
        }

        .sidebar-header {
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff;
            padding: 10px 20px;
            border-bottom: 1px solid #495057;
            margin-bottom: 10px;
        }
    </style>

    @stack('style')
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">TourFreak</div>
    <a href="{{ route('admin.home') }}" class="{{ request()->routeIs('admin.home') ? 'active' : '' }}">
        <i class="bi bi-speedometer2 me-2"></i>Dashboard
    </a>
    <a href="{{ route('admin.packages') }}" class="{{ request()->routeIs('admin.packages') ? 'active' : '' }}">
        <i class="bi bi-boxes me-2"></i>Packages
    </a>
    <a href="{{ route('admin.rooms.add') }}" class="{{ request()->routeIs('admin.rooms.add') ? 'active' : '' }}">
        <i class="bi bi-door-closed-fill me-2"></i>Rooms
    </a>
    <a href="#" class="">
        <i class="bi bi-check-circle-fill me-2"></i>Available
    </a>
    <form action="{{ route('logout') }}" method="POST" class="mt-3 text-center">
        @csrf
        <button class="btn btn-sm btn-outline-light">Logout</button>
    </form>
</div>

<div class="main-content">
    @yield('content')
</div>

{{-- Footer --}}
<footer class="text-center mt-5 text-muted">
    <small>&copy; {{ date('Y') }} TourFreak Admin Panel. All rights reserved.</small>
</footer>

{{-- Bootstrap Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('script')

</body>
</html>
