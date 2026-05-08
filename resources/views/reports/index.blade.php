<x-app-layout>
    <x-slot name="header">
        <h2>Reports</h2>
    </x-slot>

    <div class="p-6">
        <!-- adding dashboard filters and actions summary -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <!-- Total Reports -->
        <div class="bg-blue-500 text-white p-4 rounded shadow">
            <h3 class="text-lg font-bold">Total Reports</h3>
            <p class="text-3xl">{{ $totalReports }}</p>
        </div>

        <!-- Pending -->
        <div class="bg-yellow-500 text-white p-4 rounded shadow">
            <h3 class="text-lg font-bold">Pending</h3>
            <p class="text-3xl">{{ $pendingReports }}</p>
        </div>

        <!-- Approved -->
        <div class="bg-green-500 text-white p-4 rounded shadow">
            <h3 class="text-lg font-bold">Approved</h3>
            <p class="text-3xl">{{ $approvedReports }}</p>
        </div>

        <!-- Rejected -->
        <div class="bg-red-500 text-white p-4 rounded shadow">
            <h3 class="text-lg font-bold">Rejected</h3>
            <p class="text-3xl">{{ $rejectedReports }}</p>
        </div>

    </div>
        <div class="flex justify-start">
            <div class="mb-4 flex space-x-2">

                <a href="{{ route('reports.index') }}"
                class="bg-gray-500 text-white px-3 py-1 rounded">
                    All
                </a>

                <a href="{{ route('reports.index', ['status' => 'pending']) }}"
                class="bg-yellow-500 text-white px-3 py-1 rounded">
                    Pending
                </a>

                <a href="{{ route('reports.index', ['status' => 'approved']) }}"
                class="bg-green-500 text-white px-3 py-1 rounded">
                    Approved
                </a>

                <a href="{{ route('reports.index', ['status' => 'rejected']) }}"
                class="bg-red-500 text-white px-3 py-1 rounded">
                    Rejected
                </a>

            </div>
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

                <h3 class="font-bold" style="font-size: 20px;">
                    {{ $report->title }}
                </h3>

                <p>{{ $report->description }}</p>

                <small>
                    Submitted by: {{ $report->user->name ?? 'Unknown' }}
                </small>

                <br>

                <small>
                    <div class="mt-2">
                    Status: 
                    <!-- <strong>{{ $report->status }}</strong> -->
                    @if($report->status == 'pending')

                        <span class="px-2 py-1 rounded text-white text-sm bg-yellow-500">
                            Pending
                        </span>

                    @elseif($report->status == 'approved')

                        <span class="px-2 py-1 rounded text-white text-sm bg-green-500">
                            Approved
                        </span>

                    @elseif($report->status == 'rejected')

                        <span class="px-2 py-1 rounded text-white text-sm bg-red-500">
                            Rejected
                        </span>

                    @else

                        <span class="px-2 py-1 rounded text-white text-sm bg-gray-500">
                            Unknown
                        </span>

                    @endif    
                    </div>
                </small>

                {{-- ⚡ MANAGER ACTIONS --}}
                @if(auth()->user()->role_id == 2)
                    <div class="mt-3 flex space-x-2">

                        <form action="{{ route('reports.approve', $report->id) }}" method="POST">
                            @csrf
                            <button class="bg-green-500 text-white px-3 py-1 rounded">
                                Approve
                            </button>
                        </form>

                        <form action="{{ route('reports.reject', $report->id) }}" method="POST">
                            @csrf
                            <button class="bg-red-500 text-white px-3 py-1 rounded">
                                Reject
                            </button>
                        </form>

                    </div>
                @endif

            </div>
        @empty
            <p>No reports yet.</p>
        @endforelse

        </div>

    </div>
</x-app-layout>