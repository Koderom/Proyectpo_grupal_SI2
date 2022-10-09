<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cupo extends Model
{
    use HasFactory;

    protected $table = 'cupos';

    public function agenda(){
        return $this->belongsTo(agenda::class);
    }
    public function cita(){
        return $this->hasOne(cita::class);
    }
}
