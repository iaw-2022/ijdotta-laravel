<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_id = Role::where('role', 'admin')->get()->first()->id;

        User::create([
            'name' => 'admin',
            'role_id' => $role_id,
            'email' => 'admin@clinicapp.com',
            'password' => "clinic#app@2022"
        ]);
        
        User::create([
            'name' => 'sysowner',
            'role_id' => $role_id,
            'email' => 'ij.dotta@gmail.com',
            'password' => "salvameSuperman!"
        ]);
        
        User::create([
            'name' => 'dummy',
            'role_id' => $role_id,
            'email' => 'dummy@dummy.com',
            'password' => "12345678"
        ]);
    }
}
