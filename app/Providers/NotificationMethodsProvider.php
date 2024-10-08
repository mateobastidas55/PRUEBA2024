<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NotificationMethodsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Interfaces\NotificationMethodsInterfaces\NotificationMethodsInterface::class,
            \App\Repositories\App\NotificationMethodsRepositories\NotificationMethodsRepository::class,
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
