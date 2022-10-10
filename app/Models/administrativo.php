<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class administrativo extends Model
{
    use HasFactory;
    protected $table='administrativos';

    protected $fillable =[
        'persona_id',
        'cargo',
    ]; 



    public function persona()
    {
       return $this->belongsTo(persona::class,'persona_id','id');
       //return $this->hasOne(persona::class,'persona_id','id');
    }
    public function cita(){
        return $this->hasMany(cita::class);
    }
}
