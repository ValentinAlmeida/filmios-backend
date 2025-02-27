<?php

namespace App\Providers;

use App\Models\EstablishmentActivityModel;
use App\Models\EstablishmentModel;
use App\Models\EstablishmentOpeningHoursModel;
use App\Models\RequestModel;
use App\Observers\EstablishmentActivityObserver;
use App\Observers\EstablishmentObserver;
use App\Observers\EstablishmentOpeningHoursObserver;
use App\Observers\RequestObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        EstablishmentActivityModel::observe(EstablishmentActivityObserver::class);
        EstablishmentOpeningHoursModel::observe(EstablishmentOpeningHoursObserver::class);
        EstablishmentModel::observe(EstablishmentObserver::class);
        RequestModel::observe(RequestObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
