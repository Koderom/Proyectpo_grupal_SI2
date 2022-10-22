<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sala extends Model
{
    use HasFactory;

    protected $table = 'salas';

    public function sector(){
        return $this->belongsTo(sector::class);
    }
    public function internacion(){
        return $this->hasOne(internacion::class);
    }
    public function consultorio(){
        return $this->hasOne(consultorio::class);
    }
    public function quirofano(){
        return $this->hasOne(quirofano::class);
    }
}
