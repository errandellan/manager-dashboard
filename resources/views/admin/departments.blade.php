@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h2 class="text-3xl font-bold">
        Departments
    </h2>

    <a href="{{ route('admin.departments.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

        + Add Department

    </a>

</div>

<table class="min-w-full bg-white rounded-lg shadow">

    <thead class="bg-gray-100">

        <tr>

            <th class="p-4 text-left">Department</th>

            <th class="p-4 text-left">Description</th>

            <th class="p-4 text-center">Actions</th>

        </tr>

    </thead>

    <tbody>

    @forelse($departments as $department)

        <tr class="border-b">

            <td class="p-4">

                {{ $department->department_name }}

            </td>

            <td class="p-4">

                {{ $department->description }}

            </td>

            <td class="p-4 text-center">

                <a href="{{ route('admin.departments.edit',$department->id) }}"
                   class="bg-blue-500 text-white px-3 py-1 rounded">

                    Edit

                </a>

                <form
                    action="{{ route('admin.departments.destroy',$department->id) }}"
                    method="POST"
                    class="inline">

                    @csrf
                    @method('DELETE')

                    <button
                        onclick="return confirm('Delete this department?')"
                        class="bg-red-500 text-white px-3 py-1 rounded">

                        Delete

                    </button>

                </form>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="3"
                class="text-center py-8">

                No departments found.

            </td>

        </tr>

    @endforelse

    </tbody>

</table>

@endsection