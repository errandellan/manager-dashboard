@extends('layouts.admin')


@section('content')


<h1 class="text-3xl font-bold mb-6">
System Settings
</h1>


@if(session('success'))

<div class="bg-green-200 p-3">
{{session('success')}}
</div>

@endif



<form method="POST"
action="{{route('admin.settings.update')}}">

@csrf
@method('PUT')


<div>

<label>
System Name
</label>

<input 
class="border p-2 w-full"
name="system_name"
value="{{$settings->system_name}}">

</div>


<div class="mt-4">

<label>
Company Name
</label>

<input 
class="border p-2 w-full"
name="company_name"
value="{{$settings->company_name}}">

</div>



<div class="mt-4">

<label>
Email
</label>

<input 
class="border p-2 w-full"
name="email"
value="{{$settings->email}}">

</div>


<button
class="mt-5 bg-blue-600 text-white px-5 py-2 rounded">

Save Settings

</button>


</form>


@endsection