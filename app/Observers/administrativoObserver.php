<?php

namespace App\Observers;

use App\Models\administrativo;
use App\Models\bitacora;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class administrativoObserver
{
    /**
     * Handle the administrativo "created" event.
     *
     * @param  \App\Models\administrativo  $administrativo
     * @return void
     */
    public function created(administrativo $administrativo)
    {
        $usuario = Auth::user();
        if(! $usuario == null){
            $mTime = Carbon::now('America/La_Paz');
            $usuario = Auth::user();

            $bitacora = new bitacora();
            $bitacora->objeto = 'pacientes';
            $bitacora->entidad_id = $administrativo->id;
            $bitacora->entidad_descripcion = $administrativo->persona->nombre;
            $bitacora->verbo = 'crear';
            $bitacora->fecha_hora = $mTime->toDateTimeString();
            $bitacora->user_id = $usuario->id;
            $bitacora->user_name = $usuario->name;
            $bitacora->persona_id = $usuario->persona->id;
            $bitacora->nombre_completo = $usuario->persona->nombre;
            $bitacora->save();
        }
            
        
        
    }

    /**
     * Handle the administrativo "updated" event.
     *
     * @param  \App\Models\administrativo  $administrativo
     * @return void
     */
    public function updated(administrativo $administrativo)
    {
        $mTime = Carbon::now('America/La_Paz');
        $usuario = Auth::user();

        $bitacora = new bitacora();
        $bitacora->objeto = 'modificar';
        $bitacora->entidad_id = $administrativo->id;
        $bitacora->entidad_descripcion = $administrativo->persona->nombre;
        $bitacora->verbo = 'crear';
        $bitacora->fecha_hora = $mTime->toDateTimeString();
        $bitacora->user_id = $usuario->id;
        $bitacora->user_name = $usuario->name;
        $bitacora->persona_id = $usuario->persona->id;
        $bitacora->nombre_completo = $usuario->persona->nombre;
        $bitacora->save();
    }

    /**
     * Handle the administrativo "deleted" event.
     *
     * @param  \App\Models\administrativo  $administrativo
     * @return void
     */
    public function deleted(administrativo $administrativo)
    {
        $mTime = Carbon::now('America/La_Paz');
        $usuario = Auth::user();

        $bitacora = new bitacora();
        $bitacora->objeto = 'pacientes';
        $bitacora->entidad_id = $administrativo->id;
        $bitacora->entidad_descripcion = $administrativo->persona->nombre;
        $bitacora->verbo = 'eliminar';
        $bitacora->fecha_hora = $mTime->toDateTimeString();
        $bitacora->user_id = $usuario->id;
        $bitacora->user_name = $usuario->name;
        $bitacora->persona_id = $usuario->persona->id;
        $bitacora->nombre_completo = $usuario->persona->nombre;
        $bitacora->save();
    }

    /**
     * Handle the administrativo "restored" event.
     *
     * @param  \App\Models\administrativo  $administrativo
     * @return void
     */
    public function restored(administrativo $administrativo)
    {
        //
    }

    /**
     * Handle the administrativo "force deleted" event.
     *
     * @param  \App\Models\administrativo  $administrativo
     * @return void
     */
    public function forceDeleted(administrativo $administrativo)
    {
        //
    }
}
