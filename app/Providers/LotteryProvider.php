<?php

namespace App\Providers;

use App\Repositories\App\LotteriesRepositories\LotteryRepository;
use App\Repositories\Interfaces\LotteriesInterfaces\LotteryInterface;


use App\Repositories\App\LotteriesRepositories\BuyLotteriesRepository;
use App\Repositories\Interfaces\LotteriesInterfaces\BuyLotteriesInterface;
use Illuminate\Support\ServiceProvider;

class LotteryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            LotteryInterface::class,
            LotteryRepository::class,
        );

        $this->app->bind(
            BuyLotteriesInterface::class,
            BuyLotteriesRepository::class,
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
