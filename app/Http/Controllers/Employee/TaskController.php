<?php
namespace App\Http\Controllers\Employee;

use App\Models\Task;
use App\Models\TaskUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;



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

    public function show(Task $task)
    {
    // Prevent employees from viewing other employees' tasks
    if ($task->assigned_to != Auth::id()) {
        abort(403);
    }

    

    $task->load('updates.user');

    return view('employee.tasks.show', compact('task'));
    }

    public function saveProgress(Request $request, Task $task)
{
    if ($task->assigned_to != auth()->id()) {
        abort(403);
    }

    $request->validate([
        'progress' => 'required|integer|min:0|max:100',
        'comment' => 'nullable|string',
        'submission_type' => 'nullable|in:file,link',
        'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xlsx,zip,jpg,jpeg,png|max:10240',
        'submission_link' => 'nullable|url',
    ]);

    $filePath = null;

    if ($request->hasFile('file')) {

        $filePath = $request
            ->file('file')
            ->store('task-submissions', 'public');
    }

    TaskUpdate::create([

        'task_id' => $task->id,

        'updated_by' => auth()->id(),

        'progress' => $request->progress,

        'comment' => $request->comment,

        'submission_type' => $request->submission_type,

        'file_path' => $filePath,

        'submission_link' => $request->submission_link,

    ]);

    if ($task->status == 'pending') {

        $task->update([
            'status' => 'in_progress'
        ]);

    }

    return back()->with('success', 'Progress saved successfully.');
}

public function submit(Task $task)
{
    if ($task->assigned_to != auth()->id()) {
        abort(403);
    }

    $task->update([

        'review_status' => 'submitted',

        'submitted_at' => now(),

    ]);

    

    return back()->with(
        'success',
        'Task submitted to manager successfully.'
    );
}

}