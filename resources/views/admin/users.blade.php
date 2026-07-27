@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    User Management
</h1>

<div class="bg-white shadow rounded-lg p-6">

    <table class="min-w-full">

        <thead class="bg-gray-100">

        <tr>

            <th class="p-3 text-left">Name</th>

            <th class="p-3 text-left">Email</th>

            <th class="p-3 text-left">Department</th>

            <th class="p-3 text-left">Job</th>

            <th class="p-3 text-left">Role</th>

            <th class="p-3 text-left">Status</th>

            <th class="p-3 text-center">Actions</th>

        </tr>

        </thead>

        <tbody>

        @foreach($users as $user)

        <tr class="border-b">

            <td class="p-3">
                {{ $user->name }}
            </td>

            <td class="p-3">
                {{ $user->email }}
            </td>

            <td class="p-3">
                {{ $user->department->department_name }}
            </td>

            <td class="p-3">
                {{ $user->job->job_title }}
            </td>

            <td class="p-3">
                {{ $user->role->name }}
            </td>

            <td class="p-3">
                {{ ucfirst($user->status) }}
            </td>

            <td class="p-3 text-center">

              
                <a href="{{ route('admin.users.edit',$user->id) }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                        ✏ Edit
                </a>

                 <a href="{{ route('admin.users.reset-password',$user->id) }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                       🔑 Reset Password
                </a>

                

                <form action="{{ route('admin.users.destroy', $user->id) }}"
                method="POST"
                style="display:inline;">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    onclick="return confirm('Are you sure you want to delete this user?')"
                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">

                    🗑 Delete

                </button>

            </form>

            </td>

        </tr>

        @endforeach

        </tbody>

    </table>

</div>

@endsection