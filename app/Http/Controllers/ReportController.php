<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Department;

class ReportController extends Controller
{

    // MAIN REPORT PAGE
    public function index()
    {
        $user = Auth::user();

        // filters
        $status = request('status');
        $department = request('department');
        $search = request('search');

        // employee only sees own reports
        if ($user->role_id == 3) {

            $reports = Report::where('user_id', $user->id);

        } else {

            // admin and manager see all
            $reports = Report::with('user.department');

        }

        // status filter
        if ($status) {

            $reports = $reports->where('status', $status);

        }

        // department filter
        if ($department) {

            $reports = $reports->whereHas(
                'user.department',

                function ($query) use ($department) {

                    $query->where('id', $department);

                }
            );
        }

        // search filter
        if ($search) {

            $reports = $reports->where(function ($query) use ($search) {

                $query->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhereHas(
                        'user',

                        function ($userQuery) use ($search) {

                            $userQuery->where(
                                'name',
                                'like',
                                "%$search%"
                            );

                        }
                    )
                    ->orWhereHas(
                        'user.department',

                        function ($departmentQuery) use ($search) {

                            $departmentQuery->where(
                                'name',
                                'like',
                                "%$search%"
                            );

                        }
                    );

            });

        }

        // final paginated reports
        $reports = $reports->latest()->paginate(5);

        // summary cards
        $totalReports = Report::count();

        $pendingReports = Report::where(
            'status',
            'pending'
        )->count();

        $approvedReports = Report::where(
            'status',
            'approved'
        )->count();

        $rejectedReports = Report::where(
            'status',
            'rejected'
        )->count();

        // departments for filter dropdown
        $departments = Department::all();

        return view(
            'reports.index',

            compact(
                'reports',
                'totalReports',
                'pendingReports',
                'approvedReports',
                'rejectedReports',
                'departments'
            )
        );
    }



    // ANALYTICS PAGE
    public function analytics()
    {
        // only admin and manager
        if (!in_array(Auth::user()->role_id, [1, 2])) {

            abort(403);

        }

        // report status analytics
        $statusCounts = [

            'pending' => Report::where(
                'status',
                'pending'
            )->count(),

            'approved' => Report::where(
                'status',
                'approved'
            )->count(),

            'rejected' => Report::where(
                'status',
                'rejected'
            )->count(),
        ];



        // department analytics
        $departmentCounts = Department::withCount('users')
            ->get()
            ->map(function ($department) {

                return [

                    'name' => $department->name,

                    'reports_count' => Report::whereHas(
                        'user.department',

                        function ($query) use ($department) {

                            $query->where(
                                'department_id',
                                $department->id
                            );

                        }

                    )->count()
                ];
            });

        return view(
            'reports.analytics',

            compact(
                'statusCounts',
                'departmentCounts'
            )
        );
    }



    // ACTIVITY FEED PAGE
    public function activity()
    {
        // only admin and manager
        if (!in_array(Auth::user()->role_id, [1, 2])) {

            abort(403);

        }

        $recentReports = Report::with('user')
            ->latest()
            ->take(10)
            ->get();

        return view(
            'reports.activity',

            compact('recentReports')
        );
    }



    // SHOW CREATE REPORT FORM
    public function create()
    {
        // only employee
        if (Auth::user()->role_id != 3) {

            abort(403, 'Unauthorized action.');

        }

        return view('reports.create');
    }



    // STORE REPORT
    public function store(Request $request)
    {
        // only employee
        if (Auth::user()->role_id != 3) {

            abort(403, 'Unauthorized action.');

        }

        $request->validate([

            'title' => 'required|string|max:255',

            'description' => 'required|string',

        ]);

        Report::create([

            'user_id' => Auth::id(),

            'title' => $request->input('title'),

            'description' => $request->input('description'),

        ]);

        return redirect()
            ->route('reports.index')
            ->with(
                'success',
                'Report created successfully.'
            );
    }



    // APPROVE REPORT
    public function approve(Report $report)
    {
        // only manager
        if (Auth::user()->role_id != 2) {

            abort(
                403,
                'Only managers have this privilege.'
            );

        }

        $report->update([

            'status' => Report::STATUS_APPROVED

        ]);

        return redirect()
            ->route('reports.index')
            ->with(
                'success',
                'Report approved successfully.'
            );
    }



    // REJECT REPORT
    public function reject(Report $report)
    {
        // only manager
        if (Auth::user()->role_id != 2) {

            abort(
                403,
                'Only managers have this privilege.'
            );

        }

        $report->update([

            'status' => Report::STATUS_REJECTED

        ]);

        return redirect()
            ->route('reports.index')
            ->with(
                'success',
                'Report rejected successfully.'
            );
    }

}