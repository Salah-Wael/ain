<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $academicYears = [
            '2024/2025',
            '2025/2026',
            '2026/2027',
            '2027/2028',
            '2028/2029',
            '2029/2030',
            '2030/2031',
            '2031/2032',
            '2032/2033',
            '2033/2034',
            '2034/2035',
            '2035/2036',
            '2036/2037',
            '2037/2038',
            '2038/2039',
            '2039/2040',
            '2040/2041',
            '2041/2042',
            '2042/2043',
            '2043/2044',
        ];

        foreach ($academicYears as $year) {
            DB::table('academic_years')->insert([
                'year' => $year,
            ]);
        }
    }
}
