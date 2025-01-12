<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HeadOfDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        // List of departments to associate with head of departments
        $departmentIds = [1, 2, 3, 4];

        foreach ($departmentIds as $departmentId) {
            $data[] = [
                'name' => 'Head of Department ' . $departmentId,
                'email' => 'head' . $departmentId . '@example.com', // Example email, customize as needed
                'password' => bcrypt(123456789), // Example password, change as needed
                'department_id' => $departmentId,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert the records
        DB::table('head_of_departments')->insert($data);

    }
}
