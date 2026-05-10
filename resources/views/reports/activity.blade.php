<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Activity Feed 
        </h2>
        <!-- RECENT ACTIVITY FEED -->
<div class="bg-white p-6 rounded shadow mt-6">

    <h2 class="text-lg font-bold mb-4">
        Recent Activity
    </h2>

    <div class="space-y-4">

        @forelse($recentReports as $report)

            <div class="border-b pb-3">

                <!-- REPORT TITLE -->
                <p class="font-semibold">
                    {{ $report->title }}
                </p>

                <!-- USER -->
                <p class="text-sm text-gray-600">
                    Submitted by:
                    {{ $report->user->name ?? 'Unknown User' }}
                </p>

                <!-- STATUS -->
                <div class="mt-1">

                    @if($report->status == 'approved')

                        <span class="text-green-600 font-semibold">
                            ✔ Approved
                        </span>

                    @elseif($report->status == 'rejected')

                        <span class="text-red-600 font-semibold">
                            ❌ Rejected
                        </span>

                    @else

                        <span class="text-yellow-600 font-semibold">
                            ⏳ Pending
                        </span>

                    @endif

                </div>

                <!-- TIME -->
                <p class="text-xs text-gray-500 mt-1">
                    {{ $report->created_at->diffForHumans() }}
                </p>

            </div>

        @empty

            <p>No recent activity.</p>

        @endforelse

    </div>

</div>

    </x-slot>
 </x-app-layout>   