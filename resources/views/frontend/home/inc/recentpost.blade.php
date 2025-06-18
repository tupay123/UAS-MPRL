<div class="col-lg-8 oredoo-content">
    <div class="theiaStickySidebar">
        <div class="glass-section-header mb-4">
            <h3 class="text-white">Recent Articles</h3>
            <p class="text-white-50">Discover the most outstanding articles in all topics of life.</p>
        </div>

        @forelse ($recentposts as $recentpost)
        <div class="glass-post-card mb-4">
            <div class="glass-post-image">
                <a href="{{ route('frontend.post', $recentpost->slug) }}">
                    <img src="{{ asset('uploads/post/'.$recentpost->thumbnail) }}"
                         alt="{{ $recentpost->title }}"
                         class="glass-post-img">
                    <div class="glass-image-overlay"></div>
                </a>
                <div class="glass-category-badge">
                    <a href="{{ route('frontend.category', $recentpost->category->slug) }}"
                       class="glass-category-link">
                        {{ $recentpost->category->title }}
                    </a>
                </div>
            </div>

            <div class="glass-post-content">
                <div class="glass-post-meta">
                    <span class="glass-post-date">
                        <i class="far fa-clock me-1"></i>
                        {{ $recentpost->created_at->format('F d, Y') }}
                    </span>
                    <span class="glass-post-views">
                        <i class="far fa-eye me-1"></i>
                        {{ $recentpost->views ?? 0 }} views
                    </span>
                </div>

                <h5 class="glass-post-title">
                    <a href="{{ route('frontend.post', $recentpost->slug) }}"
                       class="text-white text-decoration-none">
                        {{ $recentpost->title }}
                    </a>
                </h5>

                <div class="glass-post-excerpt">
                    {{ Str::limit(strip_tags($recentpost->excerpt ?? $recentpost->content), 150) }}
                </div>

                <div class="glass-read-more">
                    <a href="{{ route('frontend.post', $recentpost->slug) }}"
                       class="glass-read-btn">
                        Continue Reading <i class="las la-long-arrow-alt-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="glass-empty-state text-white p-4 text-center rounded">
            <i class="far fa-newspaper me-2"></i> No articles found!
        </div>
        @endforelse

        <div class="glass-pagination mt-4">
            {{ $recentposts->links("vendor.pagination.custom") }}
        </div>
    </div>
</div>

<style>
    .glass-section-header {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        background: rgba(47, 25, 83, 0.2);
        padding: 1.5rem;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .glass-post-card {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        background: rgba(47, 25, 83, 0.15);
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .glass-post-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(47, 25, 83, 0.2);
    }

    .glass-post-image {
        position: relative;
        height: 220px;
        overflow: hidden;
    }

    .glass-post-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .glass-post-card:hover .glass-post-img {
        transform: scale(1.05);
    }

    .glass-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(47, 25, 83, 0.5), transparent 50%);
    }

    .glass-category-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 2;
    }

    .glass-category-link {
        background: rgba(47, 25, 83, 0.9);
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .glass-category-link:hover {
        background: rgba(255, 255, 255, 0.9);
        color: #2F1953;
    }

    .glass-post-content {
        padding: 1.5rem;
    }

    .glass-post-meta {
        display: flex;
        gap: 15px;
        margin-bottom: 10px;
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.85rem;
    }

    .glass-post-title {
        color: white;
        margin-bottom: 15px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .glass-post-title:hover {
        color: rgba(255, 255, 255, 0.8);
    }

    .glass-post-excerpt {
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 15px;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .glass-read-more {
        margin-top: 15px;
    }

    .glass-read-btn {
        color: white;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .glass-read-btn:hover {
        color: rgba(255, 255, 255, 0.8);
        transform: translateX(5px);
    }

    .glass-empty-state {
        background: rgba(47, 25, 83, 0.2);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }

    .glass-pagination .page-link {
        color: white;
        background: rgba(47, 25, 83, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .glass-pagination .page-item.active .page-link {
        background: rgba(47, 25, 83, 0.7);
        border-color: rgba(255, 255, 255, 0.2);
    }
</style>
