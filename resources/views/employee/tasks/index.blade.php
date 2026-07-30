@extends('layouts.employee')

@section('content')

<div class="space-y-6">

    <!-- Page Header -->

    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl shadow-lg p-6 text-white">

        <h1 class="text-3xl font-bold">
            My Tasks
        </h1>

        

    </div>





    <!-- Information Card -->

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-xl font-bold text-gray-800 mb-3">
            Task Information
        </h2>

        <p class="text-gray-600 leading-relaxed">

            This page displays all tasks assigned to you by your manager.
            Use the available actions to start, continue, or submit your work.
            Complete tasks before their due dates to maintain a strong performance record.

        </p>

    </div>





    <!-- Tasks Table -->

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="p-6 border-b">

            <h2 class="text-xl font-bold text-gray-800">
                Assigned Tasks
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Review and manage your assigned work below.
            </p>

        </div>





        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50 border-b">

                    <tr>

                        <th class="text-left p-4 font-semibold text-gray-600">
                            Task
                        </th>

                        <th class="text-left p-4 font-semibold text-gray-600">
                            Description
                        </th>

                        <th class="text-left p-4 font-semibold text-gray-600">
                            Status
                        </th>

                        <th class="text-left p-4 font-semibold text-gray-600">
                            Due Date
                        </th>

                        <th class="text-center p-4 font-semibold text-gray-600">
                            Actions
                        </th>

                    </tr>

                </thead>





                <tbody>

                @forelse($tasks as $task)

                    <tr class="border-b hover:bg-gray-50 transition">

                        <td class="p-4 font-semibold text-gray-800">

                            {{ $task->title }}

                        </td>

                        <td class="p-4 text-gray-600">

                            {{ $task->description ?? 'No description provided.' }}

                        </td>





                        <td class="p-4">

                            @if($task->status == 'pending')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    Pending
                                </span>

                            @elseif($task->status == 'in_progress')

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    In Progress
                                </span>

                            @elseif($task->status == 'submitted')

                                <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    Submitted
                                </span>

                            @elseif($task->status == 'completed')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    Completed
                                </span>

                            @endif

                        </td>





                        <td class="p-4 text-gray-600">

                            @if($task->due_date)

                                {{ $task->due_date->format('d M Y H:i') }}

                            @else

                                <span class="text-gray-400">
                                    No deadline
                                </span>

                            @endif

                        </td>





                        <td class="p-4 text-center whitespace-nowrap">

                            @if($task->status == 'pending')

                                <form action="{{ route('employee.tasks.start',$task) }}"
                                      method="POST"
                                      class="inline">

                                    @csrf

                                    <input type="hidden"
                                           name="status"
                                           value="in_progress">

                                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition">

                                        Start

                                    </button>

                                </form>

                            @elseif($task->status == 'in_progress')

                                <a href="{{ route('employee.tasks.show',$task) }}"
                                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">

                                    Continue

                                </a>

                                <a href="{{ route('employee.tasks.submit',$task) }}"
                                   class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition ml-2">

                                    Submit

                                </a>

                            @elseif($task->status == 'submitted')

                                <span class="font-semibold text-blue-600">

                                    Awaiting Review

                                </span>

                            @elseif($task->status == 'completed')

                                <span class="font-semibold text-green-600">

                                    ✔ Completed

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="p-10 text-center">

                            <div class="text-gray-400">

                                <h3 class="text-lg font-semibold">

                                    No Tasks Assigned

                                </h3>

                                <p class="mt-2 text-sm">

                                    Tasks assigned by your manager will appear here.

                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>





    <!-- Employee Tips -->

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-xl font-bold text-gray-800 mb-5">
            Task Guidelines
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-blue-50 rounded-xl p-5">

                <h3 class="font-bold text-blue-700">
                    Start Promptly
                </h3>

                <p class="mt-2 text-sm text-gray-600">
                    Begin your assigned tasks as soon as possible to avoid delays.
                </p>

            </div>

            <div class="bg-green-50 rounded-xl p-5">

                <h3 class="font-bold text-green-700">
                    Track Progress
                </h3>

                <p class="mt-2 text-sm text-gray-600">
                    Update your task status regularly to keep your manager informed.
                </p>

            </div>

            <div class="bg-purple-50 rounded-xl p-5">

                <h3 class="font-bold text-purple-700">
                    Submit On Time
                </h3>

                <p class="mt-2 text-sm text-gray-600">
                    Complete and submit your work before the specified deadline.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection