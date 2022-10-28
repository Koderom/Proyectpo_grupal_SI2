<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\returnSelf;

class paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';

    public function persona(){
        return $this->belongsTo(persona::class);
    }
    public function cita(){
        return $this->hasMany(cita::class);
    }


    public function reservaQuirofano(){
        return $this->hasMany(reservaQuirofano::class);
    }
    public function camaPaciente(){
        return $this->hasMany(camaPaciente::class);
    }



    public function estaInternado(){
        $id = $this->id;
        $paciente = paciente::join('cama_pacientes', 'cama_pacientes.paciente_id','=','pacientes.id')
        ->where('pacientes.id','=',$id)
        ->whereNull('cama_pacientes.fecha_de_salida')->get();
        if($paciente->isEmpty()) return false;
        return true;
    }
}
