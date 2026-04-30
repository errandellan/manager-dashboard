<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller

{
    public function index(){
        $reports = Report::with('user')->latest()->get();
        return view('reports.index', compact('reports'));
    }

    //show create forms
    public function create()
    {
        return view('reports.create');
    }
    
    //Store report
    public function store(Request $request)
    {
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
