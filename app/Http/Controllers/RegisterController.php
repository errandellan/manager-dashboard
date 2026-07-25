<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display the registration page.
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Store a newly registered employee.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|string|max:20',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'password'      => Hash::make($request->password),

            // Every self-registered user becomes an Employee
            'role_id'       => 3,

            // Default department and job
            'department_id' => 1,
            'job_id'        => 1,

            'status'        => 'active',
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Account created successfully. Please log in.');
    }
}