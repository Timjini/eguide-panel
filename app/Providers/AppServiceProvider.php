<?php

namespace App\Providers;

use App\Domain\Billing\BillingService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\UserRegistered;
use App\Infrastructure\Billing\Cashier\CashierBillingService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            BillingService::class,
            CashierBillingService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(function (UserRegistered $event) {
            info('queued event here');
        });
    }
}
