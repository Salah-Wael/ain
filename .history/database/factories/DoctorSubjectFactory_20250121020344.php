<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Subject;
use App\Models\DoctorSubject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DoctorSubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = DoctorSubject::class;

    public function definition(): array
    {
        return [
            'doctor_id' => Doctor::all()->random()->id, // Select a random doctor
            'subject_id' => Subject::all()->random()->id, // Select a random subject
        ];
    }
}
