<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return view('admin.departments', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create-department');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'department_name' => 'required|unique:departments|max:255',
        'description' => 'nullable|string',
    ]);

    Department::create([
        'department_name' => $request->department_name,
        'description' => $request->description,
    ]);

    return redirect()
        ->route('admin.departments')
        ->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('admin.edit-department', compact('department'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
        'department_name' => 'required|max:255|unique:departments,department_name,' . $department->id,
        'description' => 'nullable|string',
    ]);

    $department->update([
        'department_name' => $request->department_name,
        'description' => $request->description,
    ]);

    return redirect()
        ->route('admin.departments')
        ->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()
            ->route('admin.departments')
            ->with('success', 'Department deleted successfully.');
    }
}
