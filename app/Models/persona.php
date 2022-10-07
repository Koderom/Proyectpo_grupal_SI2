<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class persona extends Model
{
    use HasFactory;
    protected $table = 'personas';

    //use SoftDeletes;  // sugerencia para eliminar

    protected $fillable =[
        'ci',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'sexo',
        'edad',
        'fecha_nacimiento',
        'telefono',
        'direccion',
        'tipo',
    ];
    public function user()
    {
        return $this->hasOne(User::class,'persona_id','id');
    }
    public function administrativo()
    {
        return $this->hasOne(administrativo::class, 'persona_id', 'id');
    }
    
}
