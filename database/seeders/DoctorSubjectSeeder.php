<?php

namespace Database\Seeders;

use App\Models\DoctorSubject;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DoctorSubject::factory()->count(20)->create();
    }
}
