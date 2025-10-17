<?php

namespace App\Providers;

use App\Core\Repositories\Interfaces\IPostRepository;
use App\Core\Repositories\Interfaces\IUserRepository;
use App\Core\Repositories\PostRepository;
use App\Core\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IPostRepository::class, PostRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
