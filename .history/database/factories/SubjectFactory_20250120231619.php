<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate a random subject name
        $name = $this->faker->unique()->words(2, true); // e.g., "Mathematics", "Physics"

        // Generate a code: 2-3 letters from the name + 3 random digits (1-4)
        $nameInitials = strtoupper(Str::substr(Str::replace(' ', '', $name), 0, rand(2, 3))); // Extract 2-3 letters
        $randomNumbers = rand(111, 444); // Generate random numbers from 1 to 4
        $code = $nameInitials . $randomNumbers;

        return [
            'name' => $name,
            'code' => $code,
            'semester_id' => $this->faker->numberBetween(1, 3), // Assuming 8 semesters
            'semester_id' => $this->faker->numberBetween(1, 3), // Assuming 8 semesters
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
