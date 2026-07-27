@extends('layouts.manager')

@section('content')

<div class="bg-white rounded-xl shadow p-8">

    <h2 class="text-2xl font-bold mb-6">

        Assign New Task

    </h2>

    <form action="{{ route('manager.tasks.update', $task) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-5">

            <label class="block font-semibold mb-2">

                Employee

            </label>

            <select
                name="assigned_to"
                class="w-full border rounded-lg p-3"
                required>

                <option value="">
                    Select Employee
                </option>

                @foreach($employees as $employee)

                    <option value="{{ $employee->id }}"
                    {{ $task->assigned_to == $employee->id ? 'selected' : '' }}>

                        {{ $employee->name }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">

                Task Title

            </label>

            <input
                type="text"
                name="title"
                value="{{ old('title',$task->title) }}"
                class="w-full border rounded-lg p-3"
                required>

        </div>

        <div class="mb-5">

            <label class="block font-semibold mb-2">

                Description

            </label>

           <textarea
            name="description"
            class="w-full border rounded-lg p-2">{{ old('description',$task->description) }}
            </textarea> 

        </div>

        <div class="grid grid-cols-2 gap-6">

            <div>

                <label class="block font-semibold mb-2">

                    Priority

                </label>

                <select name="priority" class="w-full border rounded-lg p-2">

                <option value="low"
                {{ $task->priority=='low'?'selected':'' }}>
                Low
                </option>

                <option value="medium"
                {{ $task->priority=='medium'?'selected':'' }}>
                Medium
                </option>

                <option value="high"
                {{ $task->priority=='high'?'selected':'' }}>
                High
                </option>

                </select>

            </div>
            <div>
                <label class="block font-semibold mb-2">

                    Status

                </label>

                <select name="status" class="w-full border rounded-lg p-2">

                <option value="pending"
                {{ $task->status=='pending'?'selected':'' }}>
                Pending
                </option>

                <option value="in_progress"
                {{ $task->status=='in_progress'?'selected':'' }}>
                In Progress
                </option>

                <option value="submitted"
                {{ $task->status=='submitted'?'selected':'' }}>
                Submitted
                </option>

                <option value="completed"
                {{ $task->status=='completed'?'selected':'' }}>
                Completed
                </option>

                </select>
            </div>

            <div>

                <label class="block font-semibold mb-2">

                    Due Date

                </label>

                <input
                    type="datetime-local"
                    name="due_date"
                    class="w-full border rounded-lg p-3">

            </div>

        </div>

        <button
            class="mt-6 bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-lg">

            Edit Task 

        </button>

       
 <a href="http://localhost:8000/manager/tasks" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-4 rounded-lg">

        Cancel

    </a>

    </form>

</div>

@endsection