@extends('layouts.admin')

@section('content')

<h1 class="text-4xl font-bold mb-8">

    Welcome Admin

</h1>

<div class="grid grid-cols-4 gap-6">

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-gray-500">Users</h2>
        <p class="text-4xl font-bold">0</p>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-gray-500">Departments</h2>
        <p class="text-4xl font-bold">0</p>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-gray-500">Jobs</h2>
        <p class="text-4xl font-bold">0</p>
    </div>

</div>

@endsection