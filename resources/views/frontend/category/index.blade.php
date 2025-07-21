@extends("frontend.master")

@section("title", $category->title." - ".config('app.sitesettings')::first()->site_title)

@section("content")
<style>
   .white{
        color: white !important
    }
    a{color: white !important}
</style>
<div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title ">
                         <h1 class="white">{{ $category->title }}</h1>
                         <p class="links white"><a class="white" href="{{ route("frontend.home") }}">Home <i class="las la-angle-right"></i></a> {{ $category->title }}</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>
<section class="blog-layout-2">
    <div class="container py-4">
        <div class="trending-header">
            <i class="fas fa-chart-line me-2"></i>
            Trending Now
        </div>

        <div class="row">
            @forelse ($posts->sortByDesc('views') as $post)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="trending-card2">
                        <div class="trending-badge">#{{ $loop->iteration }} Trending</div>

                        <div class="card-image-placeholder">
                            <a href="{{ route('frontend.post', $post->slug) }}">
                                <img src="{{ asset('uploads/post/' . $post->thumbnail) }}" alt="{{ $post->title }}">
                            </a>
                        </div>
                        <div style="padding: 0.5rem 1.5rem 1.5rem 1.5rem;">
                            <a href="{{ route('frontend.category', $post->category->slug) }}">
                                <div class="category-badge">{{ $post->category->title }}</div>
                            </a>

                            <h3 class="card-title">
                                <a href="{{ route('frontend.post', $post->slug) }}" class="card-title-link">
                                    {{ Str::limit(strip_tags($post->title), 44) }}
                                </a>
                            </h3>

                            <p class="card-description">
                                {{ \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?? $post->content), 100) }}
                            </p>

                            <div class="card-meta">
                                <span>By {{ $post->user->name ?? 'Admin' }}</span>
                                <span>{{ round(str_word_count(strip_tags($post->content ?? '')) / 200) ?: 1 }} min read</span>
                            </div>
                            


                            @if($post->tags && count($post->tags) > 0)
                                <div class="news-tags">
                                    @foreach ($post->tags as $tag)
                                        <a href="{{ route('frontend.tag', Str::slug($tag->name)) }}" class="tag">#{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            @endif

                            <div class="card-footer">
                                <span>{{ $post->created_at->diffForHumans() }}</span>
                                <div class="stats">
                                    <div class="stat-item">
                                        <i class="fas fa-eye"></i>
                                        <span>{{ $post->views ?? '0' }}</span>
                                    </div>
                                    <div class="stat-item">
                                        <i class="fas fa-comment"></i>
                                        <span>{{ $post->comments_count ?? 0 }}</span>
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
</section>
<div class="pagination">
    <div class="container-fluid">
        <div class="pagination-area">
            <div class="row">
                <div class="col-lg-12">
                    {{ $posts->links("vendor.pagination.custom") }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
