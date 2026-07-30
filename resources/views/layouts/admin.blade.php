<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name')}}</title>
    <link rel="icon" type="image/png" href="{{asset ('manager-icon.png')}}">

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-900 text-white">

        <div class="p-6 text-2xl font-bold border-b border-blue-700">
            ADMIN
            
        </div>

        <nav class="mt-6">

    <a href="{{ route('admin.dashboard') }}"
       class="block px-6 py-3 hover:bg-blue-800">
        🏠 Dashboard
    </a>

    <a href="{{ route('admin.users') }}"
       class="block px-6 py-3 hover:bg-blue-800">
        👥 Users
    </a>

    <a href="{{ route('admin.departments') }}"
       class="block px-6 py-3 hover:bg-blue-800">
        🏢 Departments
    </a>

    <a href="{{ route('admin.jobs') }}"
       class="block px-6 py-3 hover:bg-blue-800">
        💼 Jobs
    </a>

    <hr class="my-4 border-blue-700">

    <a href="{{ route('profile.edit') }}"
       class="block px-6 py-3 hover:bg-blue-800">
        👤 My Profile
    </a>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button
            class="w-full text-left px-6 py-3 hover:bg-red-700">
            🚪 Logout
        </button>
    </form>

</nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">

        @yield('content')

    </main>

</div>

</body>
</html>