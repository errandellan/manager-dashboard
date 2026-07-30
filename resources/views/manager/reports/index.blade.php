@extends('layouts.manager')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h2 class="text-2xl font-bold">
        Reports
    </h2>

    <a href="{{ route('manager.reports.create') }}"
       class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 rounded-lg">

        Generate Report

    </a>

</div>

@if(session('success'))

<div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded mb-5">

    {{ session('success') }}

</div>

@endif

<div class="bg-white shadow rounded-lg overflow-hidden">

<table class="w-full">

<thead class="bg-green-700 text-white">

<tr>

<th class="px-4 py-3">Employee</th>

<th class="px-4 py-3">Report Name</th>

<th class="px-4 py-3">Type</th>

<th class="px-4 py-3">Generated</th>

<th class="px-4 py-3">Action</th>

</tr>

</thead>

<tbody>

@forelse($reports as $report)

<tr class="border-b">

<td class="px-4 py-3">

{{ $report->employee->name }}

</td>

<td class="px-4 py-3">

{{ $report->report_name }}

</td>

<td class="px-4 py-3">

{{ ucfirst($report->report_type) }}

</td>

<td class="px-4 py-3">

{{ \Carbon\Carbon::parse($report->generated_at)->format('d M Y') }}

</td>

<td class="px-4 py-3">

<a href="{{ route('manager.reports.show',$report) }}"
class="text-blue-700">

View

</a>

</td>

</tr>

@empty

<tr>

<td colspan="5" class="text-center py-8">

No reports found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-5">

{{ $reports->links() }}

</div>

@endsection