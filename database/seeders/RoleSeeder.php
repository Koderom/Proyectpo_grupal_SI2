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
        // for ($cant=0; $cant < 20; $cant++) { 
        //     $persona = persona::factory()->create([
        //         'tipo'=>'D'
        //     ]);
        //     $doctor = doctor::factory()->create([
        //         'persona_id'=>$persona->id
        //     ]);
        //     $user = User::factory()->create([
        //         'persona_id'=>$persona->id
        //     ]);
        // }
        // for ($cant=0; $cant < 20; $cant++) { 
        //     $persona = persona::factory()->create([
        //         'tipo'=>'P'
        //     ]);
        //     $doctor = paciente::factory()->create([
        //         'persona_id'=>$persona->id
        //     ]);
        //     $user = User::factory()->create([
        //         'persona_id'=>$persona->id
        //     ]);
        // }
        
        //User::factory()->count(5)->create();
        
        
        $role1 = Role::create(['name'=>'administrador']);
        $role2 = Role::create(['name'=>'doctor']);
        $role3 = Role::create(['name'=>'paciente']);

        Permission::create(['name'=>'ver.usuario'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.roles'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.administrativo'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.medico'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.paciente'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.bitacora'])->syncRoles([$role1]);

        Permission::create(['name'=>'ver.documentacion'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.historial-clinico'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.hoja-de-consulta'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.receta'])->syncRoles([$role1]);

        Permission::create(['name'=>'ver.agenda'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.reservar cita'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.mis-citas'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.mis-agendas'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.horarios'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.turnos'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.especialidades'])->syncRoles([$role1]);

        Permission::create(['name'=>'ver.sectores'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.quirofano'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.consultorio'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.internacion'])->syncRoles([$role1]);

        Permission::create(['name'=>'ver.reportes'])->syncRoles([$role1]);
        
        $user = User::find(1);
        $user->assignRole('administrador');
    }
}
