@if ($featuredposts->count() > 0)
    <section class="blog blog-home4 d-flex align-items-center justify-content-center">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel">
                        @foreach ($featuredposts as $featuredpost)
                            <div class="featured-news-card d-flex flex-md-row flex-column">
                                <div class="news-image-placeholder flex-shrink-0 col-md-5 col-12 p-0">
                                    <img src="{{ asset('uploads/post/' . $featuredpost->thumbnail) }}"
                                        alt="" srcset="">
                                </div>
                                <div class="news-content col-md-7 col-12">
                                    <div>
                                        <div class="news-badges">
                                            <a href="{{ route('frontend.category', $featuredpost->category->slug) }}">
                                                <span class="badge-featured">{{ $featuredpost->category->title }}</span>
                                            </a>
                                        </div>

                                        <h2 class="news-title"><a
                                                href="{{ route('frontend.post', $featuredpost->slug) }}"
                                                class="news-title-link">{{ Str::limit(strip_tags($featuredpost->title), 40)  }}</a></h2>
                                        <p class="news-description">
                                            {{ Str::limit(strip_tags($featuredpost->content), 200) }}
                                        </p>

                                        <div class="news-meta">
                                            <div class="meta-left">
                                                <span><i class="fas fa-user"></i> Admin</span>

                                            </div>
                                            <div class="meta-right">
                                                <span
                                                    class="time-ago">{{ $featuredpost->created_at->format('F d, Y') }}</span>
                                            </div>
                                        </div>
                                       <div class="news-tags">
                                            @foreach ($featuredpost->tags as $tag)
                                                <a href="{{ route('frontend.tag', Str::slug($tag->name)) }}" class="tag">#{{ $tag->name }}</a>
                                            @endforeach
                                        </div>


                                    </div>
                                    <a href="{{ route('frontend.post', $featuredpost->slug) }}">
                                        <div class="news-actions">
                                            <button class="action-btn"><i class="fas fa-book-reader"></i> Baca
                                                Selengkapnya</button>
                                            <button class="action-btn"><i class="fas fa-share-alt"></i> Bagikan</button>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
