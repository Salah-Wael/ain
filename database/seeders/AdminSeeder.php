<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Admin::create([
            'name' => 'Mohamed Abdelkawy',
            'email' => 'admin@example.com',  // Change this to your desired email
            'email_verified_at' => now(),   // Set to current time
            'password' => Hash::make(123456789),  // Use a hashed password
            'remember_token' => null,       // You can leave it null or generate one
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $superAdmin->assignRole('Super-Admin');
    }
}
