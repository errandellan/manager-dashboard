@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8">

    <h2 class="text-3xl font-bold mb-8">
        Add Department
    </h2>

    <form method="POST" action="{{ route('admin.departments.store') }}">
        @csrf

        <div class="mb-5">
            <label class="block font-semibold mb-2">
                Department Name
            </label>

            <input
                type="text"
                name="department_name"
                class="w-full border rounded-lg px-4 py-2"
                required>
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-2">
                Description
            </label>

            <textarea
                name="description"
                rows="4"
                class="w-full border rounded-lg px-4 py-2"></textarea>
        </div>

        <div class="flex justify-end gap-3">

            <a href="{{ route('admin.departments') }}"
               class="bg-gray-500 text-white px-6 py-2 rounded-lg">
                Cancel
            </a>

            <button
                type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg">
                Save Department
            </button>

        </div>

    </form>

</div>

@endsection