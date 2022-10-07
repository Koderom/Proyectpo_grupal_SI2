<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /* DB::insert('insert into users(id, name, email,password) values(?,?,?,?)',[1,'maria','lupeparogua@gmail.com',
        Hash::make('1234')*/

        User::create([
            // 'id'=>1,
            'persona_id'=>1,
            'name'=>'Admin',//usuario
            'email'=>'Juanperez@gmail.com',
            'password'=>Hash::make('1234')
            
        ]);
    //]);
    }
}
