<?php

namespace App\Blog\Infrastructure;

use App\Blog\Domain\Repository\UserRepositoryInterface;
use App\Blog\Infrastructure\Eloquent\UserEloquent;
use App\Blog\Infrastructure\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class InfrastructureProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            function ($app) {
                return new UserRepository(
                    new UserEloquent
                );
            }
        );
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