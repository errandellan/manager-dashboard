@extends('layouts.employee')

@section('content')

<div class="space-y-6">


    <!-- Dashboard Header -->

    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl shadow p-6 text-white">

        <h1 class="text-3xl font-bold">
            Employee Dashboard
        </h1>

        <p class="mt-2 text-blue-100">
            Monitor your attendance, tasks, and performance progress from one place.
        </p>

    </div>





    <!-- Dashboard Statistics -->

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">


        <!-- Attendance -->

        <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-500 hover:shadow-lg transition">


            <div class="flex justify-between items-center">

                <h2 class="text-gray-500 font-semibold">
                    My Attendance
                </h2>

                <span class="text-2xl">
                    📅
                </span>

            </div>



            <p class="text-4xl font-bold text-gray-800 mt-4">

                @if($attendance)

                    Present

                @else

                    0

                @endif

            </p>



            <p class="text-sm text-gray-400 mt-2">

                Today's attendance

            </p>


        </div>






        <!-- Assigned Tasks -->

        <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500 hover:shadow-lg transition">


            <div class="flex justify-between items-center">

                <h2 class="text-gray-500 font-semibold">
                    Assigned Tasks
                </h2>


                <span class="text-2xl">
                    📋
                </span>

            </div>



            <p class="text-4xl font-bold text-gray-800 mt-4">

                {{ $totalTasks ?? 0 }}

            </p>



            <p class="text-sm text-gray-400 mt-2">

                Tasks assigned to me

            </p>


        </div>






        <!-- Completed Tasks -->

        <div class="bg-white rounded-xl shadow p-6 border-l-4 border-purple-500 hover:shadow-lg transition">


            <div class="flex justify-between items-center">

                <h2 class="text-gray-500 font-semibold">
                    Completed Tasks
                </h2>


                <span class="text-2xl">
                    ✅
                </span>


            </div>



            <p class="text-4xl font-bold text-gray-800 mt-4">

                {{ $completedTasks ?? 0 }}

            </p>



            <p class="text-sm text-gray-400 mt-2">

                Completed successfully

            </p>


        </div>






        <!-- Performance -->

        <div class="bg-white rounded-xl shadow p-6 border-l-4 border-yellow-500 hover:shadow-lg transition">


            <div class="flex justify-between items-center">

                <h2 class="text-gray-500 font-semibold">
                    Performance Score
                </h2>


                <span class="text-2xl">
                    ⭐
                </span>


            </div>



            <p class="text-4xl font-bold text-gray-800 mt-4">

                {{ $performance->overall_score ?? 0 }}%

            </p>



            <p class="text-sm text-gray-400 mt-2">

                Evaluation score

            </p>


        </div>


    </div>








    <!-- Employee Information -->


    <div class="bg-white rounded-xl shadow p-6">


        <h2 class="text-xl font-bold text-gray-800 mb-5">
            Employee Information
        </h2>



        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">


            <div class="bg-blue-50 rounded-xl p-5 hover:shadow transition">


                <h3 class="font-bold text-blue-700 text-lg">
                    Work Schedule
                </h3>


                <p class="text-gray-600 mt-3 text-sm leading-relaxed">

                    Maintain your daily attendance and complete assigned tasks within the expected time.

                </p>


            </div>





            <div class="bg-green-50 rounded-xl p-5 hover:shadow transition">


                <h3 class="font-bold text-green-700 text-lg">
                    Task Management
                </h3>


                <p class="text-gray-600 mt-3 text-sm leading-relaxed">

                    Monitor assigned tasks, track progress, and ensure timely completion.

                </p>


            </div>






            <div class="bg-purple-50 rounded-xl p-5 hover:shadow transition">


                <h3 class="font-bold text-purple-700 text-lg">
                    Performance Growth
                </h3>


                <p class="text-gray-600 mt-3 text-sm leading-relaxed">

                    Improve productivity through consistency, attendance, and quality work.

                </p>


            </div>


        </div>


    </div>







    <!-- Dashboard Guide -->


    <div class="bg-white rounded-xl shadow p-6">


        <h2 class="text-xl font-bold text-gray-800 mb-5">

            Dashboard Guide

        </h2>



        <div class="space-y-5">


            <div class="flex items-center">

                <div class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold">

                    1

                </div>


                <p class="ml-4 text-gray-600">

                    Check your attendance status after logging into the system.

                </p>


            </div>





            <div class="flex items-center">

                <div class="bg-green-600 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold">

                    2

                </div>


                <p class="ml-4 text-gray-600">

                    Complete assigned tasks and update your progress regularly.

                </p>


            </div>






            <div class="flex items-center">

                <div class="bg-purple-600 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold">

                    3

                </div>


                <p class="ml-4 text-gray-600">

                    Review your performance evaluation and improve your productivity.

                </p>


            </div>



        </div>


    </div>







    <!-- Notice Board -->


    <div class="bg-gray-900 rounded-xl shadow p-6 text-white">


        <h2 class="text-xl font-bold mb-3">

            Employee Notice Board

        </h2>



        <p class="text-gray-300 leading-relaxed">

            Welcome to the employee dashboard. Use this platform to manage your
            attendance records, monitor assigned tasks, and track workplace progress.

        </p>


    </div>



</div>


@endsection