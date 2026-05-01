<x-app-layout>
    <x-slot name="header">
        <h2>Reports</h2>
    </x-slot>

    <div class="p-6">
        <div class="flex justify-start">
            <div class="flex items-center space-x-4">
                @if(Auth::user()->role_id == 3)
             <a href="{{ route('reports.create') }}" class="bg-blue-500 text-white px-3 py-2" alt="Create New Report">
                    ➕Create New Report
            </a>
                @endif
            </div>
            
        </div>
       

        <div class="mt-6">

            @forelse($reports as $report)
                <div class="border p-4 mb-4">

                    <h3 class="font-bold" style="font-size: 20px;">{{ $report->title }}</h3>

                    <p>{{ $report->description }}</p>

                    <small>
                        Submitted by: {{ $report->user->name ?? 'Unknown' }}
                    </small>

                </div>
            @empty
                <p>No reports yet.</p>
            @endforelse

        </div>

    </div>
</x-app-layout>