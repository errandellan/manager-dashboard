<?php

namespace App\Http\Controllers\Manager;

use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Manager\TaskController;




class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = \App\Models\Task::with(['employee', 'manager'])
                ->latest()
                ->paginate(10);

    $totalTasks = \App\Models\Task::count();

    $pendingTasks = \App\Models\Task::where('status', 'pending')->count();

    $inProgressTasks = \App\Models\Task::where('status', 'in_progress','submitted')->count();

    $completedTasks = \App\Models\Task::where('status', 'completed')->count();

    return view('manager.tasks.index', compact(
        'tasks',
        'totalTasks',
        'pendingTasks',
        'inProgressTasks',
        'completedTasks'
    ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = User::where('role_id', 3)
        ->orderBy('name')
        ->get();

        return view('manager.tasks.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'assigned_to' => 'required|exists:users,id',

        'title' => 'required|string|max:255',

        'description' => 'nullable|string',

        'priority' => 'required|in:low,medium,high',

        'due_date' => 'nullable|date',

    ]);

    Task::create([

        'assigned_by' => Auth::id(),

        'assigned_to' => $request->assigned_to,

        'title' => $request->title,

        'description' => $request->description,

        'priority' => $request->priority,

        'status' => 'pending',

        'due_date' => $request->due_date,
        
        ]);

        return redirect()
        ->route('manager.tasks.index')
        ->with('success', 'Task assigned successfully to user {{$user->employee??->name }} ');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
    $task->load([
        'employee',
        'updates.user'
    ]);

    return view(
        'manager.tasks.show',
        compact('task')
    );
        }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
         $employees = User::where('role_id', 3)
        ->orderBy('name')
        ->get();

        return view('manager.tasks.edit', compact(
        'task',
        'employees'
    ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  Task $task)
    {
        $request->validate([
        'assigned_to' => 'required|exists:users,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'priority' => 'required|in:low,medium,high',
        'status' => 'required|in:pending,in_progress,submitted,completed',
        'due_date' => 'nullable|date',
    ]);

    $task->update([
        'assigned_to' => $request->assigned_to,
        'title' => $request->title,
        'description' => $request->description,
        'priority' => $request->priority,
        'status' => $request->status,
        'due_date' => $request->due_date,
    ]);

    return redirect()
        ->route('manager.tasks.index')
        ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
         $task->delete();

         return redirect()
        ->route('manager.tasks.index')
        ->with('success', 'Task deleted successfully.');
    }

    public function review(Request $request, Task $task)
{
    $request->validate([
        'decision' => 'required|in:approved,rejected',
        'feedback' => 'nullable|string',
    ]);

    $latestUpdate = $task->updates()->latest()->first();

    if ($latestUpdate) {

        $latestUpdate->update([

            'manager_feedback' => $request->feedback,

            'reviewed_at' => now(),

        ]);

    }

    if ($request->decision == 'approved') {

        $task->update([

            'status' => 'completed',

        ]);

    } else {

        $task->update([

            'status' => 'in_progress',

        ]);

    }

    return redirect()
        ->route('manager.tasks.show', $task)
        ->with('success', 'Review completed successfully.');
}
}
