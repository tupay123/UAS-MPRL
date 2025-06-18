<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($username) {
        $categories = Category::where('status', true)->orderBy('title', 'ASC')->limit(10)->get();

        $user = User::where("status", true)->where("username", $username)->first();
        if ($user) {
            $posts = $user->posts()->with("category")->where("status", true)->orderBy("id", "DESC")->paginate(10);
            return view("frontend.user.index", compact("user", "posts","categories"));
        }
        return abort(404);
    }
}
