<div class="col-lg-8 oredoo-content">
    <div class="theiaStickySidebar">
        @forelse ($posts as $post)
        <div class="glass-card mb-4 position-relative overflow-hidden">
            <!-- Category Badge -->
            <div class="position-absolute start-0 top-0 m-3 z-2">
                <a href="{{ route('frontend.category', $post->category->slug) }}"
                   class="badge rounded-pill text-white px-3 py-2"
                   style="background-color: #2F1953;">
                    {{ $post->category->title }}
                </a>
            </div>

            <!-- Post Image -->
            <div class="glass-card-img">
                <a href="{{ route('frontend.post', $post->slug) }}">
                    <img src="{{ asset('uploads/post/'.$post->thumbnail) }}"
                         alt="{{ $post->title }}"
                         class="img-fluid">
                </a>
            </div>

            <!-- Post Content -->
            <div class="glass-card-content p-4">
                <h5 class="text-white mb-3">
                    <a href="{{ route('frontend.post', $post->slug) }}"
                       class="text-white text-decoration-none">
                        {{ $post->title }}
                    </a>
                </h5>

                <!-- Additional Info (optional) -->
                <div class="d-flex align-items-center text-white-50 small">
                    <span class="me-3">
                        <i class="far fa-clock me-1"></i>
                        {{ $post->created_at->diffForHumans() }}
                    </span>
                    <span>
                        <i class="far fa-eye me-1"></i>
                        {{ $post->views ?? 0 }} views
                    </span>
                </div>
            </div>

            <!-- Glassmorphism Overlay -->
            <div class="glass-overlay"></div>
        </div>
        @empty
        <div class="glass-card p-4 text-center text-white">
            No posts found!
        </div>
        @endforelse

        <!-- Pagination -->
        <div class="pagination mt-4">
            {{ $posts->links("vendor.pagination.custom") }}
        </div>
    </div>
</div>

<style>
    .glass-card {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(22px);
        background: rgba(255, 255, 255, 0.39);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        transition: all 0.3s ease;
    }

    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.25);
    }

    .glass-card-img {
        height: 200px;
        overflow: hidden;
    }

    .glass-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .glass-card:hover .glass-card-img img {
        transform: scale(1.05);
    }

    .glass-card-content {
        position: relative;
        z-index: 2;
    }

    .glass-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg,
                      rgba(47, 25, 83, 0.4) 0%,
                      rgba(76, 45, 122, 0.2) 100%);
        z-index: 1;
    }

    .pagination .page-link {
        color: white;
        background-color: rgba(47, 25, 83, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .pagination .page-item.active .page-link {
        background-color: rgba(47, 25, 83, 0.7);
        border-color: rgba(255, 255, 255, 0.2);
    }

    .pagination .page-link:hover {
        background-color: rgba(47, 25, 83, 0.5);
    }
</style>
