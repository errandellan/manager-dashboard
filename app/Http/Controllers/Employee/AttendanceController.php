<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AttendanceLog;

class AttendanceController extends Controller
{
    public function index()
    {
        $employee = Auth::user();

        $attendanceLogs = AttendanceLog::where('user_id', $employee->id)
                                      ->latest()
                                      ->get();
        return view('employee.attendance.index',
        compact('attendanceLogs'));
    }
}