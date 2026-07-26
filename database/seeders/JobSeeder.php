<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        Job::insert([
            [
                'department_id' => 1,
                'job_title' => 'System Administrator',
                'description' => 'Overall system administrator'
            ],
            [
                'department_id' => 2,
                'job_title' => 'HR Officer',
                'description' => 'Human resource officer'
            ],
            [
                'department_id' => 3,
                'job_title' => 'ICT Officer',
                'description' => 'Information technology officer'
            ],
            [
                'department_id' => 4,
                'job_title' => 'Accountant',
                'description' => 'Finance officer'
            ],
            [
                'department_id' => 5,
                'job_title' => 'Operations Officer',
                'description' => 'Operations department officer'
            ],
        ]);
    }
}