<div class="col-lg-8 oredoo-content">
    <div class="theiaStickySidebar">
        @forelse ($posts as $post)
        <div class="simple-glass-post {{ $loop->first ? 'pt-0' : '' }}">
            <div class="simple-post-image">
                <a href="{{ route('frontend.post', $post->slug) }}">
                    <img src="{{ asset('uploads/post/'.$post->thumbnail) }}" alt="{{ $post->title }}" />
                </a>
            </div>
            <div class="simple-post-content">
                <div class="simple-post-meta">
                    <a href="{{ route('frontend.category', $post->category->slug) }}" class="simple-post-category">
                        {{ $post->category->title }}
                    </a>
                    <span class="simple-post-date">{{ $post->created_at->format('M d, Y') }}</span>
                </div>
                <h5 class="simple-post-title">
                    <a href="{{ route('frontend.post', $post->slug) }}">{{ $post->title }}</a>
                </h5>
                <a href="{{ route('frontend.post', $post->slug) }}" class="simple-read-more">
                    Read More <i class="las la-arrow-right"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="simple-no-post">No posts found</div>
        @endforelse

        <div class="simple-pagination">
            {{ $posts->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>

<style>
    /* Main Container */
    .simple-glass-post {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 15px;
        margin-bottom: 20px;
        display: flex;
        gap: 15px;
        transition: all 0.2s ease;
    }

    .simple-glass-post:hover {
        background: rgba(255, 255, 255, 0.12);
        transform: translateY(-2px);
    }

    /* Image */
    .simple-post-image {
        flex: 0 0 100px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
    }

    .simple-post-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .simple-post-image:hover img {
        transform: scale(1.05);
    }

    /* Content */
    .simple-post-content {
        flex: 1;
    }

    .simple-post-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
        font-size: 12px;
    }

    .simple-post-category {
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        padding: 3px 8px;
        border-radius: 4px;
        text-transform: uppercase;
    }

    .simple-post-date {
        color: rgba(255, 255, 255, 0.6);
    }

    .simple-post-title {
        margin: 0 0 8px 0;
        font-size: 16px;
    }

    .simple-post-title a {
        color: #fff;
        text-decoration: none;
    }

    .simple-read-more {
        display: inline-block;
        color: rgba(255, 255, 255, 0.8);
        font-size: 13px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .simple-read-more:hover {
        color: #fff;
        transform: translateX(3px);
    }

    /* No Posts */
    .simple-no-post {
        text-align: center;
        padding: 20px;
        color: rgba(255, 255, 255, 0.6);
        background: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
    }

    /* Pagination */
    .simple-pagination {
        margin-top: 20px;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .simple-glass-post {
            flex-direction: column;
            gap: 12px;
        }

        .simple-post-image {
            flex: 0 0 auto;
            width: 100%;
            height: 120px;
        }
    }
</style>
