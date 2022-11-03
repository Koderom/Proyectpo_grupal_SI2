<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class receta extends Model
{
    use HasFactory;
    protected $table = 'recetas';
    
    public function medicamentoReceta()
    {
        return $this->hasMany(medicamento_receta::class);
    }
    public function hoja_consulta(){
        return $this->belongsTo(hoja_consulta::class);
    }

}
