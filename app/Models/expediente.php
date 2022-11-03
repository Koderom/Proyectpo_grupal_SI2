<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expediente extends Model
{
    use HasFactory;
    protected $table = 'expedientes';
    public function hoja_consulta()
    {
        return $this->hasMany(hoja_consulta::class);
    }
    public function paciente()
    {
        return $this->belongsTo(paciente::class);
    }
}
