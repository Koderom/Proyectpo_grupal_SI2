<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservaQuirofano extends Model
{
    use HasFactory;

    protected $table = 'reserva_quirofanos';

    public function quirofano(){
        return $this->belongsTo(quirofano::class);
    }
    public function paciente(){
        return $this->belongsTo(paciente::class);
    }
    public function doctorQuirofano(){
        return $this->hasMany(doctorQuirofano::class);
    }
}
