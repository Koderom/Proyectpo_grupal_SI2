<?php

namespace App\Models;

use App\Http\Controllers\reservaQuirofanoController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function reservaQuirofano(){
        return $this->hasMany(reservaQuirofano::class);
    }
}
