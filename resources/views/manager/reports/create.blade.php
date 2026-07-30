@extends('layouts.manager')

@section('content')

<div class="max-w-3xl mx-auto bg-white shadow rounded-xl p-8">

    <h2 class="text-2xl font-bold mb-6">
        Generate Report
    </h2>

    <form action="{{ route('manager.reports.store') }}" method="POST">

        @csrf

        <div class="mb-5">

            <label class="block mb-2 font-semibold">
                Employee
            </label>

            <select
                name="employee_id"
                class="w-full border rounded-lg p-3"
                required>

                <option value="">Select Employee</option>

                @foreach($employees as $employee)

                    <option value="{{ $employee->id }}">

                        {{ $employee->name }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-5">

            <label class="block mb-2 font-semibold">
                Report Name
            </label>

            <input
                type="text"
                name="report_name"
                class="w-full border rounded-lg p-3"
                required>

        </div>

        <div class="mb-5">

            <label class="block mb-2 font-semibold">
                Report Type
            </label>

            <select
                name="report_type"
                class="w-full border rounded-lg p-3">

                <option value="attendance">Attendance</option>

                <option value="activity">Activity</option>

                <option value="task">Task</option>

                <option value="performance">Performance</option>

            </select>

        </div>

        <div class="mb-5">

            <label class="block mb-2 font-semibold">
                Description
            </label>

            <textarea
                name="description"
                rows="6"
                class="w-full border rounded-lg p-3"></textarea>

        </div>

        <button
            class="bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-lg">

            Generate Report

        </button>

    </form>

</div>

@endsection