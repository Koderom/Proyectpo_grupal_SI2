<?php

namespace Database\Seeders;

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
        //User::factory()->count(5)->create();
        $role1 = Role::create(['name'=>'administrador']);
        $role2 = Role::create(['name'=>'doctor']);
        $role3 = Role::create(['name'=>'paciente']);

        Permission::create(['name'=>'permiso de prueba 1']);
        Permission::create(['name'=>'permiso de prueba 2']);
        Permission::create(['name'=>'permiso de prueba 3']);
        Permission::create(['name'=>'permiso de prueba 4']);
        Permission::create(['name'=>'permiso de prueba 5']);
        Permission::create(['name'=>'permiso de prueba 6']);
        Permission::create(['name'=>'permiso de prueba 7']);
        Permission::create(['name'=>'permiso de prueba 8']);
        Permission::create(['name'=>'permiso de prueba 9']);
        Permission::create(['name'=>'permiso de prueba 10']);
        Permission::create(['name'=>'permiso de prueba 11']);
        Permission::create(['name'=>'permiso de prueba 12']);
        Permission::create(['name'=>'permiso de prueba 13']);
        Permission::create(['name'=>'permiso de prueba 14']);
        Permission::create(['name'=>'permiso de prueba 15']);
        Permission::create(['name'=>'permiso de prueba 16']);

    }
}
