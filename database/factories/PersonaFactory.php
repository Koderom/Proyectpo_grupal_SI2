<?php

namespace Database\Factories;

use App\Models\persona;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona>
 */
class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = persona::class;
    public function definition()
    {   
        $faker = Faker::create();
        return [
            'ci'=> $faker->randomNumber(8,true),
            'nombre'=> $faker->name(),
            'apellido_paterno' => $faker->lastName(),
            'apellido_materno' => $faker->lastName(),
            'sexo' => $faker->randomElement(['M','F']),
            'edad' => $faker->randomNumber(2,false),
            'fecha_nacimiento' => $faker->date(),
            'telefono'=>$faker->randomNumber(8,true),
            'direccion'=>$faker->address(),
            'tipo' => $faker->randomElement(['A','D','P'])
        ];
    }
}
