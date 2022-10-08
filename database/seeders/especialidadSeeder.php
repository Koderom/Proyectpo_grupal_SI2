<?php

namespace Database\Seeders;

use App\Models\especialidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class especialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //'nombre'=>fake()->unique()->randomElement(['Neurologia','Dermatologia','Urologia','Cardiologia','Neurocirujano']),
        especialidad::create(['nombre'=>'Neurologia']);
        especialidad::create(['nombre'=>'Dermatologia']);
        especialidad::create(['nombre'=>'Urologia']);
        especialidad::create(['nombre'=>'Cardiologia']);
        especialidad::create(['nombre'=>'Neuro-cirujano']);
        //modificar el doctorFactory si se añade mas especialidades
    }
}
