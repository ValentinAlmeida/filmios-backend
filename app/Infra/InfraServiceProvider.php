<?php

namespace App\Infra;

use App\Core\Contracts\UnitOfWorkInterface;
use App\Core\UnitOfWork\UnitOfWork;
use Illuminate\Support\ServiceProvider;

class InfraServiceProvider extends ServiceProvider
{
    public $singletons = [
        UnitOfWorkInterface::class => UnitOfWork::class,
    ];

    /**
     * Register any Module services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any Module services.
     */
    public function boot(): void
    {
        //
    }
}
