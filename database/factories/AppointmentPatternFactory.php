<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Doctor;
use Carbon\Carbon;
use DateTimeZone;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppointmentPattern>
 */
class AppointmentPatternFactory extends Factory
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
        $date->setTime(rand(9, 13), 0);

        $endDate = $date->copy()->addDays(rand(15, 60));
        $endDate->setTime(rand(15, 19), 0);

        return [
            'doctor_id' => Doctor::all()->pluck('id')->random(1)->first(),
            'initial_date' => $date->toDateString(),
            'end_date' => $endDate->toDateString(),
            'initial_time' => $date->toTimeString(),
            'end_time' => $endDate->toTimeString(),
            'appointment_duration' => '00:'.rand(20, 30).':00',
            'days' => ['Mon', 'Tue', 'Wed'],
        ];
    }
}
