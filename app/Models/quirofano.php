<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quirofano extends Model
{
    use HasFactory;

    protected $table = 'quirofanos';

    public function sala(){
        return $this->belongsTo(sala::class);
    }
    public function reservaQuirofano(){
        return $this->hasMany(reservaQuirofano::class);
    }
    /* funciones auxiliares*/
    public function estaReservado(Carbon $fechaHoraInicio, Carbon $fechaHoraFin){
        // $fechaHoraInicio = $fechaHora->toDateTimeString();
        // $fechaHoraFin = $fechaHora->addHour($duracion)->toDateTimeString();
        // $reserva = reservaQuirofano::join('quirofanos','quirofanos.id','=','reserva_quirofanos.quirofano_id')
        // ->where('quirofanos.id',$this->id)
        // ->whereBetween('reserva_quirofanos.fecha_hora',[$fechaHoraInicio,$fechaHoraFin])
        // ->get();
        // if($reserva->count() == 0) return false;
        // else return true;
        $reserva = reservaQuirofano::where('reserva_quirofanos.quirofano_id',$this->id)
        ->whereBetween('fecha_hora_entrada',[$fechaHoraInicio, $fechaHoraFin])
        ->get();
        if($reserva->count() != 0) return true;
        $reserva = reservaQuirofano::where('reserva_quirofanos.quirofano_id',$this->id)
        ->whereBetween('fecha_hora_salida',[$fechaHoraInicio, $fechaHoraFin])
        ->get();
        if($reserva->count() != 0) return true;
        return false;
    }
}
