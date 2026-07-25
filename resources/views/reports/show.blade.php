<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Report Details
        </h2>
    </x-slot>

    <div class="p-6">

        <!-- Navigation -->
        <div class="flex flex-wrap gap-3 mb-6">

            <a href="{{ route('reports.index') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded">
                Back to Reports
            </a>

        </div>


        <!-- Report Card -->
        <div class="bg-white shadow rounded p-6">

            <!-- Title -->
            <h1 class="text-2xl font-bold mb-4">
                {{ $report->title }}
            </h1>

            <!-- Metadata -->
            <div class="mb-4 text-sm text-gray-600">

                <p>
                    <strong>Submitted By:</strong>
                    {{ $report->user->name ?? 'Unknown' }}
                </p>

                <p>
                    <strong>Department:</strong>

                    {{ $report->user->department->name ?? 'N/A' }}
                </p>

                <p>
                    <strong>Created:</strong>

                    {{ $report->created_at->format('d M Y - H:i') }}
                </p>

            </div>


            <!-- Status -->
            <div class="mb-6">

                @if($report->status == 'pending')

                    <span class="bg-yellow-500 text-white px-3 py-1 rounded">
                        Pending
                    </span>

                @elseif($report->status == 'approved')

                    <span class="bg-green-500 text-white px-3 py-1 rounded">
                        Approved
                    </span>

                @elseif($report->status == 'rejected')

                    <span class="bg-red-500 text-white px-3 py-1 rounded">
                        Rejected
                    </span>

                @endif

            </div>


            <!-- Full Description -->
            <div>

                <h3 class="text-lg font-semibold mb-2">
                    Full Description
                </h3>

                <div class="bg-gray-100 p-4 rounded leading-relaxed">

                    {{ $report->description }}

                </div>

            </div>


            <!-- Manager Actions -->
            @if(auth()->user()->role_id == 2)

                <div class="mt-6 flex gap-3">

                    <form action="{{ route('reports.approve', $report->id) }}"
                          method="POST">

                        @csrf

                        <button
                            class="bg-green-500 text-white px-4 py-2 rounded">

                            Approve

                        </button>

                    </form>


                    <form action="{{ route('reports.reject', $report->id) }}"
                          method="POST">

                        @csrf

                        <button
                            class="bg-red-500 text-white px-4 py-2 rounded">

                            Reject

                        </button>

                    </form>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>