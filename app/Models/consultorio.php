<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultorio extends Model
{
    use HasFactory;

    protected $table = 'consultorios';

    public function sala(){
        return $this->belongsTo(sala::class);
    }
    public function asignacionConsultorio(){
        return $this->hasMany(asignacionCosultorio::class);
    }

    public function tieneHoraAsignada($horaEntrada, $horaSalida){
        $asignaciones = asignacionCosultorio::where('asignacion_consultorios.consultorio_id',$this->id)
                    ->whereBetween('hora_entrada',[$horaEntrada,$horaSalida])
                    ->get();
        if($asignaciones->count() != 0)return true;
        $asignaciones = asignacionCosultorio::where('asignacion_consultorios.consultorio_id',$this->id)
                    ->whereBetween('hora_salida',[$horaEntrada,$horaSalida])
                    ->get();
        if($asignaciones->count() != 0)return true;
        return false;
    }
}
