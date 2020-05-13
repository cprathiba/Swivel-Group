<?php

namespace App\Providers;

use App\Repository\OrganizationRepository;
use App\Repository\OrganizationRepositoryInterface;
use App\Repository\TicketRepository;
use App\Repository\TicketRepositoryInterface;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
        $this->app->bind(OrganizationRepositoryInterface::class, OrganizationRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
