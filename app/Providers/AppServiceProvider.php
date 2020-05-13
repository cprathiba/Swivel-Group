<?php

namespace App\Providers;

use App\Services\OrganizationService;
use App\Services\TicketService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('User', function ($app) {
            return new UserService();
        });

        $this->app->singleton('Organization', function ($app) {
            return new OrganizationService();
        });

        $this->app->singleton('Ticket', function ($app) {
            return new TicketService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
