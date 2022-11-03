<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hoja_consulta extends Model
{
    use HasFactory;
    protected $table = 'hoja_consultas';
    protected $fillable = [
        'consulta_id',
        'expediente_id',
    ];
    public function expediente(){
        return $this->belongsTo(expediente::class);
    }
    public function consulta(){
        return $this->belongsTo(consulta::class,'consulta_id','id');
    }
    public function receta()
    {
        return $this->hasOne(receta::class);
    }
}
