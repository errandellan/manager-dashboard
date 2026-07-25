<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Managerial Dashboard System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <!-- Navigation -->
    <nav class="bg-blue-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center h-16">

                <div class="text-2xl font-bold">
                    Managerial Dashboard
                </div>

                <div class="space-x-6 hidden md:flex">
                    <a href="#" class="hover:text-gray-300">Home</a>
                    <a href="#features" class="hover:text-gray-300">Features</a>
                    <a href="#roles" class="hover:text-gray-300">User Roles</a>
                </div>

                <div class="space-x-3">
                    <a href="{{ route('login') }}"
                       class="bg-white text-blue-900 px-4 py-2 rounded-lg font-semibold hover:bg-gray-200">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="bg-green-500 px-4 py-2 rounded-lg font-semibold hover:bg-green-600">
                        Register
                    </a>
                </div>

            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-blue-800 text-white py-24">
        <div class="max-w-6xl mx-auto px-6 text-center">

            <h1 class="text-5xl font-bold mb-6">
                Managerial Dashboard System
            </h1>

            <p class="text-xl mb-8">
                Monitor employee attendance, activities, task completion,
                performance evaluation and reporting from one centralized platform.
            </p>

            <div class="space-x-4">
                <a href="{{ route('login') }}"
                   class="bg-white text-blue-900 px-8 py-3 rounded-lg font-bold">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="bg-green-500 px-8 py-3 rounded-lg font-bold">
                    Register
                </a>
            </div>

        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-20 bg-white">

        <div class="max-w-6xl mx-auto">

            <h2 class="text-4xl font-bold text-center mb-12">
                System Features
            </h2>

            <div class="grid md:grid-cols-3 gap-8">

                <div class="bg-gray-100 rounded-xl p-6 shadow">
                    <h3 class="text-xl font-bold mb-3">
                        Attendance Monitoring
                    </h3>

                    <p>
                        Monitor employee login and logout times and attendance history.
                    </p>
                </div>

                <div class="bg-gray-100 rounded-xl p-6 shadow">
                    <h3 class="text-xl font-bold mb-3">
                        Activity Tracking
                    </h3>

                    <p>
                        Track employee activities and productive working time.
                    </p>
                </div>

                <div class="bg-gray-100 rounded-xl p-6 shadow">
                    <h3 class="text-xl font-bold mb-3">
                        Task Management
                    </h3>

                    <p>
                        Assign tasks, monitor progress and completion status.
                    </p>
                </div>

                <div class="bg-gray-100 rounded-xl p-6 shadow">
                    <h3 class="text-xl font-bold mb-3">
                        Performance Evaluation
                    </h3>

                    <p>
                        Evaluate employee performance using attendance and completed tasks.
                    </p>
                </div>

                <div class="bg-gray-100 rounded-xl p-6 shadow">
                    <h3 class="text-xl font-bold mb-3">
                        Reports
                    </h3>

                    <p>
                        Generate attendance, activity and performance reports.
                    </p>
                </div>

                <div class="bg-gray-100 rounded-xl p-6 shadow">
                    <h3 class="text-xl font-bold mb-3">
                        Secure Access
                    </h3>

                    <p>
                        Role-based authentication for Administrators, Managers and Employees.
                    </p>
                </div>

            </div>

        </div>

    </section>

    <!-- User Roles -->
    <section id="roles" class="bg-gray-100 py-20">

        <div class="max-w-6xl mx-auto">

            <h2 class="text-4xl font-bold text-center mb-12">
                User Roles
            </h2>

            <div class="grid md:grid-cols-3 gap-8">

                <div class="bg-white rounded-xl shadow p-8">
                    <h3 class="text-2xl font-bold text-blue-900 mb-4">
                        Administrator
                    </h3>

                    <ul class="space-y-2">
                        <li>✔ Manage users</li>
                        <li>✔ Assign roles</li>
                        <li>✔ Manage departments</li>
                        <li>✔ Manage jobs</li>
                    </ul>
                </div>

                <div class="bg-white rounded-xl shadow p-8">
                    <h3 class="text-2xl font-bold text-green-700 mb-4">
                        Manager
                    </h3>

                    <ul class="space-y-2">
                        <li>✔ Assign tasks</li>
                        <li>✔ Monitor attendance</li>
                        <li>✔ Monitor activities</li>
                        <li>✔ Generate reports</li>
                    </ul>
                </div>

                <div class="bg-white rounded-xl shadow p-8">
                    <h3 class="text-2xl font-bold text-purple-700 mb-4">
                        Employee
                    </h3>

                    <ul class="space-y-2">
                        <li>✔ View assigned tasks</li>
                        <li>✔ Record attendance</li>
                        <li>✔ Complete tasks</li>
                        <li>✔ View reports</li>
                    </ul>
                </div>

            </div>

        </div>

    </section>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-8">

        <div class="text-center">

            <h3 class="text-xl font-bold">
                Managerial Dashboard System
            </h3>

            <p class="mt-2">
                A centralized employee monitoring and performance management platform.
            </p>

            <p class="mt-4 text-gray-300">
                © {{ date('Y') }} All Rights Reserved.
            </p>

        </div>

    </footer>

</body>
</html>