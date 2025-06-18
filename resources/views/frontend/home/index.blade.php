@extends('frontend.master')

@section('title', config('app.sitesettings')::first()->site_title . ' - ' .
    config('app.sitesettings')::first()->tagline)

@section('content')
    {{-- <!-- Featured News Card -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                 @foreach ($featuredposts as $featuredpost)
                    <div class="featured-news-card d-flex flex-md-row flex-column ">
                        <div class="news-image-placeholder flex-shrink-0 col-md-5 col-12">
                        <img src="image.png" alt="" srcset="">
                        </div>
                        <div class="news-content col-md-7 col-12">
                            <div>
                                <div class="news-badges">
                                    <span class="badge-featured">Featured</span>
                                    <span class="badge-bitcoin">Bitcoin</span>
                                </div>

                                <h2 class="news-title"><a href="{{ route("frontend.post", $featuredpost->slug) }}" class="news-title-link">{{ $featuredpost->title }}</a></h2>
                                <p class="news-description">
                                    Ini adalah deskripsi singkat dari berita yang sedang ditampilkan. Isinya menjelaskan
                                    highlight utama dari artikel atau peristiwa.
                                </p>
                                <div class="news-meta">
                                    <div class="meta-left">
                                        <span><i class="fas fa-user"></i> Admin</span>

                                    </div>
                                    <div class="meta-right">
                                        <span class="time-ago">2 jam yang lalu</span>
                                    </div>
                                </div>
                                <div class="news-tags">
                                    <span class="tag">#Crypto</span>
                                    <span class="tag">#Blockchain</span>
                                    <span class="tag">#Keuangan</span>
                                </div>
                            </div>
                            <div class="news-actions">
                                <button class="action-btn"><i class="fas fa-book-reader"></i> Baca Selengkapnya</button>
                                <button class="action-btn"><i class="fas fa-share-alt"></i> Bagikan</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div> --}}
    @include('frontend.home.inc.featuredpost')
    @include('frontend.home.inc.category')


    <div class="container py-4">
        <div class="trending-header">
            <i class="fas fa-chart-line me-2"></i>
            Trending Now
        </div>

        <div class="row">
            @forelse ($recentposts->sortByDesc('views') as $recentpost)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="trending-card2">
                        <div class="trending-badge">#{{ $loop->iteration }} Trending</div>

                        <div class="card-image-placeholder">
                            <a href="{{ route('frontend.post', $recentpost->slug) }}">
                                <img src="{{ asset('uploads/post/' . $recentpost->thumbnail) }}"
                                    alt="{{ $recentpost->title }}">
                            </a>
                        </div>
                        <div style="padding: 0.5rem 1.5rem 1.5rem 1.5rem;">
                            <a href="{{ route('frontend.category', $recentpost->category->slug) }}">
                                <div class="category-badge">{{ $recentpost->category->title }}</div>
                            </a>

                            <h3 class="card-title">

                                <a href="{{ route('frontend.post', $recentpost->slug) }}" class="card-title-link">
                                    {{ Str::limit(strip_tags($recentpost->title), 44) }}
                                </a>
                            </h3>

                            <p class="card-description">
                                {{ \Illuminate\Support\Str::limit(strip_tags($recentpost->excerpt ?? $recentpost->content), 100) }}
                            </p>

                            <div class="card-meta">
                                <span>By {{ $recentpost->user->name ?? 'Admin' }}</span>
                                <span>{{ round(str_word_count(strip_tags($recentpost->content ?? '')) / 200) ?: 1 }} min
                                    read</span>
                            </div>

                            <div class="news-tags">
                                @foreach ($recentpost->tags as $tag)
                                    <a href="{{ route('frontend.tag', Str::slug($tag->name)) }}"
                                        class="tag">#{{ $tag->name }}</a>
                                @endforeach
                            </div>

                            <div class="card-footer">
                                <span>{{ $recentpost->created_at->diffForHumans() }}</span>
                                <div class="stats">
                                    <div class="stat-item">
                                        <i class="fas fa-eye"></i>
                                        <span>{{ $recentpost->views ?? '0' }}</span>
                                    </div>
                                    <div class="stat-item">
                                        <i class="fas fa-comment"></i>
                                        <span>{{ $recentpost->comments_count ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            @empty
                <p class="text-muted">No post found!</p>
            @endforelse
        </div>
    </div>

    <div class="container py-4">
        <div class="trending-header">
            <i class="fas fa-chart-line me-2"></i>
            Berita Terbaru
        </div>

        <div class="row">
            @if ($latestNews->count())
                @foreach ($latestNews as $index => $news)
                    <div class="col-lg-12 col-md-12 mb-4">
                        <div class="trending-card">
                            <div class="row">
                                <div class="col-9">
                                    <div class="category-badge">{{ $news->category->title ?? '-' }}</div>
                                    <span>By {{ $news->user->name ?? 'Admin' }}</span>
                                    <h3 class="card-title">
                                        <a href="{{ route('frontend.post', $news->slug) }}" class="card-title-link">
                                            {{ $news->title }}
                                        </a>
                                    </h3>

                                    <p class="card-description">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($news->excerpt ?? $news->content), 100) }}
                                    </p>
                                </div>
                                <div class="col-3">
                                    <div class="card-image-placeholder2">
                                        <a href="{{ route('frontend.post', $news->slug) }}">
                                            <img src="{{ asset('uploads/post/' . $news->thumbnail) }}"
                                                alt="{{ $news->title }}" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <span>{{ $news->created_at->diffForHumans() }}</span>
                                    <div class="stats">
                                        <div class="stat-item">
                                            <i class="fas fa-eye"></i>
                                            <span>{{ $news->views ?? 0 }}</span>
                                        </div>
                                        <div class="stat-item">
                                            <i class="fas fa-comment"></i>
                                            <span>{{ $news->comments_count ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <p class="text-muted">Tidak ada berita terbaru saat ini.</p>
                </div>
            @endif
        </div>
    </div>

    <div class="container py-4">
        <div class="trending-header">
            <i class="fas fa-chart-line me-2"></i>
            Berita Pilihan
        </div>

        <div class="row">
            @forelse ($beritapilihan->sortByDesc('views') as $recentpost)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="trending-card2">

                        <div class="card-image-placeholder">
                            <a href="{{ route('frontend.post', $recentpost->slug) }}">
                                <img src="{{ asset('uploads/post/' . $recentpost->thumbnail) }}"
                                    alt="{{ $recentpost->title }}">
                            </a>
                        </div>
                        <div style="padding: 0.5rem 1.5rem 1.5rem 1.5rem;">
                            <a href="{{ route('frontend.category', $recentpost->category->slug) }}">
                                <div class="category-badge">{{ $recentpost->category->title }}</div>
                            </a>

                            <h3 class="card-title">

                                <a href="{{ route('frontend.post', $recentpost->slug) }}" class="card-title-link">
                                    {{ Str::limit(strip_tags($recentpost->title), 44) }}
                                </a>
                            </h3>

                            <p class="card-description">
                                {{ \Illuminate\Support\Str::limit(strip_tags($recentpost->excerpt ?? $recentpost->content), 100) }}
                            </p>

                            <div class="card-meta">
                                <span>By {{ $recentpost->user->name ?? 'Admin' }}</span>
                                <span>{{ round(str_word_count(strip_tags($recentpost->content ?? '')) / 200) ?: 1 }} min
                                    read</span>
                            </div>

                            <div class="news-tags">
                                @foreach ($recentpost->tags as $tag)
                                    <a href="{{ route('frontend.tag', Str::slug($tag->name)) }}"
                                        class="tag">#{{ $tag->name }}</a>
                                @endforeach
                            </div>

                            <div class="card-footer">
                                <span>{{ $recentpost->created_at->diffForHumans() }}</span>
                                <div class="stats">
                                    <div class="stat-item">
                                        <i class="fas fa-eye"></i>
                                        <span>{{ $recentpost->views ?? '0' }}</span>
                                    </div>
                                    <div class="stat-item">
                                        <i class="fas fa-comment"></i>
                                        <span>{{ $recentpost->comments_count ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            @empty
                <p class="text-muted">No post found!</p>
            @endforelse
        </div>
    </div>



    <div class="container mb-5">
        <!-- Newsletter Section -->
        <section class="trending-card text-center">
            <div class="container py-5">
                <h1 class="newsletter-title text-white">Stay Updated</h1>
                <p>
                    Get the latest crypto news and breaking stories delivered directly
                    to your inbox every morning.
                </p>

                <div class="newsletter-form">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-md-4">
                            <input type="text" class="form-control form-email" placeholder="Enter Your Email">
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="btn btn-gradient w-100 text-white">Subscribe</a>
                        </div>
                    </div>
                </div>

                <p class="mt-3 card-description">
                    Join 100,000+ crypto enthusiasts. Unsubscribe anytime.
                </p>
            </div>
        </section>
    </div>





    {{-- <section class="section-feature-1">
    <div class="container-fluid">
        <div class="row">
            @include("frontend.home.inc.recentpost")
            @include("frontend.home.inc.sidebar")
        </div>
    </div>
</section> --}}
@endsection
