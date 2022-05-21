<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $companies = ['IOMA', 'SOSUNS', 'OSDE', 'Swiss Medical', 'Federada', 'DOSEM'];

        return [
            'id' => $this->faker->numberBetween(10000, 99999),
            'name' => $this->faker->name(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'health_insurance_company' => $companies[array_rand($companies)], //$this->faker->company,
            'health_insurance_id' => $this->faker->creditCardNumber()
        ];
    }
}
