<?php
namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
class TaskController extends Controller
{
    public function index()
    {
        $employee = Auth::user();

        $tasks = Task::where('assigned_to', $employee->id)
                     ->latest()
                     ->get();
        return view('employee.tasks.index',
        compact('tasks'));

    }
}