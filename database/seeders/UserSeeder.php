<?php

namespace Database\Seeders;

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

        User::create([
            'name' => 'admin',
            'role' => 'admin',
            'email' => 'admin@clinicapp.com',
            'password' => bcrypt("clinic#app@2022")
        ]);
        
        User::create([
            'name' => 'sysowner',
            'role' => 'admin',
            'email' => 'ij.dotta@gmail.com',
            'password' => bcrypt("salvameSuperman!")
        ]);
        
        User::create([
            'name' => 'dummy',
            'role' => 'admin',
            'email' => 'dummy@dummy.com',
            'password' => bcrypt("12345678")
        ]);
    }
}
