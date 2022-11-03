<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consulta extends Model
{
    use HasFactory;
    protected $table='consultas';
    protected $fillable =[
        'doctor_id',
        'cita_id',
    ];
    public function doctor()
    {
        return $this->belongsTo(doctor::class,'doctor_id','id');
    }

    public function cita()
    {
        return $this->belongsTo(cita::class,'cita_id','id');
    }
    public function hoja_consulta(){
        return $this->hasOne(hoja_consulta::class);
    }
    // public function expediente()
    // {
    //     return $this
    // }
}
