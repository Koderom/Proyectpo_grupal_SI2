<?php

namespace Database\Seeders;

use App\Models\doctor;
use App\Models\persona;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class doctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($cant=0; $cant < 20; $cant++) {
            //persona
            $persona = persona::create([
                'ci'=> fake()->randomNumber(8,true),
                'nombre'=> fake()->name(),
                'apellido_paterno' => fake()->lastName(),
                'apellido_materno' => fake()->lastName(),
                'sexo' => fake()->randomElement(['M','F']),
                'edad' => fake()->randomNumber(2,false),
                'fecha_nacimiento' => fake()->date(),
                'telefono'=>fake()->randomNumber(8,true),
                'direccion'=>fake()->address(),
                'tipo' => 'D'
            ]);
            
            //paciente
            $paciente = doctor::create([
                'formacion'=> fake()->randomElement(['Estudiate','Licenciatura','Tecnico medio','Maestria']),
                'especialidad_id'=> fake()->randomElement([1,2,3,4,5]),//de momento solo hay cinco especialidades
                'persona_id'=> $persona->id,
            ]);
            //usuario
            $usuario = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' =>bcrypt(123456789),
                'remember_token' => Str::random(10),
                'persona_id'=> $persona->id,
            ]);
            
        }
    }
}
