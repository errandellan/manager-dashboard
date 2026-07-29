@extends('layouts.manager')

@section('content')

<h1 class="text-4xl font-bold mb-8">
    Welcome Manager
</h1>

<div class="grid grid-cols-4 gap-6">

    

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-gray-500">Total attendance</h2>
        <p class="text-4xl font-bold">{{ $attendance }}</p>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-gray-500">Pending Tasks</h2>
        <p class="text-4xl font-bold">{{ $pendingTasks }}</p>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-gray-500">Total Reports</h2>
        <p class="text-4xl font-bold">{{ $reports }}</p>
    </div>

</div>

@endsection