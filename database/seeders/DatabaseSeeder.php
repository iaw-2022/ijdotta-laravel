<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Patient;

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
            UserSeeder::class
        ]);

        Doctor::factory()->count(5)->has(Appointment::factory()->count(3))->create();
        Patient::factory()->count(5)->has(Appointment::factory()->count(2))->create();
    }
}
