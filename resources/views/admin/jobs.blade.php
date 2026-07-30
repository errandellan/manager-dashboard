@extends('layouts.admin')

@section('content')

<h2 class="text-3xl font-bold mb-6">
    Jobs
</h2>

<div class="bg-white shadow rounded-lg overflow-hidden">

    <table class="w-full">

        <thead class="bg-green-700 text-white">

            <tr>
                <th class="px-4 py-3 text-left">ID</th>
                <th class="px-4 py-3 text-left">Job Title</th>
            </tr>

        </thead>

        <tbody>

        @forelse($jobs as $job)

            <tr class="border-b hover:bg-gray-50">

                <td class="px-4 py-3">
                    {{ $job->id }}
                </td>

                <td class="px-4 py-3">
                    {{ $job->job_title }}
                </td>

            </tr>

        @empty

            <tr>

                <td colspan="2" class="text-center py-8">
                    No jobs found.
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

<div class="mt-4">
    {{ $jobs->links() }}
</div>

@endsection