<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AttendanceLog;
use App\Models\Task;
use App\Models\Report;

class DashboardController extends Controller
{
    public function index()
    {
    $employees = User::whereIn('role_id', [3,2])->count();

    $attendance = AttendanceLog::count();

    $pendingTasks = Task::where('status', 'pending')->count();

    $reports = Report::count();

    return view('manager.dashboard', compact(
        'employees',
        'attendance',
        'pendingTasks',
        'reports'
    ));

    
    }
}
