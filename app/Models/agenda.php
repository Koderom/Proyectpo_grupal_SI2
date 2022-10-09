<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agenda extends Model
{
    use HasFactory;

    protected $table = 'agendas';

    public function doctor(){
        return $this->belongsTo(doctor::class);
    }
    public function cupo(){
        return $this->hasMany(cupo::class);
    }
}
