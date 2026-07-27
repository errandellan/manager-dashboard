<?php

namespace App\Http\Controllers\Manager;


use App\Http\Controllers\Controller;
use App\Models\AttendanceLog;
use Illuminate\Http\Request;
use App\Models\Department;




class AttendanceController extends Controller
{

public function index(Request $request)
{
    $query = AttendanceLog::with('user.department');

    /*
    |--------------------------------------------------------------------------
    | Date Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filter == 'today') {

        $query->whereDate('login_time', today());

    } elseif ($request->filter == 'week') {

        $query->whereBetween('login_time', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);

    } elseif ($request->filter == 'month') {

        $query->whereMonth('login_time', now()->month)
              ->whereYear('login_time', now()->year);
    }

    /*
    |--------------------------------------------------------------------------
    | Search Employee
    |--------------------------------------------------------------------------
    */

    if ($request->filled('search')) {

        $query->whereHas('user', function ($q) use ($request) {

            $q->where('name', 'like', '%' . $request->search . '%');

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Department Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('department')) {

        $query->whereHas('user', function ($q) use ($request) {

            $q->where('department_id', $request->department);

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Status Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('status')) {

        $query->where('status', $request->status);

    }

    

    $attendanceLogs = $query->latest()->paginate(10);

    $todayRecords = AttendanceLog::whereDate('login_time', today())->count();

    $activeEmployees = AttendanceLog::where('status', 'active')->count();

    $inactiveEmployees = AttendanceLog::where('status', 'inactive')->count();

    $totalEmployees = \App\Models\User::where('role_id',3)->count();

    $departments = \App\Models\Department::orderBy('department_name')->get();

    return view('manager.attendance.index', compact(
        'attendanceLogs',
        'todayRecords',
        'activeEmployees',
        'inactiveEmployees',
        'totalEmployees',
        'departments'
    ));
}
   


}