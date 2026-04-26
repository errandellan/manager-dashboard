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
        // Call the RoleSeeder to seed the roles table
        $this->call(RoleSeeder::class);


        //Existing default user (optional, can be removed if not needed)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make(''),
        ]);
        User::create([
            'name' => 'Macmillan Chuwa',
            'email' => 'mac@me.com',
            'password' => Hash::make('password1'),
            'role_id' => 1, // Assuming 1 is the ID for admin role
        ]);

        User::create([
            'name' => 'Lilian Chuwa',
            'email' => 'lilian@me.com',
            'password' => Hash::make('password2'),
            'role_id' => 2, // Assuming 2 is the ID for manager role
        ]);
        User::create([
            'name' => 'Azim Chuwa',
            'email' => 'azim@me.com',
            'password' => Hash::make('password3'),
            'role_id' => 3, // Assuming 3 is the ID for employee role
        ]);
    }
    
}
