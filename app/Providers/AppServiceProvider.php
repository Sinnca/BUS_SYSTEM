<?php

namespace App\Providers;

use App\Services\ScheduleGeneratorService;
use Illuminate\Support\ServiceProvider;
use App\Services\BookingService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register BookingService as singleton
        // This ensures only one instance exists throughout the request
        $this->app->singleton(BookingService::class, function ($app) {
            return new BookingService();
        });
        $this->app->singleton(ScheduleGeneratorService::class, function ($app) {
            return new ScheduleGeneratorService();
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
