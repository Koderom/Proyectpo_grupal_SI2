<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctorQuirofano extends Model
{
    use HasFactory;

    protected $table = 'doctor_quirofanos';

    public function doctor(){
        return $this->belongsTo(doctor::class);
    }
    public function reservaQuirofano(){
        return $this->belongsTo(reservaQuirofano::class);
    }
}
