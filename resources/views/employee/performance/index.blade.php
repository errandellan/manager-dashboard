@extends('layouts.employee')

@section('content')

<h2 class="text-3xl font-bold mb-6">
    My Performance
</h2>

<div class="bg-white rounded-xl shadow overflow-hidden">

    <table class="min-w-full">

        <thead class="bg-green-700 text-white">

            <tr>
                <th class="px-4 py-3 text-left">Month</th>
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

                <td class="px-4 py-3">
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

                <td class="px-4 py-3 text-center font-bold">

                    @if($performance->overall_score >= 80)
                        <span class="text-green-600">
                            {{ $performance->overall_score }}%
                        </span>

                    @elseif($performance->overall_score >= 60)
                        <span class="text-yellow-600">
                            {{ $performance->overall_score }}%
                        </span>

                    @else
                        <span class="text-red-600">
                            {{ $performance->overall_score }}%
                        </span>

                    @endif

                </td>

                <td class="px-4 py-3 text-center">
                    {{ $performance->rank ?? '-' }}
                </td>

            </tr>

        @empty

            <tr>

                <td colspan="6"
                    class="text-center py-8 text-gray-500">

                    No performance records available.

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