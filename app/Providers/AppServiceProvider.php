<?php

namespace App\Providers;

use App\Core\Contracts\IAuthService;
use App\Core\Contracts\IPostService;
use App\Core\Services\Auth\AuthMobileService;
use App\Core\Services\Auth\AuthWebService;
use App\Core\Services\Post\PostMobileService;
use App\Core\Services\Post\PostWebService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IAuthService::class, function ($app) {
            $platform = request()?->attributes?->get('platform', 'web');
            return match ($platform) {
                'mobile' => $app->make(AuthMobileService::class),
                default => $app->make(AuthWebService::class),
            };
        });

        $this->app->bind(IPostService::class, function ($app) {
            $platform = request()?->attributes?->get('platform', 'web');
            return match ($platform) {
                'mobile' => $app->make(PostMobileService::class),
                default => $app->make(PostWebService::class),
            };
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
