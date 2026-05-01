<app-layout>
    <x-slot name="header">
        <h2>Users</h2>
    </x-slot>

    <div class="p-6">
       
        <div class="flex justify-start">
            <div class="flex items-center space-x-4">
                <p class="text-sm"><strong>Manage User Roles</strong></p>
            </div>
@foreach($users as $user)
    <div class="border p-4 mb-3">

        <strong>{{ $user->name }}</strong><br>
        {{ $user->email }}<br>

        <form method="POST" action="{{ route('users.updateRole', $user->id) }}">
            @csrf

            <select name="role_id">
                <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin</option>
                <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Manager</option>
                <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Employee</option>
            </select>

            <button type="submit" class="bg-green-600 text-white px-2 py-1">
                Update Role
            </button>
        </form>
         
    </div>
@endforeach    
                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                
                
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

        </div>
</app-layout>