<?php

namespace App\Observers;

use App\Models\bitacora;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $mTime = Carbon::now('America/La_Paz');
        $usuario = Auth::user();

        $bitacora = new bitacora();
        $bitacora->objeto = 'usuarios';
        $bitacora->entidad_id = $user->id;
        $bitacora->entidad_descripcion = $user->name;
        $bitacora->verbo = 'crear';
        $bitacora->fecha_hora = $mTime->toDateTimeString();
        $bitacora->user_id = $usuario->id;
        $bitacora->user_name = $usuario->name;
        $bitacora->persona_id = $usuario->persona->id;
        $bitacora->nombre_completo = $usuario->persona->nombre;
        $bitacora->save();
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $mTime = Carbon::now('America/La_Paz');
        $usuario = Auth::user();

        $bitacora = new bitacora();
        $bitacora->objeto = 'usuarios';
        $bitacora->entidad_id = $user->id;
        $bitacora->entidad_descripcion = $user->name;
        $bitacora->verbo = 'modificar';
        $bitacora->fecha_hora = $mTime->toDateTimeString();
        $bitacora->user_id = $usuario->id;
        $bitacora->user_name = $usuario->name;
        $bitacora->persona_id = $usuario->persona->id;
        $bitacora->nombre_completo = $usuario->persona->nombre;
        $bitacora->save();
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $mTime = Carbon::now('America/La_Paz');
        $usuario = Auth::user();

        $bitacora = new bitacora();
        $bitacora->objeto = 'usuarios';
        $bitacora->entidad_id = $user->id;
        $bitacora->entidad_descripcion = $user->name;
        $bitacora->verbo = 'eliminar';
        $bitacora->fecha_hora = $mTime->toDateTimeString();
        $bitacora->user_id = $usuario->id;
        $bitacora->user_name = $usuario->name;
        $bitacora->persona_id = $usuario->persona->id;
        $bitacora->nombre_completo = $usuario->persona->nombre;
        $bitacora->save();
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
