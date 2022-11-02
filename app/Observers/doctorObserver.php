<?php

namespace App\Observers;

use App\Models\bitacora;
use App\Models\doctor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class doctorObserver
{
    /**
     * Handle the doctor "created" event.
     *
     * @param  \App\Models\doctor  $doctor
     * @return void
     */
    public function created(doctor $doctor)
    {
        $mTime = Carbon::now('America/La_Paz');
        $usuario = Auth::user();

        $bitacora = new bitacora();
        $bitacora->objeto = 'pacientes';
        $bitacora->entidad_id = $doctor->id;
        $bitacora->entidad_descripcion = $doctor->persona->nombre;
        $bitacora->verbo = 'crear';
        $bitacora->fecha_hora = $mTime->toDateTimeString();
        $bitacora->user_id = $usuario->id;
        $bitacora->user_name = $usuario->name;
        $bitacora->persona_id = $usuario->persona->id;
        $bitacora->nombre_completo = $usuario->persona->nombre;
        $bitacora->save();
    }

    /**
     * Handle the doctor "updated" event.
     *
     * @param  \App\Models\doctor  $doctor
     * @return void
     */
    public function updated(doctor $doctor)
    {
        $mTime = Carbon::now('America/La_Paz');
        $usuario = Auth::user();

        $bitacora = new bitacora();
        $bitacora->objeto = 'pacientes';
        $bitacora->entidad_id = $doctor->id;
        $bitacora->entidad_descripcion = $doctor->persona->nombre;
        $bitacora->verbo = 'modificar';
        $bitacora->fecha_hora = $mTime->toDateTimeString();
        $bitacora->user_id = $usuario->id;
        $bitacora->user_name = $usuario->name;
        $bitacora->persona_id = $usuario->persona->id;
        $bitacora->nombre_completo = $usuario->persona->nombre;
        $bitacora->save();
    }

    /**
     * Handle the doctor "deleted" event.
     *
     * @param  \App\Models\doctor  $doctor
     * @return void
     */
    public function deleted(doctor $doctor)
    {
        $mTime = Carbon::now('America/La_Paz');
        $usuario = Auth::user();

        $bitacora = new bitacora();
        $bitacora->objeto = 'pacientes';
        $bitacora->entidad_id = $doctor->id;
        $bitacora->entidad_descripcion = $doctor->persona->nombre;
        $bitacora->verbo = 'eliminar';
        $bitacora->fecha_hora = $mTime->toDateTimeString();
        $bitacora->user_id = $usuario->id;
        $bitacora->user_name = $usuario->name;
        $bitacora->persona_id = $usuario->persona->id;
        $bitacora->nombre_completo = $usuario->persona->nombre;
        $bitacora->save();
    }

    /**
     * Handle the doctor "restored" event.
     *
     * @param  \App\Models\doctor  $doctor
     * @return void
     */
    public function restored(doctor $doctor)
    {
        //
    }

    /**
     * Handle the doctor "force deleted" event.
     *
     * @param  \App\Models\doctor  $doctor
     * @return void
     */
    public function forceDeleted(doctor $doctor)
    {
        //
    }
}
