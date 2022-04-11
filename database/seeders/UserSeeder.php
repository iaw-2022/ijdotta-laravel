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
            'email' => 'admin@clinicapp.com',
            'password' => Hash::make("clinic#app@2022")
        ]);

        User::create([
            'name' => 'sysowner',
            'email' => 'ij.dotta@gmail.com',
            'password' => Hash::make("salvameSuperman!")
        ]);

        User::create([
            'name' => 'dummy',
            'email' => 'dummy@dummy.com',
            'password' => Hash::make("12345678")
        ]);
    }
}
