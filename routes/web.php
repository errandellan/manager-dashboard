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
use App\Http\Controllers\Manager\AttendanceController as ManagerAttendanceController;
use App\Http\Controllers\Manager\TaskController as ManagerTaskController;
use App\Http\Controllers\Employee\TaskController as EmployeeTaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Employee\TaskSubmissionController;

Route::get('/', function () {
    if (Auth::check()){
        switch (Auth::user()->role_id) {
            case 1:
                return redirect()->route('admin.dashboard');
            case 2:
                return redirect()->route('manager.dashboard');
            case 3:
                return redirect()->route('employee.dashboard');
            default:
                return redirect('/login');
        }
    }
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
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');

    Route::get('/users', [UserController::class, 'index'])
        ->name('admin.users');

    Route::get('/departments', [DepartmentController::class, 'index'])
    ->name('admin.departments');

    Route::get('/departments/create', [DepartmentController::class, 'create'])
        ->name('admin.departments.create');

    Route::post('/departments', [DepartmentController::class, 'store'])
        ->name('admin.departments.store');

    Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit'])
        ->name('admin.departments.edit');

    Route::put('/departments/{department}', [DepartmentController::class, 'update'])
        ->name('admin.departments.update');

    Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])
        ->name('admin.departments.destroy');

    Route::get('/jobs', function () {
        return view('admin.jobs');
    })->name('admin.jobs');

    Route::get('/settings', function () {   
        return view('admin.settings');
    })->name('admin.settings');



    //Admin user 
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
    ->name('admin.users.edit');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('admin.users.update');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('admin.users.destroy');

    Route::get('/users/{user}/password', [UserController::class, 'resetPassword'])
        ->name('admin.users.reset-password');
    Route::put('/users/{user}/password', [UserController::class, 'updatePassword'])
        ->name('admin.users.update-password');
});


// Manager Routes
Route::middleware(['auth', 'manager'])->prefix('manager')->group(function () {
    Route::get('/dashboard', 
    [ManagerDashboardController::class, 'index'])
    ->name('manager.dashboard');

    Route::get('/attendance',
    [ManagerAttendanceController::class,'index'])
    ->name('manager.attendance');

    Route::resource('tasks',ManagerTaskController::class)
    ->names('manager.tasks');

    Route::post(
    '/tasks/{task}/review',
    [ManagerTaskController::class, 'review']
        )->name('manager.tasks.review');
});

/*
|--------------------------------------------------------------------------
| Employee Routes
|--------------------------------------------------------------------------
*/



Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
    ->name('profile.destroy');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
    ->name('profile.password.update');

    
});

/*
|--------------------------------------------------------------------------
| employee
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','employee'])
    ->prefix('employee')
    ->group(function(){
    Route::get('/dashboard',
    [EmployeeDashboardController::class, 'index'])
    ->name('employee.dashboard');

    Route::get('/attendance',
    [AttendanceController::class,'index'])
    ->name('employee.attendance');

    Route::get('/tasks',
    [EmployeeTaskController::class,'index'])
    ->name('employee.tasks');

    Route::get('/tasks/{task}',
    [EmployeeTaskController::class, 'show'])
    ->name('employee.tasks.show');

    Route::post(
    '/tasks/{task}/start',
    [EmployeeTaskController::class,'start']
    )->name('employee.tasks.start');

    Route::post('/tasks/{task}/progress',
    [EmployeeTaskController::class, 'saveProgress'])
    ->name('employee.tasks.progress');

   Route::post(
    '/tasks/{task}/submit',
    [EmployeeTaskController::class, 'submit']
    )->name('employee.tasks.submit');
 

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


/*
|--------------------------------------------------------------------------
| profile route
|--------------------------------------------------------------------------

/*
|--------------------------------------------------------------------------
| report route 
|--------------------------------------------------------------------------
*/


// require __DIR__.'/auth.php';
