@extends('layouts.employee')

@section('content')

<h2 class="text-2xl font-bold mb-6">
    {{ $task->title }}
</h2>

<div class="space-y-4 mb-8">

    <div>
        <strong>Description:</strong>
        <p>{{ $task->description ?? 'No description.' }}</p>
    </div>

    <div>
        <strong>Status:</strong>
        <p>{{ ucfirst(str_replace('_',' ',$task->status)) }}</p>
    </div>

    <div>
        <strong>Priority:</strong>
        <p>{{ ucfirst($task->priority) }}</p>
    </div>

    <div>
        <strong>Due Date:</strong>

        <p>
            @if($task->due_date)
                {{ $task->due_date->format('d M Y H:i') }}
            @else
                No deadline
            @endif
        </p>

    </div>

</div>


{{-- ===================== --}}
{{-- TASK NOT STARTED --}}
{{-- ===================== --}}

@if($task->status == 'pending')

<h3 class="text-xl font-bold mb-4">
    Task Not Started
</h3>

<p class="mb-4">
    Click the button below to begin this task.
</p>

<form action="{{ route('employee.tasks.start',$task) }}" method="POST">

    @csrf

    <button
        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg">

        ▶ Start Task

    </button>

</form>

@endif



{{-- ===================== --}}
{{-- TASK IN PROGRESS --}}
{{-- ===================== --}}

@if($task->status == 'in_progress')

<form
    method="POST"
    enctype="multipart/form-data">

    @csrf

    <h3 class="text-xl font-bold mb-6">
        Progress Update
    </h3>

    <div class="mb-5">

        <label class="font-semibold">
            Progress (%)
        </label>

        <input
            type="number"
            name="progress"
            min="0"
            max="100"
            value="0"
            class="w-full border rounded-lg p-3">

    </div>

    <div class="mb-5">

        <label class="font-semibold">
            Comment
        </label>

        <textarea
            name="comment"
            rows="4"
            class="w-full border rounded-lg p-3"></textarea>

    </div>

    <div class="mb-5">

        <label class="font-semibold">
            Submission Type
        </label>

        <select
            name="submission_type"
            class="w-full border rounded-lg p-3">

            <option value="file">
                Upload File
            </option>

            <option value="link">
                Website / GitHub Link
            </option>

        </select>

    </div>

    <div class="mb-5">

        <label class="font-semibold">
            Upload File
        </label>

        <input
            type="file"
            name="file"
            class="w-full">

    </div>

    <div class="mb-5">

        <label class="font-semibold">
            Project Link
        </label>

        <input
            type="url"
            name="submission_link"
            class="w-full border rounded-lg p-3"
            placeholder="https://github.com/username/project">

    </div>

    <div class="flex gap-4">

        <button
            type="submit"
            formaction="{{ route('employee.tasks.progress',$task) }}"
            class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-lg">

            Save Progress

        </button>

        <button
            type="submit"
            formaction="{{ route('employee.tasks.submit',$task) }}"
            class="bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-lg">

            Submit For Review

        </button>

    </div>

</form>

@endif



{{-- ===================== --}}
{{-- WAITING FOR REVIEW --}}
{{-- ===================== --}}

@if($task->status == 'submitted')

<div class="bg-yellow-100 border border-yellow-400 rounded-lg p-5 mt-6">

    <h3 class="text-xl font-bold text-yellow-800">

        ⏳ Waiting for Manager Review

    </h3>

    <p class="mt-2">

        Your work has been submitted successfully.
        Please wait while your manager reviews it.

    </p>

</div>

@endif



{{-- ===================== --}}
{{-- APPROVED --}}
{{-- ===================== --}}

@if($task->status == 'completed')

<div class="bg-green-100 border border-green-400 rounded-lg p-5 mt-6">

    <h3 class="text-xl font-bold text-green-700">

        ✅ Task Approved

    </h3>

    <p class="mt-2">

        Congratulations!
        Your manager has approved your submission.

    </p>

</div>

@endif



{{-- ===================== --}}
{{-- MANAGER FEEDBACK --}}
{{-- ===================== --}}

@if($task->updates->count())

    @php
        $latest = $task->updates->last();
    @endphp

    @if($latest->manager_feedback)

        <div class="bg-gray-100 border rounded-lg p-5 mt-8">

            <h3 class="text-xl font-bold mb-3">

                Manager Feedback

            </h3>

            <p>

                {{ $latest->manager_feedback }}

            </p>

        </div>

    @endif

@endif

@endsection