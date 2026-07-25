<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'Admin',
            'description' => 'System administrator',
            'created_at' => now(),
            'updated_at' => now(),
            ],

            ['name' => 'Manager',
            'description' => 'Department Manager',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            
            ['name' => 'Employee',
            'description' => 'Regular employee',
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
    }
}
