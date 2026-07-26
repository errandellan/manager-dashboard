<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        Department::insert([
            [
                'department_name' => 'Administration',
                'description' => 'System Administration'
            ],
            [
                'department_name' => 'Human Resource',
                'description' => 'Human Resource Department'
            ],
            [
                'department_name' => 'Information Technology',
                'description' => 'ICT Department'
            ],
            [
                'department_name' => 'Finance',
                'description' => 'Finance Department'
            ],
            [
                'department_name' => 'Operations',
                'description' => 'Operations Department'
            ],
        ]);
    }
}