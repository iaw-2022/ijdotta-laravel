<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Doctor;
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
        return [
            'doctor_id' => Doctor::all()->pluck('id')->random(1)->first(),
            'appointment_id' => 555,
            'initial_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'initial_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'appointment_duration' => $this->faker->time(),
            'days' => '{"days": ["Mon", "Tue", "Wed"]}'
        ];
    }
}
