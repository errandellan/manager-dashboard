@extends('layouts.employee')

@section('content')


<div class="grid grid-cols-1 md:grid-cols-4 gap-6">


    <!-- Attendance -->

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-gray-500">
            My Attendance
        </h2>


        <p class="text-4xl font-bold">

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

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-gray-500">
            Assigned Tasks
        </h2>


        <p class="text-4xl font-bold">

            {{ $totalTasks ?? 0 }}

        </p>


        <p class="text-sm text-gray-400 mt-2">

            Tasks assigned to me

        </p>


    </div>





    <!-- Completed Tasks -->

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-gray-500">
            Completed Tasks
        </h2>


        <p class="text-4xl font-bold">

            {{ $completedTasks ?? 0 }}

        </p>


        <p class="text-sm text-gray-400 mt-2">

            Completed successfully

        </p>


    </div>





    <!-- Performance -->

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-gray-500">
            Performance Score
        </h2>


        <p class="text-4xl font-bold">

            {{ $performance->overall_score ?? 0 }}%

        </p>


        <p class="text-sm text-gray-400 mt-2">

            Evaluation score

        </p>


    </div>


</div>



@endsection