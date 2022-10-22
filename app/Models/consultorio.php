<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultorio extends Model
{
    use HasFactory;

    protected $table = 'consultorios';

    public function sala(){
        return $this->belongsTo(sala::class);
    }
    public function asignacionConsultorio(){
        return $this->hasMany(asignacionCosultorio::class);
    }
}
