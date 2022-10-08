<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class turnoDoctor extends Model
{
    use HasFactory;

    protected $table = 'turno_dortors';

    public function doctor(){
        return $this->belongsTo(doctor::class);
    }
}
