<?php

namespace App\Providers;

use App\Contracts\Repositories as Repositories;
use App\Contracts\Services as Services;
use App\Eloquent\Repositories as RepositoryEloquent;
use App\Eloquent\Services as ServiceEloquent;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        Repositories\UserRepositoryInterface::class => RepositoryEloquent\UserRepository::class,

        Services\AuthenticationServiceInterface::class => ServiceEloquent\AuthenticationService::class,
        Services\UserServiceInterface::class => ServiceEloquent\UserService::class,
    ];

    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
