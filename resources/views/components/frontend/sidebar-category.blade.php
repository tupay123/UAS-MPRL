<div class="widget glass-widget mb-4">
    <div class="widget-title">
        <h5 class="text-white mb-3"><i class="fas fa-tags me-2"></i>Categories</h5>
    </div>
    @if ($categories->count() > 0)
    <div class="widget-categories">
        @foreach ($categories as $category)
        <a class="glass-category-card" href="{{ route('frontend.category', $category->slug) }}">
            <div class="glass-category-content">
                <div class="glass-category-image">
                    <img src="{{ asset('uploads/category/'.($category->image ?? 'default.webp')) }}"
                         alt="{{ $category->title }}"
                         class="glass-category-img">
                </div>
                <div class="glass-category-info">
                    <span class="glass-category-title">{{ $category->title }}</span>
                    <span class="glass-category-count">{{ $category->posts_count }} posts</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @else
    <div class="glass-empty-state text-white p-3 rounded text-center">
        <i class="fas fa-inbox me-2"></i>No categories found!
    </div>
    @endif
</div>

<style>
    .glass-widget {
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
    }

    .widget-categories {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .glass-category-card {
        display: block;
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-radius: 12px;
        padding: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .glass-category-card:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(47, 25, 83, 0.2);
    }

    .glass-category-content {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .glass-category-image {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        overflow: hidden;
        flex-shrink: 0;
        background: rgba(255, 255, 255, 0.2);
    }

    .glass-category-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .glass-category-info {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .glass-category-title {
        color: white;
        font-weight: 500;
        font-size: 0.95rem;
        margin-bottom: 2px;
    }

    .glass-category-count {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.8rem;
    }

    .glass-empty-state {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
</style>
