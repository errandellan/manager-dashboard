<!DOCTYPE html>
<html>
<head>

    <title>Manager Dashboard</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-gray-100">


<div class="flex min-h-screen">


    <!-- Sidebar -->

    <aside id="sidebar"
        class="w-64 bg-green-700 text-white hidden md:block">


        <!-- User Information -->

        <div class="p-6 border-b border-green-600">


            <div class="text-xl font-bold">
                {{ Auth::user()->name }}
            </div>


            <div class="text-sm text-green-200">
                {{ Auth::user()->role->name }}
            </div>


        </div>



        <!-- System Name -->

        <div class="p-6 text-2xl font-bold border-b border-green-600">

            MANAGER

        </div>



        <!-- Navigation -->

        <nav class="mt-6">


            <a href="{{ route('manager.dashboard') }}"
               
               class="block px-6 py-3 
               {{ request()->routeIs('manager.dashboard') 
                    ? 'bg-green-900' 
                    : 'hover:bg-green-600' }}">

                📊 Dashboard

            </a>

            
        <a href="{{ route('manager.employees.index') }}"
            class="block px-6 py-3 hover:bg-green-600">
                👥 Employees
            </a>
            



            <a href="{{route('manager.attendance')}}"
               class="block px-6 py-3 hover:bg-green-600">

                📅 Attendance

            </a>




            <a href="{{route('manager.tasks.index')}}"
               class="block px-6 py-3 hover:bg-green-600
               {{request()->routeIs('manager.tasks.*') ? 'bg-green-800' : ''}}">

                ✅ Tasks

            </a>



            <a href="{{ route('manager.performance') }}"
                class="block px-6 py-3 hover:bg-green-600">

                    📈 Performance

            </a>


            <a href="{{ route('manager.reports') }}"
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
        class="bg-green-700 text-white px-4 py-2 rounded">

            ☰

        </button>


    </div>





    <!-- Main Content -->


    <main class="flex-1 p-8">


        @yield('content')


    </main>



</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>