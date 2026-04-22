<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'TourFreak')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('style')
</head>
<body>
    @php
        $userNavRoutes = [
            ['route' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'fa-chart-pie'],
            ['route' => 'profile', 'label' => 'Profile', 'icon' => 'fa-user'],
            ['route' => 'my.bookings', 'label' => 'Bookings', 'icon' => 'fa-suitcase-rolling'],
            ['route' => 'my-ads', 'label' => 'My Ads', 'icon' => 'fa-bullhorn'],
            ['route' => 'my-wishlist', 'label' => 'Wishlist', 'icon' => 'fa-heart'],
            ['route' => 'notifications.index', 'label' => 'Notifications', 'icon' => 'fa-bell'],
            ['route' => 'messages', 'label' => 'Messages', 'icon' => 'fa-envelope'],
            ['route' => 'settings.index', 'label' => 'Settings', 'icon' => 'fa-gear'],
            ['route' => 'support.index', 'label' => 'Support', 'icon' => 'fa-headset'],
        ];

        $publicNavRoutes = [
            ['route' => 'home', 'label' => 'Home'],
            ['route' => 'room', 'label' => 'Rooms'],
            ['route' => 'facilities', 'label' => 'Facilities'],
            ['route' => 'contact', 'label' => 'Contact'],
            ['route' => 'about', 'label' => 'About'],
        ];
    @endphp

    <div class="app-shell">
        <aside class="site-sidebar" id="siteSidebar">
            <div class="sidebar-top">
                <a class="brand-block" href="{{ route('home') }}">
                    <span class="brand-mark">TF</span>
                    <span>
                        <strong>TourFreak</strong>
                        <small>Travel made effortless</small>
                    </span>
                </a>
                <button class="sidebar-close d-lg-none" id="sidebarClose" type="button" aria-label="Close menu">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>

            <div class="sidebar-panel">
                <span class="sidebar-label">Explore</span>
                <nav class="sidebar-nav">
                    @foreach($publicNavRoutes as $item)
                        <a href="{{ route($item['route']) }}" class="{{ request()->routeIs($item['route']) ? 'active' : '' }}">
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>

            @auth
                <div class="sidebar-panel">
                    <span class="sidebar-label">Your Space</span>
                    <nav class="sidebar-nav">
                        @foreach($userNavRoutes as $item)
                            <a href="{{ route($item['route']) }}" class="{{ request()->routeIs($item['route']) ? 'active' : '' }}">
                                <i class="fas {{ $item['icon'] }}"></i>
                                <span>{{ $item['label'] }}</span>
                            </a>
                        @endforeach
                    </nav>
                </div>

                <div class="sidebar-profile-card">
                    <div class="profile-chip">
                        <span>{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    </div>
                    <div>
                        <strong>{{ auth()->user()->name }}</strong>
                        <small>{{ auth()->user()->email }}</small>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="sidebar-logout">
                    @csrf
                    <button type="submit" class="logout-button">
                        <i class="fas fa-arrow-right-from-bracket"></i>
                        <span>Logout</span>
                    </button>
                </form>
            @else
                <div class="sidebar-guest-card">
                    <h6>Ready to plan your next trip?</h6>
                    <p>Sign in to manage bookings, favorites, and account details in one place.</p>
                    <div class="guest-actions">
                        <a class="btn btn-light" href="{{ route('login') }}">Login</a>
                        <a class="btn btn-primary" href="{{ route('register.create') }}">Register</a>
                    </div>
                </div>
            @endauth
        </aside>

        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <div class="site-main">
            <header class="site-header">
                <div class="header-announcement">
                    <div class="announcement-copy">
                        <i class="fas fa-circle-info"></i>
                        <span>One click booking. Up to 15% off selected summer packages.</span>
                    </div>
                    <div class="announcement-actions d-none d-lg-flex">
                        <span>Need Help?</span>
                        <strong>+880 1345 533 865</strong>
                    </div>
                </div>

                <div class="site-header-inner travel-header">
                    <div class="header-brand-row">
                        <div class="header-brand-wrap">
                            <button class="menu-toggle" id="sidebarToggle" type="button" aria-label="Open menu">
                                <i class="fas fa-bars"></i>
                            </button>
                            <a class="brand-inline" href="{{ route('home') }}">
                                <span class="brand-mark small-mark">TF</span>
                                <span>
                                    <strong>TourFreak</strong>
                                    <small>Travel.co</small>
                                </span>
                            </a>
                        </div>

                        <div class="header-search-shell d-none d-lg-flex">
                            <i class="fas fa-magnifying-glass"></i>
                            <input type="text" value="" placeholder="Find your perfect tour package">
                        </div>

                        <div class="header-utility">
                            <div class="utility-help d-none d-xl-flex">
                                <span>EN</span>
                                <i class="fas fa-globe"></i>
                            </div>
                            @auth
                                <a class="account-pill account-pill-dark" href="{{ route('dashboard') }}">
                                    <span class="account-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                    <span>{{ auth()->user()->name }}</span>
                                </a>
                            @else
                                <a class="btn btn-dark header-login-btn" href="{{ route('login') }}">
                                    <i class="fas fa-user me-2"></i>Login
                                </a>
                            @endauth
                        </div>
                    </div>

                    <div class="header-nav-row">
                        <nav class="header-nav gofly-nav d-none d-lg-flex">
                            @foreach($publicNavRoutes as $item)
                                <a href="{{ route($item['route']) }}" class="{{ request()->routeIs($item['route']) ? 'active' : '' }}">
                                    {{ $item['label'] }}
                                    @if(in_array($item['label'], ['Home', 'Rooms']))
                                        <i class="fas fa-angle-down nav-caret"></i>
                                    @endif
                                </a>
                            @endforeach
                        </nav>

                        <div class="header-mini-actions">
                            @guest
                                <a class="btn btn-outline-dark btn-sm" href="{{ route('register.create') }}">Register</a>
                            @endguest
                            <div class="mini-contact d-none d-lg-flex">
                                <div class="mini-contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <span>Need Help?</span>
                                    <strong>+880 1345 533 865</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @unless(request()->routeIs('home'))
                    <div class="header-page-title">
                        <p class="header-kicker">TourFreak</p>
                        <h1 class="header-title">@yield('page_title', 'Discover Better Journeys')</h1>
                    </div>
                @endunless
            </header>

            <main class="page-content">
                @yield('content')
            </main>

            <footer class="site-footer">
                <div class="footer-grid">
                    <div>
                        <h5>TourFreak</h5>
                        <p>Modern travel planning for rooms, tours, transport, and memorable experiences.</p>
                    </div>
                    <div>
                        <h6>Quick Links</h6>
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('room') }}">Rooms</a>
                        <a href="{{ route('contact') }}">Contact</a>
                        <a href="{{ route('about') }}">About</a>
                    </div>
                    <div>
                        <h6>Account</h6>
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                        <a href="{{ route('my.bookings') }}">Bookings</a>
                        <a href="{{ route('settings.index') }}">Settings</a>
                        <a href="{{ route('support.index') }}">Support</a>
                    </div>
                    <div>
                        <h6>Contact</h6>
                        <p>Dhaka, Bangladesh</p>
                        <p>+880 123 456 789</p>
                        <p>support@tourfreak.com</p>
                    </div>
                </div>
                <div class="footer-bottom">
                    <small>&copy; {{ date('Y') }} TourFreak. All rights reserved.</small>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('siteSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const openButton = document.getElementById('sidebarToggle');
        const closeButton = document.getElementById('sidebarClose');

        const closeSidebar = () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        };

        openButton?.addEventListener('click', () => {
            sidebar.classList.add('active');
            overlay.classList.add('active');
        });

        closeButton?.addEventListener('click', closeSidebar);
        overlay?.addEventListener('click', closeSidebar);
    </script>
    @stack('scripts')
    @stack('script')
</body>
</html>
