<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" sizes="16x16" href="{{ asset('favicon.ico') }}" />
    <title>@yield('title')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/cssCustom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/line-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom.css') }}" />
</head>

<body>
    <div class="loader">
        <div class="loader-element"></div>
    </div>
    <x-frontend.header />
    @yield('content')
    <x-frontend.footer />
    <div class="back">
        <a href="#" class="back-top">
            <i style="color: black" class="las la-long-arrow-alt-up"></i>
        </a>
    </div>

    <!-- Glassmorphism Search Modal -->
    <div class="modal fade search-modal" id="searchModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white">Search Articles</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Search Input -->
                    <input type="text" class="form-control search-input" id="searchInput"
                        placeholder="Search for crypto news, articles, or...">

                    <!-- Improved Filter Section for Mobile -->
                    <div class="filter-section">
                        <span class="filter-label">Filters:</span>

                        <!-- Category Dropdown -->
                        <div class="dropdown position-relative">
                            <button class="filter-btn dropdown-toggle" type="button" id="categoryDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-layer-group"></i> Category: All
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                <li><a class="dropdown-item active" href="#" data-category=""><i
                                            class="fas fa-check-circle me-2"></i>All Categories</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                @foreach ($categories as $category)
                                    <li>
                                        <a class="dropdown-item" href="#" data-category="{{ $category->slug }}">
                                            <i class="fas fa-tag me-2"></i>{{ $category->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>


                        <!-- Date Dropdown -->
                        <div class="dropdown position-relative d-inline-block me-3">
                            <button class="filter-btn dropdown-toggle" type="button" id="dateDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="far fa-calendar"></i> Date: All
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dateDropdown">
                                <li><a class="dropdown-item active" href="#" data-date=""><i
                                            class="fas fa-check-circle me-2"></i>All Time</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#" data-date="today"><i
                                            class="fas fa-calendar-day me-2"></i>Today</a></li>
                                <li><a class="dropdown-item" href="#" data-date="this_week"><i
                                            class="fas fa-calendar-week me-2"></i>This Week</a></li>
                                <li><a class="dropdown-item" href="#" data-date="this_month"><i
                                            class="fas fa-calendar-alt me-2"></i>This Month</a></li>
                            </ul>
                        </div>

                    </div>

                    <div class="empty-state" id="emptyState">
                        <i class="fas fa-search"></i>
                        <p>Start typing to search for articles...</p>
                    </div>

                    <div class="search-results mt-4" id="searchResults">
                        <!-- Realtime search results will appear here -->
                    </div>

                    <!-- Popular Searches -->
                    <div class="popular-searches">
                        <h6 class="text-white">Popular searches:</h6>
                        <div>
                            <span class="search-badge">Bitcoin</span>
                            <span class="search-badge">Ethereum</span>
                            <span class="search-badge">DeFi</span>
                            <span class="search-badge">NFT</span>
                            <span class="search-badge">Regulation</span>
                            <span class="search-badge">Altcoins</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/theia-sticky-sidebar.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/switch.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.marquee.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>

    <script>
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    const emptyState = document.getElementById('emptyState');

    const categoryItems = document.querySelectorAll('[data-category]');
    const dateItems = document.querySelectorAll('[data-date]');

    const categoryBtn = document.getElementById('categoryDropdown');
    const dateBtn = document.getElementById('dateDropdown');

    // Fungsi ambil filter aktif
    function getActiveFilter(attribute) {
        const active = document.querySelector(`.dropdown-item.active[${attribute}]`);
        return active ? active.getAttribute(attribute) : '';
    }

    // Fungsi ubah label tombol dropdown
    function updateDropdownLabel(type, labelText) {
        if (type === 'category') {
            categoryBtn.innerHTML = `<i class="fas fa-layer-group"></i> Category: ${labelText}`;
        } else if (type === 'date') {
            dateBtn.innerHTML = `<i class="far fa-calendar"></i> Date: ${labelText}`;
        }
    }

    // Fungsi jalankan pencarian
    function performSearch() {
        const query = searchInput.value.trim();
        const selectedCategory = getActiveFilter('data-category');
        const selectedDate = getActiveFilter('data-date');

        if (query.length === 0) {
            searchResults.innerHTML = '';
            emptyState.style.display = 'block';
            return;
        }

        emptyState.style.display = 'none';

        fetch(`/search-posts?query=${encodeURIComponent(query)}&category=${encodeURIComponent(selectedCategory)}&date=${encodeURIComponent(selectedDate)}`)
            .then(response => response.json())
            .then(data => {
                searchResults.innerHTML = '';

                if (data.length === 0) {
                    searchResults.innerHTML = '<p class="text-white">No results found.</p>';
                    return;
                }

                data.forEach(post => {
                    const card = `
                        <div class="card mb-2 bg-dark text-white">
                            <div class="card-body">
                                <h5 class="card-title">${post.title}</h5>
                                <p class="card-text">${post.excerpt}</p>
                                <a href="/post/${post.slug}" class="btn btn-sm btn-primary">Read more</a>
                            </div>
                        </div>
                    `;
                    searchResults.innerHTML += card;
                });
            });
    }

    // Event: Ketik pencarian
    searchInput.addEventListener('input', performSearch);

    // Event: Klik kategori
    categoryItems.forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            categoryItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');

            const label = this.textContent.trim();
            updateDropdownLabel('category', label);

            performSearch();
        });
    });

    // Event: Klik tanggal
    dateItems.forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            dateItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');

            const label = this.textContent.trim();
            updateDropdownLabel('date', label);

            performSearch();
        });
    });
</script>






    @yield('script')
</body>

</html>
