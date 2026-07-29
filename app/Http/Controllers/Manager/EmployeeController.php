<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role_id', 3);

        // Search employee
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Department filter
        if ($request->filled('department')) {
            $query->where('department_id', $request->department);
        }

        $employees = $query
            ->with(['department', 'job'])
            ->paginate(10);

        $departments = Department::orderBy('department_name')->get();

        return view('manager.employees.index', compact(
            'employees',
            'departments'
        ));
    }

    public function show(User $user)
    {
        abort_if($user->role_id != 3, 404);

        $user->load([
            'department',
            'job',
            'attendanceLogs',
            'tasks',
            
            'performanceScores'
        ]);

        return view('manager.employees.show', compact('user'));
    }
}