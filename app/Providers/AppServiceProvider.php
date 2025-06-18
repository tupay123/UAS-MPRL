<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    if (Schema::hasTable('categories')) {
        View::share('menuCategories', Category::withCount('posts')
            ->where('status', true)
            ->orderByDesc('posts_count')
            ->limit(5)
            ->get());
    }


    Paginator::useBootstrapFour();
        Paginator::useBootstrapFour();
    }
}
