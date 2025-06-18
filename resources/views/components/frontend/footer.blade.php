<footer class="simple-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Column 1: Brand Info -->
            <div class="footer-col">
                <h3>{{ $sitesettings->site_title ?? 'TrixNews' }}</h3>
                <p>{{ $sitesettings->description ?? 'Your trusted source for cryptocurrency news.' }}</p>


            </div>

<!-- Column 2: Categories -->
<div class="footer-col">
    <h4>Categories</h4>
    <ul>
        @foreach ($menuCategories as $category)
            <li>
                <a href="{{ route('frontend.category', $category->slug) }}">
                    {{ $category->title }}
                </a>
            </li>
        @endforeach
    </ul>
</div>


            <!-- Column 3: Company Links -->
            <div class="footer-col">
                <h4>Sosial Media Kami</h4>
              <div class="social-links">
    @foreach ($socialmedia as $media)
        <a href="{{ $media->link }}" target="_blank">
            <i class="fab fa-{{ strtolower($media->icon) }}"></i>
        </a>
    @endforeach
</div>

            </div>
        </div>

        <!-- Copyright -->
        <div class="copyright">
            {{ $sitesettings->copyright_text ?? '© 2025 TrixNews. All rights reserved.' }}
        </div>
    </div>
</footer>

<style>
    .simple-footer {
        background: #222;
        color: #fff;
        padding: 2rem 0;
        font-size: 0.9rem;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .footer-col h3, .footer-col h4 {
        color: #fff;
        margin-bottom: 1rem;
    }

    .footer-col p {
        color: #aaa;
        margin-bottom: 1rem;
        line-height: 1.5;
    }

    .footer-col ul {
        list-style: none;
        padding: 0;
    }

    .footer-col li {
        margin-bottom: 0.5rem;
    }

    .footer-col a {
        color: #aaa;
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer-col a:hover {
        color: #fff;
    }

    .social-links {
        display: flex;
        gap: 1rem;
    }

    .social-links a {
        color: #fff;
        font-size: 1.2rem;
    }

    .copyright {
        text-align: center;
        color: #666;
        padding-top: 1rem;
        border-top: 1px solid #333;
    }

    .social-links {
    display: flex;
    gap: 1rem;
}

.social-links a {
    background: #444;
    color: #fff;
    font-size: 1.5rem; /* lebih besar */
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
    text-decoration: none;
}

.social-links a:hover {
    background: #fff;
    color: #222;
}

</style>
