<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">

        <h2 class="text-3xl font-bold text-center mb-6">
            Login
        </h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.authenticate') }}">

            @csrf

            <div class="mb-4">
                <label>Email</label>
                <input
                    type="email"
                    name="email"
                    class="w-full border rounded p-2"
                    required
                    value="{{ old('email') }}">
            </div>

            <div class="mb-6">
                <label>Password</label>
                <input
                    type="password"
                    name="password"
                    class="w-full border rounded p-2"
                    required>
            </div>

            <button
                class="w-full bg-blue-700 text-white p-3 rounded hover:bg-blue-800">
                Login
            </button>

        </form>

        <div class="text-center mt-5">
            Don't have an account?

            <a href="{{ route('register') }}"
               class="text-blue-700 font-bold">
                Register
            </a>
        </div>

    </div>

</div>

</body>
</html>