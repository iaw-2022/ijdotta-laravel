<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Story;
use App\Models\Treatment;
use Database\Factories\PatientFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Patient::factory()
            ->has(
                Story::factory()->has(
                    Treatment::factory()->count(
                        rand(1, 3)
                    )
                )->count(rand(1, 10))
            )
            ->has(
                Appointment::factory()->count(rand(1, 10))
            )->count(10)->create();
    }
}
