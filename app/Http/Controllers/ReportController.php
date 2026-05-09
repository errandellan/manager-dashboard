<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Department;

class ReportController extends Controller

{
    public function index(){
        $user = Auth::user();

        //get status filter from URL 
        $status = request('status');
        $department = request('department');
        $search = request('search');

        //employee can only see their own reports, managers and admins can see all reports
        if($user->role_id == 3){
            //employee can only see their own reports
            $reports = Report::where('user_id', $user->id);
            
        }else{
            //managers and admins can see all reports
            $reports = Report::with('user.department');
        }

        //apply filter if selected 
        if($status){
            $reports = $reports->where('status', $status);
            
        }
        if($department){
            $reports = $reports->whereHas('user.department', function($query) use ($department){
                $query->where('id', $department);
            });
        }
        if($search){
            $reports = $reports->where(function($query) use ($search){
                $query->where('title', 'like', "%$search%")
                      ->orWhere('description', 'like', "%$search%" )
                      ->orWhereHas('user.department', function($departmentQuery) use ($search){
                          $departmentQuery->where('name', $search);
                      });
                      
            });
        }
        //Final result with pagination that shows the latest reports first 
        //after 5 reports, it will show the next page with the next 5 reports and so on
         $reports = $reports->latest()->paginate(5);

        //creating a dashboard summary of reports by status
        $totalReports = $reports->count();

        $pendingReports = $reports->where('status', 'pending')->count();

        $approvedReports = $reports->where('status', 'approved')->count();

        $rejectedReports = $reports->where('status', 'rejected')->count();
        $departments = Department::all();

        //creating a chart data for reports by department
        $statusCounts=[
            'pending' => $reports->where('status', 'pending')->count(),
            'approved' => $reports->where('status', 'approved')->count(),
            'rejected' => $reports->where('status', 'rejected')->count(),
        ];

        //how many reports each department submitted
        $departmentCounts = Department::withCount('users')
        ->get()
        ->map(function($department){
            return [
                'name' => $department->name,
                'reports_count' => Report::whereHas('user.department', function($query) use ($department){
                    $query->where('department_id', $department->id);
                })->count()
            ];
        });

        //professional activity feed
        $recentReports = Report::with('user')->latest()->take(5)->get();


        return view('reports.index', compact(
            'reports', 'totalReports', 'pendingReports', 'approvedReports', 'rejectedReports', 'departments', 'statusCounts', 'departmentCounts', 'recentReports'
        ));
    }

    //show create forms
    public function create()
    {
        if(Auth::user()->role_id != 3) {
            abort(403, 'Unauthorized action.');
        }
        return view('reports.create');
    }
    
    //Store report
    public function store(Request $request)
   
    {   //does not store other than employee reports
         if(Auth::user()->role_id != 3) {
        abort(403, 'Unauthorized action.');
     }  
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
	// save to database 
	
    Report::create([
        'user_id' => Auth::id(),
        'title' => $request->input('title'),
        'description' => $request->input('description'),
    ]);

    return redirect()->route('reports.index')->with('success', 'Report created successfully.');
}
public function approve(Report $report){
    //only manager can approve
    if(Auth::user()->role_id != 2) {
        abort(403, 'Only managers have this privilege.');
}
$report->update([
    'status' => Report::STATUS_APPROVED
    ]);
return redirect()->route('reports.index')->with('success', 'Report approved successfully.');
}
public function reject(Report $report){
    //only manager can reject
    if(Auth::user()->role_id != 2) {
        abort(403, 'Only managers have this privilege.');
}
$report->update([
    'status' => Report::STATUS_REJECTED
    ]);
return redirect()->route('reports.index')->with('success', 'Report rejected successfully.');
}
}