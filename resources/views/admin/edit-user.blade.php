@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8">

    <h2 class="text-3xl font-bold mb-8">
        Edit User
    </h2>

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-5">
            <label class="block font-semibold mb-2">Name</label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $user->name) }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        <!-- Email -->
        <div class="mb-5">
            <label class="block font-semibold mb-2">Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email', $user->email) }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        <!-- Phone -->
        <div class="mb-5">
            <label class="block font-semibold mb-2">Phone</label>
            <input type="text"
                   name="phone"
                   value="{{ old('phone', $user->phone) }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        <!-- Department -->
        <div class="mb-5">
            <label class="block font-semibold mb-2">Department</label>

            <select name="department_id"
                    class="w-full border rounded-lg px-4 py-2">

                @foreach($departments as $department)

                    <option value="{{ $department->id }}"
                        {{ $department->id == $user->department_id ? 'selected' : '' }}>
                        {{ $department->department_name }}
                    </option>

                @endforeach

            </select>
        </div>

        <!-- Job -->
        <div class="mb-5">
            <label class="block font-semibold mb-2">Job</label>

            <select name="job_id"
                    class="w-full border rounded-lg px-4 py-2">

                @foreach($jobs as $job)

                    <option value="{{ $job->id }}"
                        {{ $job->id == $user->job_id ? 'selected' : '' }}>
                        {{ $job->job_title }}
                    </option>

                @endforeach

            </select>
        </div>

        <!-- Role -->
        <div class="mb-5">
            <label class="block font-semibold mb-2">Role</label>

            <select name="role_id"
                    class="w-full border rounded-lg px-4 py-2">

                @foreach($roles as $role)

                    <option value="{{ $role->id }}"
                        {{ $role->id == $user->role_id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>

                @endforeach

            </select>
        </div>

        <!-- Status -->
        <div class="mb-8">
            <label class="block font-semibold mb-2">Status</label>

            <select name="status"
                    class="w-full border rounded-lg px-4 py-2">

                <option value="active"
                    {{ $user->status == 'active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="inactive"
                    {{ $user->status == 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>
        </div>

       <div class="flex justify-end gap-4">

    <a href="{{ route('admin.users') }}"
       class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg">

        Cancel

    </a>

    <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg">

        Save Changes

    </button>

</div>
    </form>

</div>

@endsection