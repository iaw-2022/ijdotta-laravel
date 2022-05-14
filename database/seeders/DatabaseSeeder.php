<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\AppointmentPattern;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // RoleSeeder::class,
            UserSeeder::class
        ]);

        // Doctor::factory()->count(2)
        //     ->has(AppointmentPattern::factory()->count(2))
        //     ->has(Appointment::factory()->count(3))
        //     ->create();

        $this->call([
            SimpsonsSeeder::class,
            PatientSeeder::class,
        ]);
    }
}
