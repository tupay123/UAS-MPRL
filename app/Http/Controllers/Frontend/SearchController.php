<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;

use Illuminate\Support\Carbon;
class SearchController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('status', true)->orderBy('title', 'ASC')->limit(10)->get();

        if ($request->q) {
            $query = $request->q;
            $posts = Post::with('category')
                ->whereStatus(true)
                ->where('title', 'LIKE', "%{$query}%")
                ->orWhere('title', 'LIKE', "%{$query}%")
                ->orderBy('id', 'DESC')
                ->paginate(10);
            return view('frontend.search.index', compact('posts', 'query','categories'));
        }
        return redirect()->route('frontend.home');
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $categorySlug = $request->input('category');
        $dateFilter = $request->input('date');

        $posts = Post::with('category')
            ->where('status', true)
            ->when($categorySlug, function ($q) use ($categorySlug) {
                $q->whereHas('category', function ($subQuery) use ($categorySlug) {
                    $subQuery->where('slug', $categorySlug);
                });
            })
            ->when($dateFilter, function ($q) use ($dateFilter) {
                if ($dateFilter === 'today') {
                    $q->whereDate('created_at', Carbon::today());
                } elseif ($dateFilter === 'this_week') {
                    $q->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                } elseif ($dateFilter === 'this_month') {
                    $q->whereMonth('created_at', Carbon::now()->month);
                }
            })
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")->orWhere('content', 'like', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($post) {
                return [
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'excerpt' => Str::limit(strip_tags($post->content), 100),
                    'category' => $post->category?->title,
                    'created_at' => $post->created_at->toDateTimeString(),
                ];
            });

        return response()->json($posts);
    }
}
