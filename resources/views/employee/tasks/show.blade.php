@extends('layouts.employee')

@section('content')

<div class="bg-white rounded-xl shadow p-8">

    <h2 class="text-2xl font-bold mb-6">

        {{ $task->title }}

    </h2>

    <div class="space-y-4">

        <div>

            <strong>Description</strong>

            <p>

                {{ $task->description ?? 'No description.' }}

            </p>

        </div>

        <div>

            <strong>Status</strong>

            <p>

                {{ ucfirst(str_replace('_',' ',$task->status)) }}

            </p>

        </div>

        <div>

            <strong>Priority</strong>

            <p>

                {{ ucfirst($task->priority) }}

            </p>

        </div>

        <div>

            <strong>Due Date</strong>

            <p>

                @if($task->due_date)

                    {{ $task->due_date->format('d M Y H:i') }}

                @else

                    No deadline

                @endif

            </p>

        </div>

    </div>

</div>
<div class="mt-10 bg-gray-50 rounded-xl p-6">

    <h3 class="text-xl font-bold mb-6">

        Update Progress

    </h3>

    <form
        action="{{ route('employee.tasks.progress',$task) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

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

                    Submit Link

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
                placeholder="https://github.com/...">

        </div>

        <button
            class="bg-blue-700 text-white px-6 py-3 rounded-lg">

            Save Progress

        </button>

    </form>

    <form
        action="{{ route('employee.tasks.submit',$task) }}"
        method="POST"
        class="mt-4">

        @csrf

        <button
            class="bg-green-700 text-white px-6 py-3 rounded-lg">

            Submit For Review

        </button>

    </form>

</div>

@endsection