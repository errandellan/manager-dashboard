<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{   
    //making sure only admin can access user management
     public function index()
    {
        if(Auth::user()->role_id != 1){
        abort(403, 'Unauthorized action.');
    }
    //viewing all users for admin
    $users= User::all();
    return view('users.index', compact('users'));

}
public function updateRole(Request $request, User $user)
{
    if(Auth::user()->role_id != 1){
        abort(403, 'Unauthorized action.');
    }
    
    //prevent admin from changing their own role
    if($user->id == Auth::id()){
        return redirect()->route('users.index')->with('error', 'You cannot change your own role.');
    }
    $user = User::findOrFail($user->id);
    $user->role_id = $request->input('role_id');
    $user->save();

    return redirect()->route('users.index')->with('success', 'User role updated successfully.');
}
}
