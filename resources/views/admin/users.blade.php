@extends('layouts.admin')

@section('content')

<div class="mb-8 flex justify-between items-center">

    <div>
        <h1 class="text-4xl font-bold text-gray-800">
            User Management
        </h1>

        <p class="text-gray-600 mt-2">
            View, edit and manage all registered users.
        </p>
    </div>

    <div class="bg-blue-600 text-white px-5 py-3 rounded-xl shadow">
        Total Users:
        <span class="font-bold">{{ $users->count() }}</span>
    </div>

</div>

@if(session('success'))

<div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
    {{ session('success') }}
</div>

@endif

@if(session('error'))

<div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
    {{ session('error') }}
</div>

@endif


<div class="bg-white rounded-2xl shadow-lg overflow-hidden">

    <table class="min-w-full">

        <thead class="bg-gray-100 text-gray-700 uppercase text-sm">

            <tr>

                <th class="px-6 py-4 text-left">Name</th>

                <th class="px-6 py-4 text-left">Email</th>

                <th class="px-6 py-4 text-left">Department</th>

                <th class="px-6 py-4 text-left">Job</th>

                <th class="px-6 py-4 text-left">Role</th>

                <th class="px-6 py-4 text-center">Status</th>

                <th class="px-6 py-4 text-center">Actions</th>

            </tr>

        </thead>

        <tbody>

        @forelse($users as $user)

            <tr class="border-b hover:bg-gray-50 transition">

                <td class="px-6 py-4 font-semibold">
                    {{ $user->name }}
                </td>

                <td class="px-6 py-4 text-gray-600">
                    {{ $user->email }}
                </td>

                <td class="px-6 py-4">
                    {{ $user->department->department_name }}
                </td>

                <td class="px-6 py-4">
                    {{ $user->job->job_title }}
                </td>

                <td class="px-6 py-4">

                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm">

                        {{ $user->role->name }}

                    </span>

                </td>

                <td class="px-6 py-4 text-center">

                    @if($user->status == 'active')

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                            Active
                        </span>

                    @else

                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">
                            Inactive
                        </span>

                    @endif

                </td>

                <td class="px-6 py-4">

                    <div class="flex justify-center gap-2 flex-wrap">

                        <a href="{{ route('admin.users.edit', $user->id) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                            ✏ Edit
                        </a>

                        <a href="{{ route('admin.users.reset-password', $user->id) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm">
                            🔑 Reset
                        </a>

                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Delete {{ $user->name }}?')"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm">

                                🗑 Delete

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="7" class="text-center py-8 text-gray-500">

                    No users found.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection