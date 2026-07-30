<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::where('employee_id', Auth::id())
            ->latest('generated_at')
            ->paginate(10);

        return view('employee.reports.index', compact('reports'));
    }

    public function show(Report $report)
    {
        abort_if($report->employee_id != Auth::id(), 403);

        return view('employee.reports.show', compact('report'));
    }
}