@extends('layouts.employee')


@section('content')
<div class="bg-white rounded-xl shadow p-6">

<h2 class="text-2xl font-bold mb-6">

    My Tasks

</h2>
<table class="w-full">

<thead>
<tr class="border-b">

<th class="text-left p-3">
Task
</th>

<th class="text-left p-3">
Description
</th>

<th class="text-left p-3">
Status
</th>

<th class="text-left p-3">
Due Date
</th>
</tr>
</thead>
<tbody>
@forelse($tasks as $task)
<tr class="border-b">

<td class="p-3 font-semibold">
    
<a href="{{ route('employee.tasks.show', $task) }}"
   class="text-blue-600 hover:underline font-semibold">

    {{ $task->title }}

</a>
</td>
<td class="p-3">
{{ $task->description ?? 'No description' }}
</td>
<td class="p-3">

{{ ucfirst(str_replace('_',' ',$task->status)) }}

</td>
<td class="p-3">
@if($task->due_date)
{{ $task->due_date->format('d M Y H:i') }}
@else
No deadline
@endif
</td>
</tr>
@empty
<tr>
<td colspan="4"
class="p-5 text-center text-gray-500">

No tasks assigned yet.
</td>
</tr>

@endforelse

</tbody>
</table>
</div>

@endsection