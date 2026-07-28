@extends('layouts.manager')

@section('content')

<div class="bg-white shadow rounded-xl p-6">

    <h2 class="text-2xl font-bold mb-6">
        {{ $task->title }}
    </h2>

    <div class="space-y-3 mb-8">

        <p>
            <strong>Employee:</strong>
            {{ $task->employee->name }}
        </p>

        <p>
            <strong>Description:</strong>
            {{ $task->description }}
        </p>

        <p>
            <strong>Status:</strong>
            {{ ucfirst(str_replace('_',' ', $task->status)) }}
        </p>

        <p>
            <strong>Priority:</strong>
            {{ ucfirst($task->priority) }}
        </p>

    </div>

    <hr class="my-6">

    <h3 class="text-xl font-bold mb-5">
        Employee Updates
    </h3>

    @forelse($task->updates as $update)

        <div class="border rounded-lg p-4 mb-5">

            <p>
                <strong>Progress:</strong>
                {{ $update->progress }}%
            </p>

            <p class="mt-2">
                <strong>Comment:</strong>
                {{ $update->comment }}
            </p>

            @if($update->submission_link)

                <p class="mt-2">
                    <strong>Website:</strong>

                    <a href="{{ $update->submission_link }}"
                       target="_blank"
                       class="text-blue-600 underline">

                        Open Link

                    </a>

                </p>

            @endif

            @if($update->file_path)

                <p class="mt-2">
                    <strong>Document:</strong>

                    <a href="{{ asset('storage/'.$update->file_path) }}"
                       target="_blank"
                       class="text-green-600 underline">

                        Download File

                    </a>

                </p>

            @endif

        </div>

    @empty

        <p class="text-gray-500">
            No updates have been submitted yet.
        </p>

    @endforelse

</div>
@if($task->status == 'submitted')

<hr class="my-8">

<h3 class="text-2xl font-bold mb-4">
    Manager Review
</h3>

<form action="{{ route('manager.tasks.review', $task) }}" method="POST">

    @csrf

    <div class="mb-5">

        <label class="font-semibold">
            Feedback
        </label>

        <textarea
            name="feedback"
            rows="5"
            class="w-full border rounded-lg p-3"
            placeholder="Write your comments here..."></textarea>

    </div>

    <div class="flex gap-4">

        <button
            name="decision"
            value="approved"
            class="bg-green-700 text-white px-6 py-3 rounded-lg">

            ✅ Approve

        </button>

        <button
            name="decision"
            value="rejected"
            class="bg-red-700 text-white px-6 py-3 rounded-lg">

            ❌ Reject

        </button>

    </div>

</form>

@endif

@endsection