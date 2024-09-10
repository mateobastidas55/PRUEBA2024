<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UsersRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Interfaces\UserInterfaces\UserInterface::class,
            \App\Repositories\App\UserRepositories\UserRepository::class,
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
