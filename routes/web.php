<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Manager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\Employee\TaskController;

Route::get('/', function () {
    // if (Auth::check()){
    //     switch (Auth::user()->role_id) {
    //         case 1:
    //             return redirect()->route('admin.dashboard');
    //         case 2:
    //             return redirect()->route('manager.dashboard');
    //         case 3:
    //             return redirect()->route('employee.dashboard');
    //         default:
    //             return redirect('/login');
    //     }
    // }
    return view('welcome');
});

// ==============================
// Authentication Routes
// ==============================

// Register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'manager'])->group(function () {
    Route::get('/manager/dashboard', 
    [ManagerDashboardController::class, 'index'])
    ->name('manager.dashboard');
});


Route::middleware(['auth', 'employee'])->group(function () {
    Route::get('/employee/dashboard', 
    [EmployeeDashboardController::class, 'index'])
    ->name('employee.dashboard');
});

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
    ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| side bar  Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','employee'])->group(function(){

    Route::get('/employee/attendance',
    [AttendanceController::class,'index'])
    ->name('employee.attendance');
});
Route::middleware(['auth','employee'])->group(function(){

    Route::get('/employee/tasks',
    [TaskController::class,'index'])
    ->name('employee.tasks');
});



Route::middleware(['auth'])->group(function () {

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::post('/reports/{report}/approve', [ReportController::class, 'approve'])->name('reports.approve');
    Route::post('/reports/{report}/reject', [ReportController::class, 'reject'])->name('reports.reject');
    Route::get('/reports/analytics', [ReportController::class, 'analytics'])->name('reports.analytics');
    Route::get('/reports/activity', [ReportController::class, 'activity'])->name('reports.activity');
    Route::get('/reports/{report}',[App\Http\Controllers\ReportController::class, 'show'])->name('reports.show');
});



// require __DIR__.'/auth.php';
