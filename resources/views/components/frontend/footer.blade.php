<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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

            @php
        $socialMediaIcons = [
                'facebook' => 'facebook',
                'twitter' => 'twitter',
                'instagram' => 'instagram',
                'youtube' => 'youtube',
                'linkedin' => 'linkedin',
                'tiktok' => 'tiktok',
                'whatsapp' => 'whatsapp',
                'telegram' => 'telegram',
                // Tambahkan mapping lainnya sesuai kebutuhan
            ];
        @endphp

            <!-- Column 3: Company Links -->
            <div class="footer-col">
                <h4>Sosial Media Kami</h4>
                <div class="social-links">
                    @foreach ($socialmedia as $media)
                        <a href="{{ $media->link }}" target="_blank" title="{{ $media->title }}">
                            <i class="bi bi-{{ $socialMediaIcons[strtolower($media->title)] ?? 'share' }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="copyright" style="color: whitesmoke">
            {{ $sitesettings->copyright_text ?? '© 2025 TrixNews. All rights reserved.' }}
        </div>
    </div>
</footer>

<style>
    .simple-footer {
        padding: 1.5rem;
        background: rgba(255, 255, 255, 0.041);
        backdrop-filter: blur(10px);
    }

    .trending-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        color: white;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .footer-col h3,
    .footer-col h4 {
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
        gap: 1.5rem; /* Jarak antar ikon diperbesar */
    }

    .social-links a {
        color: #fff;
        font-size: 1.5rem;
        transition: all 0.3s ease;
        text-decoration: none;
        /* Hapus properti background dan border-radius */
        background: transparent !important;
        width: auto;
        height: auto;
    }

    .social-links a:hover {
        color: #b3a2a2; /* Warna saat hover */
        transform: translateY(-3px); /* Efek mengambang */
        background: transparent !important;
    }

    /* Tambahkan efek glow pada hover */
    .social-links a:hover i {
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.7);
    }

    .copyright {
        text-align: center;
        color: #666;
        padding-top: 1rem;
        border-top: 1px solid #b3a2a2;
    }


</style>
