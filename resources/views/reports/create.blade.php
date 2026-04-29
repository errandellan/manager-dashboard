<x-app-layout>
    <x-slot name="header">
        <h2>Submit Report</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('reports.store') }}">
            @csrf

            <div>
                <label>Title</label>
                <input type="text" name="title" class="border w-full">
            </div>

            <div class="mt-4">
                <label>Description</label>
                <textarea name="description" class="border w-full"></textarea>
            </div>

            <button class="mt-4 bg-blue-500 text-white px-4 py-2">
                Submit
            </button>
        </form>
    </div>
</x-app-layout>