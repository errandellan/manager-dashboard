<x-app-layout>

     <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-800 leading-tight center">
            <strong>User Management</strong>
        </h1>

    
    </x-slot>
    


        

        {{--  SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- ❌ ERROR MESSAGE --}}
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        

        @foreach($users as $user)
            <div class="border p-4 mb-3">

                <strong>{{ $user->name }}</strong><br>
                {{ $user->email }}<br>

                {{-- 🔁 ROLE UPDATE FORM --}}
                <form method="POST" action="{{ route('users.updateRole', $user->id) }}" class="mt-2">
                    @csrf

                    <select name="role_id">
                        <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Manager</option>
                        <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Employee</option>
                    </select>

                    <button type="submit" class="bg-green-600 text-white px-2 py-1 ml-2">
                        Update Role
                    </button>
                </form>

                {{-- 🗑 DELETE BUTTON --}}
                <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                      onsubmit="return confirm('Are you sure you want to delete this user?');"
                      class="mt-2">
                      

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="bg-red-500 text-white px-2 py-1">
                        Delete User
                    </button>
                </form>

            </div>
        @endforeach

    </div>
</x-app-layout>