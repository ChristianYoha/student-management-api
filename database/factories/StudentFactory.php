<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'lastname' => $this->faker->lastName(),
            'firstname' => $this->faker->firstName(),
            'birthdate' => $this->faker->dateTimeBetween('1995-01-01', '2000-12-31')->format('Y-m-d'),
            'arrivalYear' => 2021,
            'promotion_id' => rand(1, 4)
        ];
    }
}
