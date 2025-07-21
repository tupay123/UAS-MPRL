{{-- <header class="header navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <div class="header-area">
            <div class="logo">
                <a href="{{ route("frontend.home") }}">
                    <img src="{{ asset("uploads/logo/".$sitesettings->logo_light) }}" alt="{{ $sitesettings->site_title }}" class="logo-dark"/>
                    <img src="{{ asset("uploads/logo/".$sitesettings->logo_dark) }}" alt="{{ $sitesettings->site_title }}" class="logo-white"/>
                </a>
            </div>
            <div class="header-navbar">
                <nav class="navbar">
                    <div class="collapse navbar-collapse" id="main_nav">
                        @if (count($menu) > 0)
                        <ul class="navbar-nav">
                            @foreach ($menu as $item)
                            <li class="nav-item">
                                <a class="nav-link{{ request()->url() == $item["href"] ? " active" : "" }}" href="{{ $item["href"] }}">{{ $item["text"] }}</a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </nav>
            </div>
            <div class="header-right">
                <div class="theme-switch-wrapper">
                    <label class="theme-switch" for="checkbox">
                        <input type="checkbox" id="checkbox" />
                        <span class="slider round ">
                            <i class="lar la-sun icon-light"></i>
                            <i class="lar la-moon icon-dark"></i>
                        </span>
                    </label>
                </div>
                <div class="search-icon">
                    <i class="las la-search"></i>
                </div>
                @auth
                <div class="botton-sub">
                    <a href="{{ route("dashboard.home") }}" class="btn-subscribe">Dashboard</a>
                </div>
                @else
                <div class="botton-sub">
                    <a href="{{ route("auth.login") }}" class="btn-subscribe">Log In</a>
                </div>
                @endauth
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </div>
</header> --}}

    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container position-relative"> <!-- Tambahkan position-relative -->
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route("frontend.home") }}">TrixNews</a>

            <!-- Tombol Toggle Mobile -->
            <button class="navbar-toggler d-lg-none border-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mobileMenu">
                <i class="fas fa-bars text-white fs-4"></i>
            </button>

           <!-- Desktop Menu - Center - Dinamis dari Category -->
<div class="d-none d-lg-block center-menu-container">
    <ul class="navbar-nav center-menu">

        @foreach ($menuCategories as $category)
            <li class="nav-item">
                <a class="nav-link {{ request()->is('category/' . $category->slug) ? 'active' : '' }}"
                   href="{{ route('frontend.category', $category->slug) }}">
                    {{ $category->title }}
                </a>
            </li>
        @endforeach

        <li class="nav-item">
            <a href="{{ route('frontend.ebooks.index') }}" class="nav-link text-white">Ebook</a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fas fa-search me-1"></i> Search
            </a>
        </li>
    </ul>
</div>


           <!-- Auth buttons on the right - Perbaikan struktur & validasi -->
            <div class="right-buttons d-none d-lg-flex">
                @auth
                    <a href="{{ route('dashboard.home') }}" class="btn btn-gradient text-white">Dashboard</a>
                @else
                    <a href="{{ route('auth.login') }}" class="btn btn-outline-gradient me-2 text-white">Login</a>
                    <a href="{{ route('auth.signup') }}" class="btn btn-gradient text-white">Register</a>
                @endauth
            </div>


        </div>
    </nav>

    <!-- Mobile Menu (Offcanvas) -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-white">TrixNews</h5>
            <button style="background-color: white" type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav">
            @foreach ($menuCategories as $category)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('frontend.category', $category->slug) }}">{{ $category->title }}</a>
                </li>
            @endforeach

            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <i class="fas fa-search"></i> Search
                </a>
            </li>

            <li class="nav-item mt-3">
                @auth
                    <a href="{{ route('dashboard.home') }}" class="btn btn-gradient text-white">Dashboard</a>
                @else
                    <a href="{{ route('auth.login') }}" class="btn btn-outline-gradient me-2 text-white">Login</a>
                    <a href="{{ route('auth.signup') }}" class="btn btn-gradient text-white">Register</a>
                @endauth
            </li>
        </ul>

        </div>
    </div>
        <!-- Live Prices Section -->
    <div class="live-prices">
        <div class="container">
            <div class="live-prices-container">
                <span class="live-prices-title">
                    <i class="fas fa-chart-line"></i> Live Prices
                </span>

                <div class="price-item">
                    <span class="price-icon"><i class="fab fa-bitcoin"></i></span>
                    <span>BTC 575,431.42</span>
                    <span class="price-change price-up">+4.85%</span>
                </div>

                <div class="price-item">
                    <span class="price-icon"><i class="fab fa-ethereum"></i></span>
                    <span>ETH 54,234.70</span>
                    <span class="price-change price-down">-2.04%</span>
                </div>

                <div class="price-item">
                    <span class="price-icon"><i class="fas fa-coins"></i></span>
                    <span>BNB 5,635.96</span>
                    <span class="price-change price-up">+1.77%</span>
                </div>

                <div class="price-item">
                    <span class="price-icon"><i class="fas fa-x"></i></span>
                    <span>XRP 50,6240</span>
                    <span class="price-change price-down">-3.71%</span>
                </div>

                <a href="#" class="view-all-prices">
                    View All <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>


