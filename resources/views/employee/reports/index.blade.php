@extends('layouts.employee')

@section('content')

<h2 class="text-2xl font-bold mb-6">
    My Reports
</h2>

@if($reports->count())

<table class="min-w-full bg-white border rounded-lg">
    <thead class="bg-green-700 text-white">
        <tr>
            <th class="px-4 py-3 text-left">Report Name</th>
            <th class="px-4 py-3 text-left">Type</th>
            <th class="px-4 py-3 text-left">Generated On</th>
            <th class="px-4 py-3 text-center">Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($reports as $report)
        <tr class="border-b hover:bg-gray-50">
            <td class="px-4 py-3">
                {{ $report->report_name }}
            </td>

            <td class="px-4 py-3">
                {{ ucfirst($report->report_type) }}
            </td>

            <td class="px-4 py-3">
                {{ \Carbon\Carbon::parse($report->generated_at)->format('d M Y H:i') }}
            </td>

            <td class="px-4 py-3 text-center">
                <a href="{{ route('employee.reports.show', $report) }}"
                   class="text-green-700 font-semibold hover:underline">
                    View
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-6">
    {{ $reports->links() }}
</div>

@else

<div class="bg-yellow-100 border border-yellow-400 text-yellow-800 p-4 rounded">
    No reports have been assigned to you yet.
</div>

@endif

@endsection