<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quirofano extends Model
{
    use HasFactory;

    protected $table = 'quirofanos';

    public function sala(){
        return $this->belongsTo(sala::class);
    }
    public function reservaQuirofano(){
        return $this->hasMany(reservaQuirofano::class);
    }
}
