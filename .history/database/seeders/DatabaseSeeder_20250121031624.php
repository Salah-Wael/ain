<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\DoctorSubject;
use App\Models\StudentSubject;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\DoctorSeeder;
use Database\Seeders\LectureSeeder;
use Database\Seeders\SubjectSeeder;
use Database\Seeders\SemesterSeeder;
use Database\Seeders\ClassRoomSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\AcademicYearSeeder;
use Database\Seeders\DoctorSubjectSeeder;
use Database\Seeders\StudentSubjectSeeder;
use Database\Seeders\HeadOfDepartmentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            ClassRoomSeeder::class,
            SemesterSeeder::class,
            DepartmentSeeder::class,
            HeadOfDepartmentSeeder::class,
            DoctorSeeder::class,
            UserSeeder::class,
            AcademicYearSeeder::class,
            SubjectSeeder::class,
            DoctorSubjectSeeder::class,
            StudentSubjectSeeder::class,
            LectureSeeder::class,
        ]);
    }
}
