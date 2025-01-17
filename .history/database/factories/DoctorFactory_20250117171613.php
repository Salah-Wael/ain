<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    protected $model = Doctor::class; // Ensure this is correct
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name, // Generate a random name
            // 'email' => $this->faker->unique()->safeEmail, // Generate a unique email
            // 'email_verified_at' => now(),
            'password' => bcrypt(123456789), // Default password (you can change it)
            'department_id' => Department::inRandomOrder()->first()->id, // Random department_id from departments table
            // 'remember_token' => Str::random(10), // Random remember token
        ];
    }
}
