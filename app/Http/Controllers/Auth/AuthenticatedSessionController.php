<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AttendanceLog;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        $user  = Auth::user();

         // Create attendance record when user logs in

    AttendanceLog::create([

        'user_id' => $user->id,

        'login_time' => now(),

        'status' => 'active'

    ]);

    dd($attendance);


        switch ($user->role_id) {
            case 1:
                return redirect()->route('admin.dashboard');
            case 2:
                return redirect()->route('manager.dashboard');
            case 3:
                return redirect()->route('employee.dashboard');
            default:
                Auth::logout();
        }
        return redirect('/login')
            ->withErrors([
                'email' => 'Unauthorized access.'
                ]);
    }

    public function destroy(Request $request): RedirectResponse
{

    $attendance = AttendanceLog::where('user_id', Auth::id())
                    ->where('status','active')
                    ->latest()
                    ->first();



    if($attendance){

        $attendance->update([

            'logout_time' => now(),

            'session_duration' => now()
                ->diffInMinutes($attendance->login_time),

            'status' => 'inactive'

        ]);

    }




    Auth::guard('web')->logout();


    $request->session()->invalidate();

    $request->session()->regenerateToken();



    return redirect('/login');
}
}
