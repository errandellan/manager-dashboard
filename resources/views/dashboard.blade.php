<x-app-layout>
    <x-slot name="header">
        <h2>Dashboard</h2>
    </x-slot>

    <div class="p-6">
        <p>Role ID: {{ auth()->user()->role_id }}</p>

        <p>Role ID: {{ auth()->user()->role_id }}</p>

        @if(auth()->user()->role_id == 1)
            <h1>Admin Dashboard</h1>
            <p>Manage users, reports, and system settings</p>

        @elseif(auth()->user()->role_id == 2)
            <h1>Manager Dashboard</h1>
            <p>View reports and monitor activities</p>

        @else
            <h1>Employee Dashboard</h1>
            <p>Submit reports and view assigned tasks</p>
        @endif

    </div>
</x-app-layout>