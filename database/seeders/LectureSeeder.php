<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        // Fetch all subject IDs from the Subject model
        $subjects = Subject::all(); // This will fetch all subjects from the database

        // Number of lectures per subject
        $lecturesPerSubject = 10;

        foreach ($subjects as $subject) {
            // Create lectures for each subject
            for ($i = 1; $i <= $lecturesPerSubject; $i++) {
                $data[] = [
                    'name' => "Lecture $i",
                    'subject_id' => Subject::inRandomOrder()->first()->id, // Random department_id from departments table
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert all the generated lectures into the database
        DB::table('lectures')->insert($data);

    }
}
