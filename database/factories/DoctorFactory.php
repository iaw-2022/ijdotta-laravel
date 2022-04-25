<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => $this->faker->numberBetween(10000, 99999),
            'user_id' => User::factory()->createOne(['role' => 'doctor', 'password' => bcrypt('12345678')])->id,
            'name' => $this->faker->name(),
            'lastname' => $this->faker->lastName(),
        ];
    }
}
