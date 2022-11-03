<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    public function paciente(){
        return $this->belongsTo(paciente::class);
    }
    public function cupo(){
        return $this->belongsTo(cupo::class);
    }
    public function administrativo(){
        return $this->belongsTo(administrativo::class);
    }
    public function especialidad(){
        return $this->belongsTo(especialidad::class);
    }
    public function doctor(){
        return $this->belongsTo(doctor::class);
    }
    public function consulta(){
        return $this->belongsTo(consulta::class);
    }
}
