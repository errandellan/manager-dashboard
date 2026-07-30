<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ManageWise - Employee Registration</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen bg-cover bg-center bg-no-repeat flex items-center justify-center"
      style="background-image: url('{{ asset('images/office-bg.jpg') }}');">

    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Registration Card -->
    <div class="relative z-10 w-full max-w-lg mx-4">

        <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl shadow-2xl p-8">

            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/manager-icon.png') }}"
                     alt="ManageWise Logo"
                     class="w-24 h-24 object-contain">
            </div>

            <!-- Heading -->
            <h1 class="text-3xl font-bold text-center text-white">
                ManageWise
            </h1>

            <p class="text-center text-gray-200 mb-8">
                Employee Registration
            </p>

            @if ($errors->any())
                <div class="bg-red-500/20 border border-red-400 text-red-100 p-3 rounded-lg mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST">

                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label class="block text-white mb-2">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        class="w-full bg-white/20 border border-white/30 text-white placeholder-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Enter your full name">
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-white mb-2">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full bg-white/20 border border-white/30 text-white placeholder-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Enter your email">
                </div>

                <!-- Phone -->
                <div class="mb-4">
                    <label class="block text-white mb-2">
                        Phone Number
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        required
                        class="w-full bg-white/20 border border-white/30 text-white placeholder-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Enter your phone number">
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label class="block text-white mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full bg-white/20 border border-white/30 text-white placeholder-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Create a password">
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label class="block text-white mb-2">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        class="w-full bg-white/20 border border-white/30 text-white placeholder-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Confirm your password">
                </div>

                <!-- Register Button -->
                <button
                    type="submit"
                    class="w-full bg-green-700 hover:bg-green-800 transition duration-300 text-white font-semibold py-3 rounded-lg shadow-lg">
                    Register
                </button>

            </form>

            <!-- Login Link -->
            <div class="text-center mt-6 text-gray-200">
                Already have an account?

                <a href="{{ route('login') }}"
                   class="text-green-300 font-semibold hover:underline">
                    Login
                </a>
            </div>

        </div>

    </div>

</body>
</html>