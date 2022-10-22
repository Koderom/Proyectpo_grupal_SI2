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
}
