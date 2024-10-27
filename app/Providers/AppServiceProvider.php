<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Auction;
use App\Observers\AuctionObserver;


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
        Auction::observe(AuctionObserver::class);
    }
}
