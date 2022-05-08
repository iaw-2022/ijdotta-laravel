<?php

namespace Database\Factories;

use App\Models\AppointmentPattern;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Doctor;
use Carbon\Carbon;
use DateTimeZone;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date = Carbon::now(new DateTimeZone('America/Argentina/Buenos_Aires'));
        $date->subDays(rand(0, 90));
        $date->setTime(rand(9, 18), 0);

        return [
            'date' => $date->toDateString(),//$this->faker->date(),
            'initial_time' => $date->toTimeString(),
            'end_time' => $date->addMinutes(20)->toTimeString(),
            'doctor_id' => Doctor::all()->pluck('id')->random(1)->first(),
            'appointment_pattern_id' => AppointmentPattern::all()->pluck('id')->random(1)->first(),
        ];
    }
}
