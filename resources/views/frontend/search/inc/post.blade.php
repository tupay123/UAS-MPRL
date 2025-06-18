<div class="col-lg-8 oredoo-content">
    <div class="theiaStickySidebar">
        @forelse ($posts as $post)
        <div class="glass-card mb-3">
            <a href="{{ route('frontend.post', $post->slug) }}" class="glass-img">
                <img src="{{ asset('uploads/post/'.$post->thumbnail) }}" alt="{{ $post->title }}">
            </a>
            <div class="glass-body">
                <h5>
                    <a href="{{ route('frontend.post', $post->slug) }}">{{ $post->title }}</a>
                </h5>
                <a href="{{ route('frontend.category', $post->category->slug) }}" class="glass-category">
                    {{ $post->category->title }}
                </a>
            </div>
        </div>
        @empty
        <div class="glass-card p-3 text-center">
            <p>No post found!</p>
        </div>
        @endforelse

        <div class="glass-pagination mt-4">
            {{ $posts->links("vendor.pagination.custom") }}
        </div>
    </div>
</div>

<style>
    /* Simple Glassmorphism */
    .glass-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(8px);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
    }

    .glass-img img {
        width: 100%;
        height: auto;
        display: block;
    }

    .glass-body {
        padding: 15px;
        color: white;
    }

    .glass-body h5 a {
        color: white;
        text-decoration: none;
        font-weight: 600;
    }

    .glass-category {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        margin-top: 8px;
        text-decoration: none;
    }

    .glass-pagination .pagination {
        justify-content: center;
    }

    .glass-pagination .page-link {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin: 0 3px;
    }

    .glass-pagination .page-item.active .page-link {
        background: rgba(255, 255, 255, 0.3);
        border-color: white;
    }
</style>
