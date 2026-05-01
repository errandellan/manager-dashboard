<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller

{
    public function index(){
        $user = Auth::user();
        if($user->role_id == 3){
            //employee can only see their own reports
            $reports = Report::where('user_id', $user->id)->latest()->get();
            
        }else{
            //managers and admins can see all reports
            $reports = Report::with('user')->latest()->get();
        }
        // $reports = Report::with('user')->latest()->get();
        return view('reports.index', compact('reports'));
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
}
