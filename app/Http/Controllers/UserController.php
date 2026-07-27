<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Job;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Admin views all users
    public function index()
    {
        if (Auth::user()->role_id != 1) {
            abort(403, 'Unauthorized action.');
        }

       $users = User::with([
            'role',
            'department',
            'job'
        ])->get();

        return view('admin.users', compact('users'));
    }

    // Admin updates user role
    public function updateRole(Request $request, User $user)
    {
        if (Auth::user()->role_id != 1) {
            abort(403, 'Unauthorized action.');
        }

        // Prevent admin changing own role
        if ($user->id == Auth::id()) {
            return redirect()->route('admin.users')
                ->with('error', 'You cannot change your own role.');
        }

        $user->role_id = $request->input('role_id');
        $user->save();

        return redirect()->route('admin.users')
            ->with('success', 'User role updated successfully.');
    }

        // Admin deletes user
        public function destroy(User $user)
    {
        // Prevent deleting yourself
        if (auth()->id() == $user->id) {

            return back()->with(
                'error',
                'You cannot delete your own account.'
            );
        }

        $user->delete();

        return redirect()
                ->route('admin.users')
                ->with(
                    'success',
                    'User deleted successfully.'
                );
    }

    //reset password for user
    public function resetPassword(User $user)
    {
        if (Auth::user()->role_id != 1) {
            abort(403, 'Unauthorized action.');
        }

        //prevent admin from resetting their own password here
        if ($user->id == Auth::id()) {
            return redirect()->route('admin.users')
                ->with('error', 'use your profile page to change your own password.');
        }
        return view('admin.reset-password', compact('user'));
    }

    public function updatePassword(Request $request, User $user){
        if (Auth::user()->role_id !=1){
            abort(403);
        }
        if ($user->id == Auth::id()){
            return redirect()
            ->route('admin.users')
            ->with('error', 'Use your profile page to change your own password');

        }
        $request->validate([
            'password' => 'required|min:8|confirmed',
            ]);

            $user->password = Hash::make($request->password);

            $user->save();
            return redirect()
        ->route('admin.users')
        ->with('success', 'Password reset successfully.');

        

        
    }
    public function edit(User $user)
    {
        $roles = Role::all();
        $departments = Department::all();
        $jobs = Job::all();

        return view('admin.edit-user', compact('user', 'roles', 'departments', 'jobs'));
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