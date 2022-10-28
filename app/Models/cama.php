<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cama extends Model
{
    use HasFactory;

    protected $table = 'camas';

    public function internacion(){
        return $this->belongsTo(internacion::class);
    }
    public function camaPaciente(){
        return $this->hasMany(camaPaciente::class);
    }
}
