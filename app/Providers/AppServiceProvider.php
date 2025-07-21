<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Midtrans\Config;

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
            View::share('menuCategories', Category::withCount('posts')->where('status', true)->orderByDesc('posts_count')->limit(5)->get());
        }

        Paginator::useBootstrapFour();
        Paginator::useBootstrapFour();

        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key'); // optional
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
}
