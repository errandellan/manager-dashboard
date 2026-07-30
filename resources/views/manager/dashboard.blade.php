@extends('layouts.manager')

@section('content')



<!-- Dashboard Header -->

<div class="bg-gradient-to-r from-slate-800 to-blue-700 rounded-xl shadow-lg p-8 text-white mb-6">

    <h1 class="text-3xl font-bold">
        Manager Dashboard
    </h1>

    <p class="mt-2 text-blue-100">
        Welcome to the management dashboard. Monitor attendance, supervise employee tasks,
        review reports, and oversee daily operations from one place.
    </p>

</div>





<!-- Statistics -->

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-500 hover:shadow-lg transition">

        <div class="flex justify-between items-center">

            <h2 class="text-gray-500 font-semibold">
                Total Attendance
            </h2>

            <span class="text-2xl">📅</span>

        </div>

        <p class="text-4xl font-bold mt-4 text-gray-800">
            {{ $attendance }}
        </p>

    </div>



    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-orange-500 hover:shadow-lg transition">

        <div class="flex justify-between items-center">

            <h2 class="text-gray-500 font-semibold">
                Pending Tasks
            </h2>

            <span class="text-2xl">📋</span>

        </div>

        <p class="text-4xl font-bold mt-4 text-gray-800">
            {{ $pendingTasks }}
        </p>

    </div>



    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500 hover:shadow-lg transition">

        <div class="flex justify-between items-center">

            <h2 class="text-gray-500 font-semibold">
                Total Reports
            </h2>

            <span class="text-2xl">📄</span>

        </div>

        <p class="text-4xl font-bold mt-4 text-gray-800">
            {{ $reports }}
        </p>

    </div>

</div>





<!-- Management Overview -->

<div class="bg-white rounded-xl shadow p-6 mb-6">

    <h2 class="text-xl font-bold text-gray-800 mb-5">
        Management Overview
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-blue-50 rounded-xl p-5">

            <h3 class="font-bold text-blue-700 text-lg">
                Attendance Monitoring
            </h3>

            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                Monitor employee attendance records and ensure staff maintain regular working hours.
            </p>

        </div>

        <div class="bg-green-50 rounded-xl p-5">

            <h3 class="font-bold text-green-700 text-lg">
                Task Supervision
            </h3>

            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                Assign responsibilities, monitor task progress, and ensure timely completion.
            </p>

        </div>

        <div class="bg-purple-50 rounded-xl p-5">

            <h3 class="font-bold text-purple-700 text-lg">
                Report Management
            </h3>

            <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                Review employee reports and monitor organizational performance trends.
            </p>

        </div>

    </div>

</div>





<!-- Manager Responsibilities -->

<div class="bg-white rounded-xl shadow p-6 mb-6">

    <h2 class="text-xl font-bold text-gray-800 mb-5">
        Manager Responsibilities
    </h2>

    <div class="space-y-5">

        <div class="flex items-center">

            <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
                1
            </div>

            <p class="ml-4 text-gray-600">
                Monitor employee attendance and maintain accurate records.
            </p>

        </div>

        <div class="flex items-center">

            <div class="w-10 h-10 rounded-full bg-green-600 text-white flex items-center justify-center font-bold">
                2
            </div>

            <p class="ml-4 text-gray-600">
                Review assigned tasks and ensure work is completed on time.
            </p>

        </div>

        <div class="flex items-center">

            <div class="w-10 h-10 rounded-full bg-purple-600 text-white flex items-center justify-center font-bold">
                3
            </div>

            <p class="ml-4 text-gray-600">
                Evaluate employee performance and provide constructive feedback.
            </p>

        </div>

        <div class="flex items-center">

            <div class="w-10 h-10 rounded-full bg-red-600 text-white flex items-center justify-center font-bold">
                4
            </div>

            <p class="ml-4 text-gray-600">
                Review reports and support informed managerial decision-making.
            </p>

        </div>

    </div>

</div>





<!-- Manager Notice -->

<div class="bg-slate-900 rounded-xl shadow-lg p-6 text-white">

    <h2 class="text-xl font-bold mb-3">
        Manager Notice Board
    </h2>

    <p class="text-slate-300 leading-relaxed">
        This dashboard provides a centralized view of employee attendance,
        task management, and organizational reports. Continue monitoring daily
        activities to ensure smooth departmental operations and improved
        employee performance.
    </p>

</div>

@endsection