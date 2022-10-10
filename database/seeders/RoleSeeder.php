<?php

namespace Database\Seeders;

use App\Models\agenda;
use App\Models\doctor;
use App\Models\especialidad;
use App\Models\paciente;
use App\Models\persona;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($cant=0; $cant < 20; $cant++) { 
            $persona = persona::factory()->create();
            $doctor = doctor::factory()->create([
                'persona_id'=>$persona->id
            ]);
            $user = User::factory()->create([
                'persona_id'=>$persona->id
            ]);
        }
        for ($cant=0; $cant < 20; $cant++) { 
            $persona = persona::factory()->create();
            $doctor = paciente::factory()->create([
                'persona_id'=>$persona->id
            ]);
            $user = User::factory()->create([
                'persona_id'=>$persona->id
            ]);
        }
        
        //User::factory()->count(5)->create();
        
        $role1 = Role::create(['name'=>'administrador']);
        $role2 = Role::create(['name'=>'doctor']);
        $role3 = Role::create(['name'=>'paciente']);

        Permission::create(['name'=>'ver.usuario'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.roles'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.administrativo']);
        Permission::create(['name'=>'ver.medico']);
        Permission::create(['name'=>'ver.paciente']);
        Permission::create(['name'=>'ver.bitacora']);

        Permission::create(['name'=>'ver.documentacion']);
        Permission::create(['name'=>'ver.historial-clinico']);
        Permission::create(['name'=>'ver.hoja-de-consulta']);
        Permission::create(['name'=>'ver.receta']);

        Permission::create(['name'=>'ver.agenda']);
        Permission::create(['name'=>'ver.recervar cita']);
        Permission::create(['name'=>'ver.mis-citas']);
        Permission::create(['name'=>'ver.mis-agendas']);
        Permission::create(['name'=>'ver.horarios']);
        Permission::create(['name'=>'ver.turnos']);
        Permission::create(['name'=>'ver.especialidades']);

        Permission::create(['name'=>'ver.sectores']);
        Permission::create(['name'=>'ver.quirofano']);
        Permission::create(['name'=>'ver.consultario']);
        Permission::create(['name'=>'ver.internacion']);

        Permission::create(['name'=>'ver.reportes']);
        
        $user = User::find(1);
        $user->assignRole('administrador');
    }
}
