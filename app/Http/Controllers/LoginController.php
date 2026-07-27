<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AttendanceLog;

class LoginController extends Controller
{
    /**
     * Show the login page.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Authenticate the user.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // Prevent duplicate active attendance sessions
            $activeAttendance = AttendanceLog::where('user_id', $user->id)
                ->where('status', 'active')
                ->first();

            if (!$activeAttendance) {
                AttendanceLog::create([
                    'user_id' => $user->id,
                    'login_time' => now(),
                    'status' => 'active',
                ]);
            }

            if ($user->role_id == 1) {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role_id == 2) {
                return redirect()->route('manager.dashboard');
            }

            if ($user->role_id == 3) {
                return redirect()->route('employee.dashboard');
            }

            Auth::logout();

            return redirect('/login')->withErrors([
                'email' => 'Your account has no valid role.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }

    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        $attendance = AttendanceLog::where('user_id', Auth::id())
        ->where('status', 'active')
        ->latest()
        ->first();

    if ($attendance) {

        $logoutTime = now();

        $attendance->update([
            'logout_time' => $logoutTime,
            'session_duration' => $attendance->login_time->diffInMinutes($logoutTime),
            'status' => 'inactive',
        ]);
    }
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}