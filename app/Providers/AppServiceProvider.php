<?php

namespace App\Providers;

use App\Domain\Billing\BillingService;
use App\Domain\Company\Repositories\CompanyRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\UserRegistered;
use App\Infrastructure\Billing\Cashier\CashierBillingService;
use App\Infrastructure\Persistence\Eloquent\CompanyRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            BillingService::class,
            CashierBillingService::class,
        );

        $this->app->bind(
            CompanyRepositoryInterface::class,
            CompanyRepository::class
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
