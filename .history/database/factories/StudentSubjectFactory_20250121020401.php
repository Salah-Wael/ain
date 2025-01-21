<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Subject;
use App\Models\StudentSubject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StudentSubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = StudentSubject::class;

    public function definition(): array
    {
        return [
            'student_id' => User::all()->random()->id, // Select a random student
            'subject_id' => Subject::all()->random()->id,  // Select a random subject
        ];
    }
}
