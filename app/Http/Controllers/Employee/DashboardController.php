<?php

namespace App\Http\Controllers\Employee;

use App\Models\Task;
use App\Models\AttendanceLog;
use App\Models\PerformanceScore;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $employee = Auth::user();

        // Count assigned tasks
        $totalTasks = Task::where('assigned_to', $employee->id)
                          ->count();

        // Count completed tasks

        $completedTasks = Task::where('assigned_to', $employee->id)
                              ->where('status','completed')
                              ->count();

        // Count pending tasks

        $pendingTasks = Task::where('assigned_to', $employee->id)
                            ->where('status','pending')
                            ->count();

        // Today's attendance

        $attendance = AttendanceLog::where('user_id',$employee->id)
                                   ->latest()
                                   ->first();

        // Performance score
        $performance = PerformanceScore::where('user_id',$employee->id)
                                       ->latest()
                                       ->first();
        return view('employee.dashboard', compact(
            'employee',
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'attendance',
            'performance'
        ));

    }

}