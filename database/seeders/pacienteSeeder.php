<?php

namespace Database\Seeders;

use App\Models\paciente;
use App\Models\persona;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class pacienteSeeder extends Seeder
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
                'tipo' => 'P'
            ]);
            
            //paciente
            $paciente = paciente::create([
                'nombre_tutor'=> fake()->name(),
                'numero_telefono_tutor'=>fake()->randomNumber(8,true),
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
