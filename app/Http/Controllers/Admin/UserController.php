<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\Job;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with([
            'role',
            'department',
            'job'
        ])->get();

        return view('admin.users', compact('users'));
    }
    public function edit(User $user)
    {
        $roles = Role::all();
        $departments = Department::all();
        $jobs = Job::all();

        return view('admin.edit_user', 
        compact('user', 
            'roles',
            'departments',
             'jobs'));
    }
    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => 'required|string|max:20',
        'department_id' => 'required|exists:departments,id',
        'job_id' => 'required|exists:jobs,id',
        'role_id' => 'required|exists:roles,id',
        'status' => 'required|in:active,inactive',
    ]);

    // Prevent the admin from changing their own role
    if (auth()->id() == $user->id && $request->role_id != 1) {
        return redirect()->back()
            ->with('error', 'You cannot remove your own Administrator role.');
    }

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'department_id' => $request->department_id,
        'job_id' => $request->job_id,
        'role_id' => $request->role_id,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('admin.users')
        ->with('success', 'User updated successfully.');
}
}