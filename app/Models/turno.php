<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class turno extends Model
{
    use HasFactory;

    protected $table = 'turnos';

    public function turnoDoctor(){
        return $this->hasMany(turnoDoctor::class);
    }
}
