<?php

namespace Database\Seeders;

use App\Models\persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class personaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
            persona::create([
            // 'id'=>1,
            'ci'=>10632314,
            'nombre'=> 'Juan',
            'apellido_paterno'=> 'Perez',
            'apellido_materno'=> 'Romero',
            'sexo'=>'M',
            'edad'=>26,
            'fecha_nacimiento'=>'1995-09-26',
            'telefono'=>74526321,
            'direccion'=>'Av.Beni calle ambaibo N° 2235 zona del segundo anillo.',
            'tipo'=>'A'
        ]);
    }
}
