<?php

namespace App\Providers;

use App\Models\administrativo;
use App\Models\doctor;
use App\Models\paciente;
use App\Models\turno;
use App\Models\User;
use App\Observers\administrativoObserver;
use App\Observers\doctorObserver;
use App\Observers\pacienteObserver;
use App\Observers\turnoObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        Login::class => [
            'App\Listeners\SuccessfulLogin',
        ],
        Logout::class => [
            'App\Listeners\SuccessfulLogout',
        ],
    ];
    protected $observers = [
        turno::class => [turnoObserver::class],
        User::class => [UserObserver::class],
        paciente::class => [pacienteObserver::class],
        doctor::class => [doctorObserver::class],
        administrativo::class => [administrativoObserver::class],
    ];
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        turno::observe(turnoObserver::class);
        User::observe(UserObserver::class);
        paciente::observe(pacienteObserver::class);
        doctor::observe(doctorObserver::class);
        administrativo::observe(administrativoObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
