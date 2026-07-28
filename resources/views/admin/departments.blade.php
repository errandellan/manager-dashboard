@extends('layouts.admin')

@section('content')

<div class="mb-8 flex justify-between items-center">

    <div>

        <h1 class="text-4xl font-bold text-gray-800">
            Department Management
        </h1>

        <p class="text-gray-600 mt-2">
            Create, update and manage all departments.
        </p>

    </div>

    <div class="flex items-center gap-4">

        <div class="bg-green-600 text-white px-5 py-3 rounded-xl shadow">
            Total Departments:
            <span class="font-bold">{{ $departments->count() }}</span>
        </div>

        <a href="{{ route('admin.departments.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow">
            ➕ Add Department
        </a>

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

                <th class="px-6 py-4 text-left">
                    Department
                </th>

                <th class="px-6 py-4 text-left">
                    Description
                </th>

                <th class="px-6 py-4 text-center">
                    Actions
                </th>

            </tr>

        </thead>

        <tbody>

        @forelse($departments as $department)

            <tr class="border-b hover:bg-gray-50 transition">

                <td class="px-6 py-4 font-semibold">
                    {{ $department->department_name }}
                </td>

                <td class="px-6 py-4 text-gray-600">
                    {{ $department->description ?: 'No description available.' }}
                </td>

                <td class="px-6 py-4">

                    <div class="flex justify-center gap-2">

                        <a href="{{ route('admin.departments.edit', $department->id) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                            ✏ Edit
                        </a>

                        <form action="{{ route('admin.departments.destroy', $department->id) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Delete {{ $department->department_name }}?')"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm">

                                🗑 Delete

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="3" class="text-center py-8 text-gray-500">

                    No departments found.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection