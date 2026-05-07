<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Admin views all users
    public function index()
    {
        if (Auth::user()->role_id != 1) {
            abort(403, 'Unauthorized action.');
        }

        $users = User::all();

        return view('users.index', compact('users'));
    }

    // Admin updates user role
    public function updateRole(Request $request, User $user)
    {
        if (Auth::user()->role_id != 1) {
            abort(403, 'Unauthorized action.');
        }

        // Prevent admin changing own role
        if ($user->id == Auth::id()) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot change your own role.');
        }

        $user->role_id = $request->input('role_id');
        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'User role updated successfully.');
    }

    // Admin deletes user
    public function destroy(User $user)
    {
        if (Auth::user()->role_id != 1) {
            abort(403, 'Unauthorized action.');
        }

        // Prevent self delete
        if (Auth::id() == $user->id) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
       
}
}