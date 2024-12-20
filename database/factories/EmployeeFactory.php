<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => UserFactory::new(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'salary' => fake()->numberBetween(1000, 10000),
            'photo' => fake()->imageUrl(),
            'employee_code' => fake()->unique()->numberBetween(1000, 9999),
            'joining_date' => fake()->date(),
        ];
    }
}
