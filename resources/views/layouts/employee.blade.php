<!DOCTYPE html>
<html>

<head>
    <title>
        {{ config('app.name', 'Manager Dashboard')}}
    </title>
    <link rel="icon" type="image/jpeg" href="{{ asset('logo.jpeg')}}">
    

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside id="sidebar"
           class="w-64 bg-blue-700 text-white hidden md:block">
        <!-- Employee Profile -->

        <div class="p-6 border-b border-blue-600">
            <div class="text-xl font-bold">

                {{ Auth::user()->name }}
            </div>
            <div class="text-sm text-blue-200">

                {{ Auth::user()->role->name }}
            </div>
        </div>

        <!-- System Title -->

        <div class="p-6 text-2xl font-bold border-b border--600">

            EMPLOYEE

        </div>
        <!-- Navigation -->

        <nav class="mt-6">

            <!-- Dashboard -->

            <a href="{{ route('employee.dashboard') }}"
            
            class="block px-6 py-3 
            {{ request()->routeIs('employee.dashboard') 
                ? 'bg-blue-900' 
                : 'hover:bg-blue-600' }}">

                🏠 Dashboard

            </a>
            <!-- Attendance -->
            <a href="{{ route('employee.attendance') }}"
            class="block px-6 py-3 hover:bg-blue-600">

                📅 My Attendance

            </a>

            <!-- Tasks -->

            <a href="{{ route('employee.tasks') }}"
            class="block px-6 py-3 hover:bg-blue-600">

                ✅ My Tasks

            </a>
           

            <!-- Performance -->

            <a href="{{ route('employee.performance') }}"
                class="block px-6 py-3 hover:bg-green-600">
                    📊 Performance
            </a>

            <!-- Reports -->
           <a href="{{ route('employee.reports') }}"
                class="block px-6 py-3 hover:bg-green-600">

                    📄 Reports

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

    <!-- Mobile Menu Button -->

    <div class="md:hidden fixed top-4 left-4 z-50">

        <button
        onclick="document.getElementById('sidebar').classList.toggle('hidden')"
        class="bg-blue-700 text-white px-4 py-2 rounded">
            ☰
        </button>

    </div>

    <!-- Main Content -->

    <main class="flex-1 p-8">

        @yield('content')

    </main>

</div>

</body>
</html>