<?php

namespace App\Models;

use App\Http\Controllers\reservaQuirofanoController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\returnSelf;

class doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors';

    public function persona()
    {
       return $this->belongsTo(persona::class,'persona_id','id');
    }
    public function especialidad(){
        return $this->belongsTo(especialidad::class);
    }
    public function turnoDoctor(){
        return $this->hasMany(turnoDoctor::class);
    }
    public function agenda(){
        return $this->hasMany(agenda::class);
    }
    public function cita(){
        return $this->hasMany(cita::class);
    }


    public function asignacionConsultorio(){
        return $this->hasMany(asignacionCosultorio::class);
    }
    public function doctorQuirofano(){
        return $this->hasMany(doctorQuirofano::class);
    }
    /*funciones auxiliares */
    public function tieneCirugiaProgramada(Carbon $fechaHoraInicio, Carbon $fechaHoraFin){
        // $fechaHoraInicio = $fechaHora->toDateTimeString();
        // $fechaHoraFin = $fechaHora->addHour($duracion)->toDateTimeString();
        // $cirugiaProgramada = reservaQuirofano::join('doctor_quirofanos', 'doctor_quirofanos.reserva_quirofano_id','=','reserva_quirofanos.id')
        // ->where('doctor_quirofanos.doctor_id',$this->id)
        // ->whereBetween('reserva_quirofanos.fecha_hora',[$fechaHoraInicio,$fechaHoraFin])
        // ->get();
        // if($cirugiaProgramada->count() == 0) return false;
        // else return true;

        $cirugiaProgramada = reservaQuirofano::join('doctor_quirofanos', 'doctor_quirofanos.reserva_quirofano_id','=','reserva_quirofanos.id')
        ->where('doctor_quirofanos.doctor_id',$this->id)
        ->whereBetween('reserva_quirofanos.fecha_hora_entrada',[$fechaHoraInicio,$fechaHoraFin])
        ->get();
        if($cirugiaProgramada->count() != 0) return true;
        $cirugiaProgramada = reservaQuirofano::join('doctor_quirofanos', 'doctor_quirofanos.reserva_quirofano_id','=','reserva_quirofanos.id')
        ->where('doctor_quirofanos.doctor_id',$this->id)
        ->whereBetween('reserva_quirofanos.fecha_hora_salida',[$fechaHoraInicio,$fechaHoraFin])
        ->get();
        if($cirugiaProgramada->count() != 0) return true;
        return false;
    }
    public function consulta(){
        return $this->belongsTo(consulta::class);
    }
}
