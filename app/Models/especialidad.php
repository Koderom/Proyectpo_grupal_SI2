<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class especialidad extends Model
{
    protected $table = 'especialidads';
    
    use HasFactory;

    public function doctor(){
        return $this->hasMany(doctor::class);
    }
}
