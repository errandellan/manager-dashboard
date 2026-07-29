<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Task;
use App\Models\AttendanceLog;
use App\Models\PerformanceScore;
use Carbon\Carbon;

class PerformanceController extends Controller
{
   public function index()
{
    $scores = PerformanceScore::with('user')
        ->latest('evaluated_month')
        ->orderBy('rank')
        ->paginate(10);

    $employeesRated = PerformanceScore::count();

    $averageScore = round(PerformanceScore::avg('overall_score'), 2);

    $highestScore = PerformanceScore::max('overall_score');

    $topPerformer = PerformanceScore::with('user')
        ->orderByDesc('overall_score')
        ->first();

    $chartData = $scores->map(function ($score) {
    return [
        'employee' => $score->user->name,
        'overall' => $score->overall_score,
    ];
});

    $chartData = PerformanceScore::with('user')
    ->orderByDesc('overall_score')
    ->get();


    $chartLabels = $chartData->pluck('user.name');

    $chartScores = $chartData->pluck('overall_score');

    return view('manager.performance.index', compact(
        'scores',
        'employeesRated',
        'averageScore',
        'highestScore',
        'topPerformer',
        'chartLabels',
        'chartScores'
    ));
}

   public function calculate()
{
    $employees = User::where('role_id', 3)->get();

    foreach ($employees as $employee) {

        /*
        |--------------------------------------------------------------------------
        | Attendance Score
        |--------------------------------------------------------------------------
        */

        $attendanceCount = AttendanceLog::where('user_id', $employee->id)
            ->count();

        $attendanceScore = min(($attendanceCount / 22) * 100, 100);


        /*
        |--------------------------------------------------------------------------
        | Task Completion Score
        |--------------------------------------------------------------------------
        */

        $totalTasks = Task::where('assigned_to', $employee->id)->count();

        $completedTasks = Task::where('assigned_to', $employee->id)
            ->where('status', 'completed')
            ->count();

        $taskScore = $totalTasks > 0
            ? ($completedTasks / $totalTasks) * 100
            : 0;


        /*
        |--------------------------------------------------------------------------
        | Activity Score
        |--------------------------------------------------------------------------
        */

        $activityScore = 0;


        /*
        |--------------------------------------------------------------------------
        | Overall Score
        |--------------------------------------------------------------------------
        */

        $overallScore = round(

            ($attendanceScore + $taskScore + $activityScore) / 3,

            2

        );


        /*
        |--------------------------------------------------------------------------
        | Save
        |--------------------------------------------------------------------------
        */

        PerformanceScore::updateOrCreate(

            [

                'user_id' => $employee->id,

                'evaluated_month' => Carbon::now()->startOfMonth(),

            ],

            [

                'attendance_score' => round($attendanceScore,2),

                'activity_score' => round($activityScore,2),

                'task_completion_score' => round($taskScore,2),

                'overall_score' => $overallScore,

            ]

        );

    }


    /*
    |--------------------------------------------------------------------------
    | Ranking
    |--------------------------------------------------------------------------
    */

    $scores = PerformanceScore::where(
        'evaluated_month',
        Carbon::now()->startOfMonth()
    )
    ->orderByDesc('overall_score')
    ->get();

    foreach ($scores as $index => $score) {

        $score->update([

            'rank' => $index + 1

        ]);

    }

    return back()->with(

        'success',

        'Performance calculated successfully.'

    );
}
}