<?php

namespace Database\Seeders;

use App\Models\HeadOfDepartment;
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
        HeadOfDepartment::factory()->count(4)->create();
    }
}
