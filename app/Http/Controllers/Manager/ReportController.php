<?php



namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with(['employee','employee'])
            ->latest('generated_at')
            ->paginate(10);

        return view('manager.reports.index', compact('reports'));
    }

    public function create()
    {
        $employees = User::where('role_id',3)
            ->orderBy('name')
            ->get();

        return view('manager.reports.create', compact('employees'));
    }
    public function store(Request $request)
{
    $request->validate([
        'employee_id' => 'required|exists:users,id',
        'report_name' => 'required',
        'report_type' => 'required',
        'description' => 'nullable',
    ]);

    Report::create([
        'generated_by' => auth()->id(),
        'employee_id' => $request->employee_id,
        'report_name' => $request->report_name,
        'report_type' => $request->report_type,
        'description' => $request->description,
        'generated_at' => now(),
    ]);

    return redirect()->route('manager.reports')
        ->with('success','Report generated successfully.');
}

public function show(Report $report)
{
    return view('manager.reports.show', compact('report'));
}
}