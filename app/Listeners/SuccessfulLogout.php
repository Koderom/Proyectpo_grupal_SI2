<?php

namespace App\Listeners;

use App\Models\bitacora;
use Carbon\Carbon;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SuccessfulLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        $Mytime = Carbon::now('America/La_Paz');
        $usuario = $event->user;

        $bitacora = new bitacora();
        $bitacora->verbo = 'Logout';
        $bitacora->fecha_hora = $Mytime->toDateTimeString();
        $bitacora->user_id = $usuario->id;
        $bitacora->user_name = $usuario->name;
        $bitacora->persona_id = $usuario->persona->id;
        $bitacora->nombre_completo = $usuario->persona->nombre;
        $bitacora->save();
    }
}
