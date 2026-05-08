<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller

{
    public function index(){
        $user = Auth::user();

        //get status filter from URL 
        $status = request('status');
        $search = request('search');

        //employee can only see their own reports, managers and admins can see all reports
        if($user->role_id == 3){
            //employee can only see their own reports
            $reports = Report::where('user_id', $user->id);
            
        }else{
            //managers and admins can see all reports
            $reports = Report::with('user');
        }

        //apply filter if selected 
        if($status){
            $reports = $reports->where('status', $status);
            
        }
        if($search){
            $reports = $reports->where(function($query) use ($search){
                $query->where('title', 'like', "%$search%")
                      ->orWhere('description', 'like', "%$search%" )
                      ->orWhereHas('user', function($userQuery) use ($search){
                          $userQuery->where('name', $search);
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
        return view('reports.index', compact(
            'reports', 'totalReports', 'pendingReports', 'approvedReports', 'rejectedReports'
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