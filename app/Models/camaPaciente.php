<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class camaPaciente extends Model
{
    use HasFactory;

    protected $table = 'cama_pacientes';

    public function cama(){
        return $this->belongsTo(cama::class);
    }
    public function paciente(){
        return $this->belongsTo(paciente::class);
    }
}
