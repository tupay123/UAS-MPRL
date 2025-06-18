<style>
    .glass-widget {
        padding: 16px; /* Dikurangi dari 24px */
        border-radius: 16px; /* Sedikit lebih kecil */
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(12px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2); /* Shadow lebih subtle */
        margin-bottom: 16px; /* Dikurangi */
        color: #fff;
    }

    .glass-title {
        font-size: 18px; /* Sedikit lebih kecil */
        font-weight: 600;
        margin-bottom: 12px; /* Dikurangi */
        color: #ffffff;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding-bottom: 6px; /* Dikurangi */
    }

    .glass-tag-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 8px; /* Dikurangi dari 12px */
    }

    .glass-tag-list li a {
        display: inline-block;
        padding: 2px 10px; /* Tetap compact */
        font-size: 13px; /* Sedikit lebih kecil */
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.12);
        color: #fff;
        text-decoration: none;
        transition: all 0.2s ease; /* Animasi lebih cepat */
    }

    .glass-tag-list li a:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: scale(1.03); /* Efek hover lebih subtle */
    }

    .no-tag {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.7);
        margin-top: 4px; /* Dikurangi */
    }
</style>

<div class="widget glass-widget">
    <div class="widget-title">
        <h5 class="glass-title">Tags</h5>
    </div>
    <div class="widget-tags">
        @if ($tags->count())
            <ul  class="glass-tag-list">
                @foreach ($tags as $tag)
                    <li style="border: none; padding:0%">
                        <a href="{{ route('frontend.tag', $str::slug($tag->name)) }}">{{ $tag->name }}</a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="no-tag">No tag found!</div>
        @endif
    </div>
</div>
