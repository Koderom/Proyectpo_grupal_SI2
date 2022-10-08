<?php

namespace Database\Factories;

use App\Models\doctor;
use App\Models\especialidad;
use App\Models\persona;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = doctor::class;
    public function definition()
    {
        return [
            'formacion'=> fake()->randomElement(['Estudiate','Licenciatura','Tecnico medio','Maestria']),
            'especialidad_id'=> fake()->randomElement([1,2,3,4,5]),//de momento solo hay cinco especialidades
            'persona_id'=> persona::factory(),
            
        ];
    }
}
