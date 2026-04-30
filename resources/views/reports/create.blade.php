<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Create Report
        </h2>
    </x-slot>

    <div class="flex justify-center p-6">
        <!-- Card -->
        <div class="w-full max-w-2xl bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6 border border-gray-200 dark:border-gray-600">

            <form method="POST" action="{{ route('reports.store') }}">
                @csrf

                <!-- Title -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">
                        Title
                    </label>

                    <input type="text"
                           name="title"
                           class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-gray-400 focus:outline-none"
                           required>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-200">
                        Description
                    </label>

                    <textarea name="description"
                              rows="5"
                              class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-gray-400 focus:outline-none"
                              required></textarea>
                </div>

                <!-- Button -->
                <div class="mt-6">
                    <x-primary-button>
                        Create Report
                    </x-primary-button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>