<div class="widget glass-widget mb-4">
    <div class="widget-title">
        <h5 class="text-white"><i class="fas fa-fire me-2"></i>Popular Posts</h5>
    </div>
    <ul class="glass-popular-posts">
        @forelse ($popularposts as $popularpost)
            <li class="glass-popular-post">
                <div class="glass-post-number">
                    {{ $loop->iteration }}
                </div>
                <div class="glass-post-image">
                    <a href="{{ route('frontend.post', $popularpost->slug) }}">
                        <img src="{{ asset('uploads/post/'.$popularpost->thumbnail) }}"
                             alt="{{ $popularpost->title }}"
                             class="glass-post-thumbnail">
                        <div class="glass-image-overlay"></div>
                    </a>
                </div>
                <div class="glass-post-details">
                    <h6 class="glass-post-title">
                        <a href="{{ route('frontend.post', $popularpost->slug) }}"
                           class="text-white">
                            {{ Str::limit($popularpost->title, 50) }}
                        </a>
                    </h6>
                    <div class="glass-post-meta">
                        <span class="glass-post-date">
                            <i class="far fa-clock me-1"></i>
                            {{ $popularpost->created_at->diffForHumans() }}
                        </span>
                        <span class="glass-post-views">
                            <i class="far fa-eye me-1"></i>
                            {{ $popularpost->views ?? 0 }}
                        </span>
                    </div>
                </div>
            </li>
        @empty
            <li class="glass-empty-state text-white p-3 text-center">
                <i class="far fa-newspaper me-2"></i> No popular posts found
            </li>
        @endforelse
    </ul>
</div>

<style>
    .glass-widget {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        background: rgba(47, 25, 83, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
    }

    .glass-popular-posts {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .glass-popular-post {
        display: flex;
        align-items: center;
        gap: 12px;
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border-radius: 8px;
        padding: 10px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .glass-popular-post:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateX(5px);
    }

    .glass-post-number {
        font-size: 1.1rem;
        font-weight: bold;
        color: white;
        min-width: 24px;
        text-align: center;
        background: rgba(47, 25, 83, 0.7);
        border-radius: 4px;
        padding: 2px 5px;
    }

    .glass-post-image {
        position: relative;
        width: 60px;
        height: 60px;
        border-radius: 6px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .glass-post-thumbnail {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .glass-popular-post:hover .glass-post-thumbnail {
        transform: scale(1.1);
    }

    .glass-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, rgba(47, 25, 83, 0.3), transparent);
    }

    .glass-post-details {
        flex-grow: 1;
        min-width: 0;
    }

    .glass-post-title {
        margin: 0;
        font-size: 0.95rem;
        line-height: 1.4;
    }

    .glass-post-title a {
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .glass-post-title a:hover {
        color: rgba(255, 255, 255, 0.8);
    }

    .glass-post-meta {
        display: flex;
        gap: 12px;
        margin-top: 5px;
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .glass-empty-state {
        background: rgba(47, 25, 83, 0.2);
        border-radius: 8px;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
</style>
