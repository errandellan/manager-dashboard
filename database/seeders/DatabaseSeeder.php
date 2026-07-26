<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed system tables
        $this->call([
            RoleSeeder::class,
            DepartmentSeeder::class,
            JobSeeder::class,
             ]);


        //Creating the first admin user
        User::firstOrCreate(
            ['email' => 'chuwamacmillan@gmail.com'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('admin12345'),
                'phone' => '0612489899',
                'role_id' => 1, //Admin
                'department_id' => 1, // System Administration Department
                'job_id' => 1,
                'status' => 'active',
            ]
        );
        
    }
    
}
