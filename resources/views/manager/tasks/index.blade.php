@extends('layouts.manager')

@section('content')

<div class="space-y-6">

    <!-- Header -->
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-3xl font-bold">
                Task Management
            </h1>

            <p class="text-gray-500">
                Create and monitor employee tasks.
            </p>

        </div>

     

    </div>

    <!-- Statistics -->

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="bg-white shadow rounded-xl p-6">

            <p class="text-gray-500">Total Tasks</p>

            <h2 class="text-3xl font-bold">
                {{ $totalTasks }}
            </h2>

        </div>

        <div class="bg-white shadow rounded-xl p-6">

            <p class="text-gray-500">Pending</p>

            <h2 class="text-3xl font-bold text-yellow-500">
                {{ $pendingTasks }}
            </h2>

        </div>

        <div class="bg-white shadow rounded-xl p-6">

            <p class="text-gray-500">In Progress</p>

            <h2 class="text-3xl font-bold text-blue-600">
                {{ $inProgressTasks }}
            </h2>

        </div>

        <div class="bg-white shadow rounded-xl p-6">

            <p class="text-gray-500">Completed</p>

            <h2 class="text-3xl font-bold text-green-600">
                {{ $completedTasks }}
            </h2>

        </div>

    </div>

    <!-- Table -->

    <div class="flex justify-between items-center mb-6">

    <h2 class="text-2xl font-bold">

        Task Management

    </h2>

    <a href="{{ route('manager.tasks.create') }}"
       class="bg-green-700 text-white px-5 py-3 rounded-lg hover:bg-green-800">

        + Assign Task

    </a>

</div>

    <div class="bg-white shadow rounded-xl overflow-hidden">

        <table class="min-w-full">

            <thead class="bg-green-700 text-white">

                <tr>

                    <th class="px-4 py-3 text-left">#</th>

                    <th class="px-4 py-3 text-left">Employee</th>

                    <th class="px-4 py-3 text-left">Task</th>

                    <th class="px-4 py-3 text-left">priority</th>

                    <th class="px-4 py-3 text-left">Status</th>

                    <th class="px-4 py-3 text-left">Due Date</th>

                    <th class="px-4 py-3 text-left">Actions</th>

                </tr>

            </thead>

            <tbody>

            @forelse($tasks as $task)

                <tr class="border-b hover:bg-gray-50">

                    <td class="px-4 py-3">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-4 py-3 font-semibold">
                        {{ $task->employee?->name ?? 'Unknown Employee' }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $task->title }}
                    </td>

                    <td class="px-4 py-3">

                        @if($task->priority == 'high')
                            <span class="px-2 py-1 rounded bg-red-100 text-red-700">High</span>

                        @elseif($task->priority == 'medium')
                            <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-700">Medium</span>

                        @else
                            <span class="px-2 py-1 rounded bg-green-100 text-green-700">Low</span>
                        @endif 
                        

                    </td>

                <td class="px-4 py-3">

                @if($task->status == 'pending')
                    <span class="px-3 py-1 rounded bg-yellow-100 text-yellow-700">
                        Pending
                    </span>

                @elseif($task->status == 'in_progress')
                    <span class="px-3 py-1 rounded bg-blue-100 text-blue-700">
                        In Progress
                    </span>

                @elseif($task->status == 'submitted')
                    <span class="px-3 py-1 rounded bg-purple-100 text-purple-700 font-semibold">
                        Submitted
                    </span>

                @elseif($task->status == 'completed')
                    <span class="px-3 py-1 rounded bg-green-100 text-green-700">
                        Completed
                    </span>

                @endif

            </td>

                    <td class="px-4 py-3">

                        {{ $task->due_date?->format('d M Y') }}

                    </td>

            
            <td class="px-4 py-3 flex gap-3">

        <a href="{{ route('manager.tasks.show',$task) }}"
       class="text-indigo-600 hover:underline">

        View

        </a>

    <a href="{{ route('manager.tasks.edit',$task) }}"
       class="text-blue-600 hover:underline">

        Edit

    </a>

    <form action="{{ route('manager.tasks.destroy',$task) }}"
          method="POST">

        @csrf
        @method('DELETE')

        <button class="text-red-600 hover:underline">
            Delete
        </button>

    </form>

</td>

        <form action="{{ route('manager.tasks.destroy',$task) }}"
              method="POST"
              onsubmit="return confirm('Delete this task?')">

            @csrf
            @method('DELETE')

            

        </form>

    </div>

</td>

                </tr>

            @empty

                <tr>

                    <td colspan="7"
                        class="text-center py-10 text-gray-500">

                        No tasks have been assigned yet.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div>

        {{ $tasks->links() }}

    </div>

</div>

@endsection