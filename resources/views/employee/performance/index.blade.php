@extends('layouts.employee')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    📈 My Performance
</h1>

@if($performances->count())

@php
    $latest = $performances->first();
@endphp

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

    <div class="bg-white shadow rounded-xl p-6">
        <p class="text-gray-500">Overall Score</p>
        <h2 class="text-4xl font-bold text-green-700">
            {{ $latest->overall_score }}%
        </h2>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <p class="text-gray-500">Attendance</p>
        <h2 class="text-4xl font-bold text-blue-700">
            {{ $latest->attendance_score }}%
        </h2>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <p class="text-gray-500">Task Score</p>
        <h2 class="text-4xl font-bold text-purple-700">
            {{ $latest->task_completion_score }}%
        </h2>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <p class="text-gray-500">Current Rank</p>
        <h2 class="text-4xl font-bold text-orange-600">
            #{{ $latest->rank }}
        </h2>
    </div>

</div>

<!-- Performance Remark -->
<div class="bg-white shadow rounded-xl p-6 mb-8">

    <h2 class="text-xl font-bold mb-4">
        Performance Remark
    </h2>

    @if($latest->overall_score >= 90)

        <div class="bg-green-100 text-green-800 rounded-lg p-4">
            <strong>Excellent!</strong><br>
            Your attendance and task completion are outstanding.
            Keep maintaining this level of performance.
        </div>

    @elseif($latest->overall_score >= 75)

        <div class="bg-blue-100 text-blue-800 rounded-lg p-4">
            <strong>Good Performance.</strong><br>
            You are performing well. Continue improving your task completion and consistency.
        </div>

    @elseif($latest->overall_score >= 50)

        <div class="bg-yellow-100 text-yellow-800 rounded-lg p-4">
            <strong>Average Performance.</strong><br>
            There is room for improvement, especially in completing assigned tasks.
        </div>

    @else

        <div class="bg-red-100 text-red-800 rounded-lg p-4">
            <strong>Needs Improvement.</strong><br>
            Please improve your attendance and complete more assigned tasks.
        </div>

    @endif

</div>

@endif

<!-- Performance History -->
<div class="bg-white shadow rounded-xl overflow-hidden">

    <div class="bg-green-700 text-white px-6 py-4">
        <h2 class="text-xl font-bold">
            Performance History
        </h2>
    </div>

    <table class="min-w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="px-4 py-3 text-center">Month</th>
                <th class="px-4 py-3 text-center">Attendance</th>
                <th class="px-4 py-3 text-center">Activity</th>
                <th class="px-4 py-3 text-center">Tasks</th>
                <th class="px-4 py-3 text-center">Overall</th>
                <th class="px-4 py-3 text-center">Rank</th>

            </tr>

        </thead>

        <tbody>

        @forelse($performances as $performance)

            <tr class="border-b hover:bg-gray-50">

                <td class="px-4 py-3 text-center">
                    {{ \Carbon\Carbon::parse($performance->evaluated_month)->format('F Y') }}
                </td>

                <td class="px-4 py-3 text-center">
                    {{ $performance->attendance_score }}%
                </td>

                <td class="px-4 py-3 text-center">
                    {{ $performance->activity_score }}%
                </td>

                <td class="px-4 py-3 text-center">
                    {{ $performance->task_completion_score }}%
                </td>

                <td class="px-4 py-3 text-center">

                    @if($performance->overall_score >= 90)

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold">
                            {{ $performance->overall_score }}%
                        </span>

                    @elseif($performance->overall_score >= 75)

                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-semibold">
                            {{ $performance->overall_score }}%
                        </span>

                    @elseif($performance->overall_score >= 50)

                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-semibold">
                            {{ $performance->overall_score }}%
                        </span>

                    @else

                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold">
                            {{ $performance->overall_score }}%
                        </span>

                    @endif

                </td>

                <td class="px-4 py-3 text-center font-bold">
                    #{{ $performance->rank }}
                </td>

            </tr>

        @empty

            <tr>

                <td colspan="6" class="text-center py-10 text-gray-500">

                    No performance records found.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

<div class="mt-6">
    {{ $performances->links() }}
</div>

@endsection