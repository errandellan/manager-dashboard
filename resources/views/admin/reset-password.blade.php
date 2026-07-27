@extends('layouts.admin')

@section('content')

<div class="max-w-2xl mx-auto bg-white shadow rounded-lg p-8">

    <h2 class="text-3xl font-bold mb-6">
        Reset User Password
    </h2>

    <div class="mb-6">

        <p class="text-lg">
            <strong>Name:</strong>
            {{ $user->name }}
        </p>

        <p class="text-lg">
            <strong>Email:</strong>
            {{ $user->email }}
        </p>

    </div>

    <form method="POST"
          action="{{ route('admin.users.update-password', $user->id) }}">

        @csrf
        @method('PUT')

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                New Password
            </label>

            <input
                type="password"
                name="password"
                class="w-full border rounded-lg p-3"
                required>

        </div>

        <div class="mb-6">

            <label class="block font-semibold mb-2">
                Confirm Password
            </label>

            <input
                type="password"
                name="password_confirmation"
                class="w-full border rounded-lg p-3"
                required>

        </div>

        <div class="flex justify-end gap-3">

            <a href="{{ route('admin.users') }}"
               class="bg-gray-500 text-white px-6 py-2 rounded-lg">
                Cancel
            </a>

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                Reset Password
            </button>

        </div>

    </form>

</div>

@endsection