<?php

namespace App\Observers;

use App\Models\bitacora;
use App\Models\paciente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class pacienteObserver
{
    /**
     * Handle the paciente "created" event.
     *
     * @param  \App\Models\paciente  $paciente
     * @return void
     */
    public function created(paciente $paciente)
    {
        $usuario = Auth::user();
        if(! $usuario == null){
            $mTime = Carbon::now('America/La_Paz');
            $usuario = Auth::user();

            $bitacora = new bitacora();
            $bitacora->objeto = 'pacientes';
            $bitacora->entidad_id = $paciente->id;
            $bitacora->entidad_descripcion = $paciente->persona->nombre;
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
     * Handle the paciente "updated" event.
     *
     * @param  \App\Models\paciente  $paciente
     * @return void
     */
    public function updated(paciente $paciente)
    {
        $mTime = Carbon::now('America/La_Paz');
        $usuario = Auth::user();

        $bitacora = new bitacora();
        $bitacora->objeto = 'pacientes';
        $bitacora->entidad_id = $paciente->id;
        $bitacora->entidad_descripcion = $paciente->persona->nombre;
        $bitacora->verbo = 'modificar';
        $bitacora->fecha_hora = $mTime->toDateTimeString();
        $bitacora->user_id = $usuario->id;
        $bitacora->user_name = $usuario->name;
        $bitacora->persona_id = $usuario->persona->id;
        $bitacora->nombre_completo = $usuario->persona->nombre;
        $bitacora->save();
    }

    /**
     * Handle the paciente "deleted" event.
     *
     * @param  \App\Models\paciente  $paciente
     * @return void
     */
    public function deleted(paciente $paciente)
    {
        $mTime = Carbon::now('America/La_Paz');
        $usuario = Auth::user();

        $bitacora = new bitacora();
        $bitacora->objeto = 'pacientes';
        $bitacora->entidad_id = $paciente->id;
        $bitacora->entidad_descripcion = $paciente->persona->nombre;
        $bitacora->verbo = 'eliminar';
        $bitacora->fecha_hora = $mTime->toDateTimeString();
        $bitacora->user_id = $usuario->id;
        $bitacora->user_name = $usuario->name;
        $bitacora->persona_id = $usuario->persona->id;
        $bitacora->nombre_completo = $usuario->persona->nombre;
        $bitacora->save();
    }

    /**
     * Handle the paciente "restored" event.
     *
     * @param  \App\Models\paciente  $paciente
     * @return void
     */
    public function restored(paciente $paciente)
    {
        //
    }

    /**
     * Handle the paciente "force deleted" event.
     *
     * @param  \App\Models\paciente  $paciente
     * @return void
     */
    public function forceDeleted(paciente $paciente)
    {
        //
    }
}
