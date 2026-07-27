@extends('layouts.manager')

@section('content')

<div class="space-y-6">

    <!-- Page Title -->
    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            Employee Attendance
        </h1>
        <p class="text-gray-500">
            Monitor employee login, logout and attendance records.
        </p>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500">Today's Records</p>
            <h2 class="text-3xl font-bold">
                {{ $todayRecords }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500">Active Employees</p>
            <h2 class="text-3xl font-bold text-green-600">
                {{ $activeEmployees }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500">Logged Out</p>
            <h2 class="text-3xl font-bold text-red-600">
                {{ $inactiveEmployees }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-500">Employees</p>
            <h2 class="text-3xl font-bold">
                {{ $totalEmployees }}
            </h2>
        </div>

    </div>

    <!-- Filters -->
    <form method="GET"
          action="{{ route('manager.attendance') }}"
          class="bg-white rounded-xl shadow p-6">

        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

            <select
                name="filter"
                class="border rounded-lg p-2">

                <option value="">All Dates</option>

                <option value="today"
                    {{ request('filter')=='today' ? 'selected' : '' }}>
                    Today
                </option>

                <option value="week"
                    {{ request('filter')=='week' ? 'selected' : '' }}>
                    This Week
                </option>

                <option value="month"
                    {{ request('filter')=='month' ? 'selected' : '' }}>
                    This Month
                </option>

            </select>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search employee..."
                class="border rounded-lg p-2">

            <select
                name="department"
                class="border rounded-lg p-2">

                <option value="">All Departments</option>

                @foreach($departments as $department)

                    <option value="{{ $department->id }}"
                        {{ request('department')==$department->id ? 'selected' : '' }}>

                        {{ $department->department_name }}

                    </option>

                @endforeach

            </select>

            <select
                name="status"
                class="border rounded-lg p-2">

                <option value="">All Status</option>

                <option value="active"
                    {{ request('status')=='active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="inactive"
                    {{ request('status')=='inactive' ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>

            <button
                type="submit"
                class="bg-green-700 hover:bg-green-800 text-white rounded-lg">

                Filter

            </button>

        </div>

    </form>

    <!-- Attendance Table -->
    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="min-w-full">

            <thead class="bg-green-700 text-white">

                <tr>

                    <th class="px-4 py-3 text-left">#</th>

                    <th class="px-4 py-3 text-left">
                        Employee
                    </th>

                    <th class="px-4 py-3 text-left">
                        Login Time
                    </th>

                    <th class="px-4 py-3 text-left">
                        Logout Time
                    </th>

                    <th class="px-4 py-3 text-left">
                        Duration
                    </th>

                    <th class="px-4 py-3 text-left">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($attendanceLogs as $attendance)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="px-4 py-3">
                            {{ $attendanceLogs->firstItem() + $loop->index }}
                        </td>

                        <td class="px-4 py-3 font-medium">

                            {{ $attendance->user?->name ?? 'Unknown User' }}

                        </td>

                        <td class="px-4 py-3">

                            {{ $attendance->login_time->format('d M Y') }}

                            <br>

                            <span class="text-sm text-gray-500">

                                {{ $attendance->login_time->format('h:i A') }}

                            </span>

                        </td>

                        <td class="px-4 py-3">

                            @if($attendance->logout_time)

                                {{ $attendance->logout_time->format('h:i A') }}

                            @else

                                <span class="text-green-600 font-semibold">

                                    Still Active

                                </span>

                            @endif

                        </td>

                        <td class="px-4 py-3">

                            {{ $attendance->session_duration ?? 0 }}

                            minutes

                        </td>

                        <td class="px-4 py-3">

                            @if($attendance->status=='active')

                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">

                                    🟢 Active

                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-semibold">

                                    🔴 Inactive

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="text-center py-10 text-gray-500">

                            No attendance records found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- Pagination -->

    <div>

        {{ $attendanceLogs->withQueryString()->links() }}

    </div>

</div>

@endsection