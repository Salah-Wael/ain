<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            [
                'name' => 'Information Systems',
                'abbreviation' => 'IS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Information Systems',
                'abbreviation' => 'IS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Computer Science',
                'abbreviation' => 'CS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Internet Technology',
                'abbreviation' => 'IT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Artificial Intelligence',
                'abbreviation' => 'AI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
