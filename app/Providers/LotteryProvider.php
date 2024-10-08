<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LotteryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Interfaces\LotteriesInterfaces\LotteryInterface::class,
            \App\Repositories\App\LotteriesRepositories\LotteryRepository::class,
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
