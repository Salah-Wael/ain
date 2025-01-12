<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('semesters')->insert([
            ['id' => 1, 'name' => 'Semester 1'],
            ['id' => 2, 'name' => 'Semester 2'],
            ['id' => 3, 'name' => 'Summer'],
        ]);
    }
}
