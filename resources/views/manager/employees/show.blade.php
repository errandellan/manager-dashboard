@extends('layouts.manager')

@section('content')

<div class="bg-white shadow rounded-xl p-8 max-w-3xl">

    <h2 class="text-2xl font-bold mb-6">
        Employee Details
    </h2>

  <div class="grid grid-cols-2 gap-y-5">

        <div>
            <strong>Name</strong>
        </div>

        <div>
            {{ $user->name }}
        </div>

        <div>
            <strong>Email</strong>
        </div>

        <div>
            {{ $user->email }}
        </div>

        <div>
            <strong>Department</strong>
        </div>

        <div>
            {{ $user->department?->department_name ?? 'N/A' }}
        </div>

        <div>
            <strong>Job</strong>
        </div>

        <div>
            {{ $user->job?->job_title ?? 'N/A' }}
        </div>

        <div>
            <strong>Status</strong>
        </div>

        <div>
            @if($user->status == 'active')
                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">
                    Active
                </span>
            @else
                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700">
                    {{ ucfirst($user->status) }}
                </span>
            @endif
        </div>

    </div>

    <div class="mt-8">
        <a href="{{ route('manager.employees.index') }}"
           class="bg-gray-700 hover:bg-gray-800 text-white px-5 py-2 rounded-lg">
            ← Back
        </a>
    </div>

</div>

@endsection

