@extends('layouts.manager')

@section('content')

<h2 class="text-3xl font-bold mb-6">
    Employees
</h2>

<form method="GET" class="flex gap-3 mb-6">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search employee..."
        class="border rounded-lg p-2 w-72">

    <select
        name="department"
        class="border rounded-lg p-2">

        <option value="">All Departments</option>

        @foreach($departments as $department)

            <option
                value="{{ $department->id }}"
                @selected(request('department') == $department->id)>

                {{ $department->department_name }}

            </option>

        @endforeach

    </select>

    <button
        class="bg-green-700 text-white px-5 rounded-lg">

        Search

    </button>

</form>

<div class="bg-white rounded-xl shadow overflow-hidden">

<table class="min-w-full">

    <thead class="bg-green-700 text-white">

        <tr>

            <th class="px-4 py-3 text-left">#</th>

            <th class="px-4 py-3 text-left">Name</th>

            <th class="px-4 py-3 text-left">Email</th>

            <th class="px-4 py-3 text-left">Department</th>

            <th class="px-4 py-3 text-left">Job</th>

            <th class="px-4 py-3 text-left">Status</th>

            <th class="px-4 py-3 text-left">Action</th>

        </tr>

    </thead>

    <tbody>

    @forelse($employees as $employee)

        <tr class="border-b hover:bg-gray-50">

            <td class="px-4 py-3">

                {{ $loop->iteration }}

            </td>

            <td class="px-4 py-3">

                {{ $employee->name }}

            </td>

            <td class="px-4 py-3">

                {{ $employee->email }}

            </td>

            <td class="px-4 py-3">

                {{ $employee->department?->department_name ?? '-' }}

            </td>

            <td class="px-4 py-3">

                {{ $employee->job?->job_title ?? '-' }}

            </td>

            <td class="px-4 py-3">

                @if($employee->status == 'active')

                    <span class="px-3 py-1 rounded bg-green-100 text-green-700">
                        Active
                    </span>

                @else

                    <span class="px-3 py-1 rounded bg-red-100 text-red-700">
                        Inactive
                    </span>

                @endif

            </td>

            <td class="px-4 py-3">

                <a
                    href="{{ route('manager.employees.show',$employee) }}"
                    class="text-blue-600 hover:underline">

                    View

                </a>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="7"
                class="text-center py-8">

                No employees found.

            </td>

        </tr>

    @endforelse

    </tbody>

</table>

</div>

<div class="mt-6">

    {{ $employees->links() }}

</div>

@endsection