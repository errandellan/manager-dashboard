@extends('layouts.manager')

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-3xl font-bold">
            Performance Dashboard
        </h1>

        <p class="text-gray-500">
            Employee performance evaluation and ranking.
        </p>
    </div>

    <form action="{{ route('manager.performance.calculate') }}" method="POST">
        @csrf

        <button
            class="bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-lg">

            Calculate Performance

        </button>
    </form>

</div>


@if(session('success'))

<div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded-lg mb-6">

    {{ session('success') }}

</div>

@endif


<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

    <div class="bg-white shadow rounded-xl p-6">

        <p class="text-gray-500">Employees Rated</p>

        <h2 class="text-4xl font-bold">

            {{ $employeesRated }}

        </h2>

    </div>

    <div class="bg-white shadow rounded-xl p-6">

        <p class="text-gray-500">Average Score</p>

        <h2 class="text-4xl font-bold text-blue-600">

            {{ $averageScore }}%

        </h2>

    </div>

    <div class="bg-white shadow rounded-xl p-6">

        <p class="text-gray-500">Highest Score</p>

        <h2 class="text-4xl font-bold text-green-600">

            {{ $highestScore }}%

        </h2>

    </div>

    <div class="bg-white shadow rounded-xl p-6">

        <p class="text-gray-500">Top Performer</p>

        <h2 class="text-xl font-bold">

            {{ $topPerformer?->user?->name ?? 'N/A' }}

        </h2>

    </div>

</div>



<div class="bg-white shadow rounded-xl p-6 mb-8">

    <h2 class="text-xl font-bold mb-5">

        Overall Performance Ranking

    </h2>

    <canvas id="performanceChart" height="120"></canvas>

</div>



<div class="bg-white shadow rounded-xl overflow-hidden">

<table class="min-w-full">

<thead class="bg-green-700 text-white">

<tr>

<th class="px-4 py-3">Rank</th>
<th class="px-4 py-3">Employee</th>
<th class="px-4 py-3">Attendance</th>
<th class="px-4 py-3">Activity</th>
<th class="px-4 py-3">Tasks</th>
<th class="px-4 py-3">Overall</th>
<th class="px-4 py-3">Month</th>

</tr>

</thead>

<tbody>

@forelse($scores as $score)

<tr class="border-b hover:bg-gray-50">

<td class="px-4 py-3 text-center">

{{ $score->rank }}

</td>

<td class="px-4 py-3">

{{ $score->user?->name ?? 'Unknown Employee' }}

</td>

<td class="px-4 py-3 text-center">

{{ $score->attendance_score }}%

</td>

<td class="px-4 py-3 text-center">

{{ $score->activity_score }}%

</td>

<td class="px-4 py-3 text-center">

{{ $score->task_completion_score }}%

</td>

<td class="px-4 py-3 text-center font-bold text-green-700">

{{ $score->overall_score }}%

</td>

<td class="px-4 py-3 text-center">

{{ \Carbon\Carbon::parse($score->evaluated_month)->format('F Y') }}

</td>

</tr>

@empty

<tr>

<td colspan="7" class="text-center py-10 text-gray-500">

No performance records found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>


<div class="mt-6">

{{ $scores->links() }}

</div>

@endsection
<script>

const ctx = document.getElementById('performanceChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: @json($chartLabels),

        datasets: [{

            label: 'Overall Score',

            data: @json($chartScores),

            borderWidth: 1

        }]

    },

    options: {

        responsive: true,

        scales: {

            y: {

                beginAtZero: true,

                max:100

            }

        }

    }

});

</script>