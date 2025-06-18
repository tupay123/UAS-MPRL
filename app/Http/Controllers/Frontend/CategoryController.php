<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slug) {
        $category = Category::where("slug", $slug)->where("status", true)->first();
                $categories = Category::where('status', true)->orderBy('title', 'ASC')->limit(10)->get();

        if ($category) {
            $str = Str::class;
            $posts = $category->posts()->with(["category", "user"])->where("status", true)->orderBy("id", "DESC")->paginate(6);
            return view("frontend.category.index", compact("category", "posts", "str","categories"));
        }
        return abort(404);
    }
}
