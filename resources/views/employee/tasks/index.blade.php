@extends('layouts.employee')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <div class="flex justify-between items-center mb-6">

        <h2 class="text-2xl font-bold">
            My Tasks
        </h2>

    </div>

    <table class="w-full">

        <thead>

            <tr class="border-b">

                <th class="text-left p-3">Task</th>

                <th class="text-left p-3">Description</th>

                <th class="text-left p-3">Status</th>

                <th class="text-left p-3">Due Date</th>

                <th class="text-left p-3">Actions</th>

            </tr>

        </thead>

        <tbody>

        @forelse($tasks as $task)

            <tr class="border-b hover:bg-gray-50">

                <td class="p-3 font-semibold">

                    {{ $task->title }}

                </td>

                <td class="p-3">

                    {{ $task->description ?? 'No description' }}

                </td>

                <td class="p-3">

                    {{ ucwords(str_replace('_',' ',$task->status)) }}

                </td>

                <td class="p-3">

                    @if($task->due_date)

                        {{ $task->due_date->format('d M Y H:i') }}

                    @else

                        No deadline

                    @endif

                </td>

                <td class="p-3">

                    @if($task->status == 'pending')

                        <form action="{{ route('employee.tasks.start',$task) }}"
                              method="POST"
                              class="inline">

                            @csrf

                            <input type="hidden"
                                   name="status"
                                   value="in_progress">

                            <button
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded">

                                Start

                            </button>

                        </form>

                    @elseif($task->status == 'in_progress')

                        <a href="{{ route('employee.tasks.show',$task) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded">

                            Continue

                        </a>

                        <a href="{{ route('employee.tasks.submit',$task) }}"
                           class="bg-green-700 hover:bg-green-800 text-white px-3 py-2 rounded ml-2">

                            Submit

                        </a>

                    @elseif($task->status == 'submitted')

                        <span class="text-blue-600 font-semibold">

                            Awaiting Review

                        </span>

                    @elseif($task->status == 'completed')

                        <span class="text-green-700 font-semibold">

                            ✔ Completed

                        </span>

                    @endif

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="5"
                    class="text-center p-6 text-gray-500">

                    No tasks assigned yet.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection