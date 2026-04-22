<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    @stack('style')
</head>
<body>
<div class="admin-shell">
    <aside class="sidebar">
        <div class="sidebar-header">
            <span class="brand-mark">TF</span>
            <div>
                <div class="brand-title">TourFreak</div>
                <div class="brand-subtitle">Admin panel</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('admin.home') }}" class="{{ request()->routeIs('admin.home') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.packages') }}" class="{{ request()->routeIs('admin.packages') ? 'active' : '' }}">
                <i class="bi bi-boxes"></i>
                <span>Packages</span>
            </a>
            <a href="{{ route('admin.rooms.add') }}" class="{{ request()->routeIs('admin.rooms.add') ? 'active' : '' }}">
                <i class="bi bi-door-closed-fill"></i>
                <span>Rooms</span>
            </a>
            <a href="{{ route('admin.buses.index') }}" class="{{ request()->routeIs('admin.buses.index') ? 'active' : '' }}">
                <i class="bi bi-bus-front-fill"></i>
                <span>Buses</span>
            </a>
        </nav>

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>
        </form>
    </aside>

    <main class="main-content">
        <div class="content-frame">
            @yield('content')
        </div>

        <footer class="admin-footer">
            <small>&copy; {{ date('Y') }} TourFreak Admin Panel. All rights reserved.</small>
        </footer>
    </main>
</div>

{{-- Bootstrap Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
@stack('script')

</body>
</html>
