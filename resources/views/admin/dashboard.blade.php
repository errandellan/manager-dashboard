@extends('layouts.admin')

@section('content')

<div class="mb-8">

    <h1 class="text-4xl font-bold text-gray-800">
        Admin Dashboard
    </h1>

    <p class="text-gray-600 mt-2">
        Welcome back,
        <span class="font-semibold">{{ auth()->user()->name }}</span>.
        Manage users, departments and system configuration.
    </p>

</div>


<!-- Statistics Cards -->

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    <!-- Users -->

    <div class="bg-white rounded-2xl shadow-lg border-t-4 border-blue-600 p-6 hover:shadow-xl hover:-translate-y-1 transition">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-gray-500 text-sm uppercase">
                    Users
                </p>

                <h2 class="text-5xl font-bold mt-2">
                    {{ $totalUsers }}
                </h2>

                <p class="text-gray-500 mt-2">
                    Registered Users
                </p>

            </div>

            <div class="text-5xl">
                👥
            </div>

        </div>

        <a href="{{ route('admin.users') }}"
           class="inline-block mt-5 text-blue-600 font-semibold hover:underline">
            Manage Users →
        </a>

    </div>



    <!-- Departments -->

    <div class="bg-white rounded-2xl shadow-lg border-t-4 border-green-600 p-6 hover:shadow-xl hover:-translate-y-1 transition">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-gray-500 text-sm uppercase">
                    Departments
                </p>

                <h2 class="text-5xl font-bold mt-2">
                    {{ $totalDepartments }}
                </h2>

                <p class="text-gray-500 mt-2">
                    Active Departments
                </p>

            </div>

            <div class="text-5xl">
                🏢
            </div>

        </div>

        <a href="{{ route('admin.departments') }}"
           class="inline-block mt-5 text-green-600 font-semibold hover:underline">
            Manage Departments 
        </a>

    </div>



    <!-- Jobs -->

    <div class="bg-white rounded-2xl shadow-lg border-t-4 border-orange-500 p-6 hover:shadow-xl hover:-translate-y-1 transition">

        <div class="flex justify-between items-center">

            <div>

                <p class="text-gray-500 text-sm uppercase">
                    Jobs
                </p>

                <h2 class="text-5xl font-bold mt-2">
                    {{ $totalJobs }}
                </h2>

                <p class="text-gray-500 mt-2">
                    Job Positions
                </p>

            </div>

            <div class="text-5xl">
                💼
            </div>

        </div>

        <a href="{{ route('admin.jobs') }}"
           class="inline-block mt-5 text-orange-600 font-semibold hover:underline">
            Manage Jobs →
        </a>

    </div>

</div>



<!-- Bottom Section -->

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Quick Actions -->

    <div class="bg-white rounded-2xl shadow-lg p-6">

        <h2 class="text-xl font-bold mb-5">
            Quick Actions
        </h2>

        <div class="grid grid-cols-2 gap-4">

            <a href="{{ route('admin.departments.create') }}"
               class="bg-blue-600 text-white text-center py-3 rounded-xl hover:bg-blue-700">
                ➕ Department
            </a>

            <a href="{{ route('admin.jobs') }}"
               class="bg-green-600 text-white text-center py-3 rounded-xl hover:bg-green-700">
                💼 Jobs
            </a>

            <a href="{{ route('admin.users') }}"
               class="bg-indigo-600 text-white text-center py-3 rounded-xl hover:bg-indigo-700">
                👥 Users
            </a>

            <a href="{{ route('admin.settings') }}"
               class="bg-gray-700 text-white text-center py-3 rounded-xl hover:bg-gray-800">
                ⚙ Settings
            </a>

        </div>

    </div>



    <!-- System Status -->

    <div class="bg-white rounded-2xl shadow-lg p-6">

        <h2 class="text-xl font-bold mb-5">
            System Status
        </h2>

        <div class="space-y-4">

            <div class="flex justify-between">

                <span>Database</span>

                <span class="text-green-600 font-semibold">
                    🟢 Connected
                </span>

            </div>

            <div class="flex justify-between">

                <span>Application</span>

                <span class="text-green-600 font-semibold">
                    🟢 Online
                </span>

            </div>

            <div class="flex justify-between">

                <span>Framework</span>

                <span>
                    Laravel 13
                </span>

            </div>

            <div class="flex justify-between">

                <span>PHP</span>

                <span>
                    {{ phpversion() }}
                </span>

            </div>

            <div class="flex justify-between">

                <span>Current Time</span>

                <span>
                    {{ now()->format('d M Y H:i') }}
                </span>

            </div>

        </div>

    </div>

</div>

@endsection