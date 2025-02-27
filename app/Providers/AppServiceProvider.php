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
        Repositories\DomainRepositoryInterface::class => RepositoryEloquent\DomainRepository::class,
        Repositories\PermissionRepositoryInterface::class => RepositoryEloquent\PermissionRepository::class,
        Repositories\ResponsibleRepositoryInterface::class => RepositoryEloquent\ResponsibleRepository::class,
        Repositories\RequestRepositoryInterface::class => RepositoryEloquent\RequestRepository::class,
        Repositories\RequestHistoryRepositoryInterface::class => RepositoryEloquent\RequestHistoryRepository::class,
        Repositories\UnitAddressRepositoryInterface::class => RepositoryEloquent\UnitAddressRepository::class,
        Repositories\LegalGuardianRepositoryInterface::class => RepositoryEloquent\LegalGuardianRepository::class,
        Repositories\ActivityRepositoryInterface::class => RepositoryEloquent\ActivityRepository::class,
        Repositories\OpeningHoursRepositoryInterface::class => RepositoryEloquent\OpeningHoursRepository::class,
        Repositories\EstablishmentRepositoryInterface::class => RepositoryEloquent\EstablishmentRepository::class,
        Repositories\ServiceRepositoryInterface::class => RepositoryEloquent\ServiceRepository::class,

        Services\AuthenticationServiceInterface::class => ServiceEloquent\AuthenticationService::class,
        Services\UserServiceInterface::class => ServiceEloquent\UserService::class,
        Services\DomainServiceInterface::class => ServiceEloquent\DomainService::class,
        Services\PermissionServiceInterface::class => ServiceEloquent\PermissionService::class,
        Services\ResponsibleServiceInterface::class => ServiceEloquent\ResponsibleService::class,
        Services\RequestServiceInterface::class => ServiceEloquent\RequestService::class,
        Services\RequestHistoryServiceInterface::class => ServiceEloquent\RequestHistoryService::class,
        Services\UnitAddressServiceInterface::class => ServiceEloquent\UnitAddressService::class,
        Services\LegalGuardianServiceInterface::class => ServiceEloquent\LegalGuardianService::class,
        Services\ActivityServiceInterface::class => ServiceEloquent\ActivityService::class,
        Services\OpeningHoursServiceInterface::class => ServiceEloquent\OpeningHoursService::class,
        Services\EstablishmentServiceInterface::class => ServiceEloquent\EstablishmentService::class,
        Services\QrCodeServiceInterface::class => ServiceEloquent\QrCodeService::class,
        Services\ServiceRequestServiceInterface::class => ServiceEloquent\ServiceRequestService::class,
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
