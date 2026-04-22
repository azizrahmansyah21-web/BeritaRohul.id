<?php

namespace App\Providers;

use App\Services\Frontend\Posts\Cache\PostCachingService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(PostCachingService::class, function () {
            return new PostCachingService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $postCachingService = app(PostCachingService::class);

        $latestCachedPosts = $postCachingService->cache_latest_posts();
        $cachedPosts = $postCachingService->cache_read_more_posts();
        $cached_popular_posts = $postCachingService->cache_popular_posts();

        View::share([
            'latestCachedPosts' => $latestCachedPosts,
            'cachedPosts' => $cachedPosts,
            'cachedPopularPosts' => $cached_popular_posts,
        ]) ;
    }
}
