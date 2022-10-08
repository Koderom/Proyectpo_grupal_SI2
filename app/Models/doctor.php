<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors';

    public function persona()
    {
       return $this->belongsTo(persona::class,'persona_id','id');
    }
    public function especialidad(){
        return $this->belongsTo(especialidad::class);
    }
    public function turnoDoctor(){
        $this->hasMany(turnoDoctor::class);
    }
}
