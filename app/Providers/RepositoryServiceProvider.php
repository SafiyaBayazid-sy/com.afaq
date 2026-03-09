<?php

namespace App\Providers;

use App\Interfaces\RepositoryInterface;
use App\Repositories\BaseRepository;
use App\Repositories\Api\CustomerRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RepositoryInterface::class, BaseRepository::class);
        $this->app->singleton(CustomerRepository::class, function ($app) {
            return new CustomerRepository(new \App\Models\Customer());
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}