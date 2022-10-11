<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class turnoDoctor extends Model
{
    use HasFactory;

    protected $table = 'turno_doctors';

    public function doctor(){
        return $this->belongsTo(doctor::class);
    }
    public function turno(){
        return $this->belongsTo(turno::class);
    }
}
