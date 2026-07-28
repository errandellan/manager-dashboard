<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use App\Models\Job;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalDepartments = Department::count();

        $totalJobs = Job::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDepartments',
            'totalJobs'
        ));
    }
}