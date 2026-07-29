<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\PerformanceScore;
use Illuminate\Support\Facades\Auth;

class PerformanceController extends Controller
{
    public function index()
    {
        $performances = PerformanceScore::where('user_id', Auth::id())
            ->latest('evaluated_month')
            ->paginate(10);

        return view('employee.performance.index', compact('performances'));
    }
}