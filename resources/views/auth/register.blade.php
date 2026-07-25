<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">

        <h2 class="text-3xl font-bold text-center mb-6">
            Employee Registration
        </h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST">

            @csrf

            <div class="mb-4">
                <label>Name</label>
                <input type="text"
                       name="name"
                       class="w-full border rounded p-2"
                       required>
            </div>

            <div class="mb-4">
                <label>Email</label>
                <input type="email"
                       name="email"
                       class="w-full border rounded p-2"
                       required>
            </div>

            <div class="mb-4">
                <label>Phone</label>
                <input type="text"
                       name="phone"
                       class="w-full border rounded p-2"
                       required>
            </div>

            <div class="mb-4">
                <label>Password</label>
                <input type="password"
                       name="password"
                       class="w-full border rounded p-2"
                       required>
            </div>

            <div class="mb-6">
                <label>Confirm Password</label>
                <input type="password"
                       name="password_confirmation"
                       class="w-full border rounded p-2"
                       required>
            </div>

            <button
                class="w-full bg-blue-700 text-white p-3 rounded hover:bg-blue-800">
                Register
            </button>

        </form>

        <div class="text-center mt-5">
            Already have an account?

            <a href="{{ route('login') }}"
               class="text-blue-700 font-bold">
                Login
            </a>
        </div>

    </div>

</div>

</body>
</html>