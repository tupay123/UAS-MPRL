<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Tetap ambil recentposts kayak biasa
        $recentposts = Post::with('category', 'user', 'tags')
            ->where('status', true)
            ->where('created_at', '>=', Carbon::now()->subMonth())
            ->orderBy('views', 'DESC')
            ->paginate(6);

        // Ambil 13 post terbaru, lalu bagi 6 untuk latestNews, sisanya untuk beritapilihan
        $baseLatest = Post::with('category', 'user', 'tags')->where('status', true)->latest()->take(13)->get();

        $latestNews = $baseLatest->take(4); // index 0-5
        $beritapilihan = $baseLatest->slice(4, 6); // index 6-12

        $featuredposts = Post::with(['category', 'user', 'tags'])
            ->where('status', true)
            ->where('is_featured', true)
            ->orderBy('id', 'DESC')
            ->limit(10)
            ->get();

        $categories = Category::where('status', true)->orderBy('title', 'ASC')->limit(10)->get();

        return view('frontend.home.index', compact('recentposts', 'latestNews', 'beritapilihan', 'featuredposts', 'categories'));
    }
}
