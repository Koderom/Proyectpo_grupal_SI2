<?php

namespace App\Providers;

use App\Models\turno;
use App\Observers\turnoObserver;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    protected $observers = [
        turno::class => [turnoObserver::class],
    ];
    
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Carbon::setLocale('es');
        setlocale(LC_TIME, 'es_ES.utf8');

        turno::observe(turnoObserver::class);
    }
}
