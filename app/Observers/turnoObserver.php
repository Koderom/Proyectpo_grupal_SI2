<?php

namespace App\Observers;

use App\Models\bitacora;
use App\Models\turno;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class turnoObserver
{
    /**
     * Handle the turno "created" event.
     *
     * @param  \App\Models\turno  $turno
     * @return void
     */
    public function created(turno $turno)
    {
        $mTime = Carbon::now('America/La_Paz');
        $usuario = Auth::user();

        $bitacora = new bitacora();
        $bitacora->objeto = 'turnos';
        $bitacora->entidad_id = $turno->id;
        $bitacora->entidad_descripcion = $turno->descripcion;
        $bitacora->verbo = 'crear';
        $bitacora->fecha_hora = $mTime->toDateTimeString();
        $bitacora->user_id = $usuario->id;
        $bitacora->user_name = $usuario->name;
        $bitacora->persona_id = $usuario->persona->id;
        $bitacora->nombre_completo = $usuario->persona->nombre;
        $bitacora->save();
    }

    /**
     * Handle the turno "updated" event.
     *
     * @param  \App\Models\turno  $turno
     * @return void
     */
    public function updated(turno $turno)
    {
        $mTime = Carbon::now('America/La_Paz');
        $usuario = Auth::user();

        $bitacora = new bitacora();
        $bitacora->objeto = 'turnos';
        $bitacora->entidad_id = $turno->id;
        $bitacora->entidad_descripcion = $turno->descripcion;
        $bitacora->verbo = 'modificar';
        $bitacora->fecha_hora = $mTime->toDateTimeString();
        $bitacora->user_id = $usuario->id;
        $bitacora->user_name = $usuario->name;
        $bitacora->persona_id = $usuario->persona->id;
        $bitacora->nombre_completo = $usuario->persona->nombre;
        $bitacora->save();
    }

    /**
     * Handle the turno "deleted" event.
     *
     * @param  \App\Models\turno  $turno
     * @return void
     */
    public function deleted(turno $turno)
    {
        $mTime = Carbon::now('America/La_Paz');
        $usuario = Auth::user();

        $bitacora = new bitacora();
        $bitacora->objeto = 'turnos';
        $bitacora->entidad_id = $turno->id;
        $bitacora->entidad_descripcion = $turno->descripcion;
        $bitacora->verbo = 'eliminar';
        $bitacora->fecha_hora = $mTime->toDateTimeString();
        $bitacora->user_id = $usuario->id;
        $bitacora->user_name = $usuario->name;
        $bitacora->persona_id = $usuario->persona->id;
        $bitacora->nombre_completo = $usuario->persona->nombre;
        $bitacora->save();
    }

    /**
     * Handle the turno "restored" event.
     *
     * @param  \App\Models\turno  $turno
     * @return void
     */
    public function restored(turno $turno)
    {
        //
    }

    /**
     * Handle the turno "force deleted" event.
     *
     * @param  \App\Models\turno  $turno
     * @return void
     */
    public function forceDeleted(turno $turno)
    {
        //
    }
}
