<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('class_rooms')->insert([
                'name' => "Hall$i",
                'abbreviation' => "H$i",
                'location_description' => 'Floor ' . rand(1, 3), // Random floor 1, 2, or 3
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
