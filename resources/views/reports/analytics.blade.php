<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reports Analytics
        </h2>

    </x-slot>

    


        <!-- Charts Container -->
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- STATUS CHART -->
            <div class="bg-white p-6 rounded shadow flex-1">

                <h2 class="text-lg font-bold mb-4">
                    Report Status Analytics
                </h2>

                <div class="h-80">
                    <canvas id="statusChart"></canvas>
                </div>

            </div>


            <!-- DEPARTMENT CHART -->
            <div class="bg-white p-6 rounded shadow flex-1">

                <h2 class="text-lg font-bold mb-4">
                    Department Report Analytics
                </h2>

                <div class="h-80">
                    <canvas id="departmentChart"></canvas>
                </div>

            </div>

        </div>

    </div>


    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        // STATUS CHART
        const ctx = document.getElementById('statusChart');

        new Chart(ctx, {

            type: 'bar',

            data: {

                labels: ['Pending', 'Approved', 'Rejected'],

                datasets: [{

                    label: 'Reports Count',

                    data: [
                        {{ $statusCounts['pending'] }},
                        {{ $statusCounts['approved'] }},
                        {{ $statusCounts['rejected'] }}
                    ],

                    backgroundColor: [
                        '#facc15',
                        '#22c55e',
                        '#ef4444'
                    ],

                    borderWidth: 1

                }]
            },

            options: {

                responsive: true,
                maintainAspectRatio: false,

                scales: {
                    y: {
                        beginAtZero: true
                    }
                }

            }

        });



        // DEPARTMENT CHART
        const deptCtx = document.getElementById('departmentChart');

        new Chart(deptCtx, {

            type: 'pie',

            data: {

                labels: [
                    @foreach($departmentCounts as $department)
                        '{{ $department['name'] }}',
                    @endforeach
                ],

                datasets: [{

                    label: 'Department Reports',

                    data: [
                        @foreach($departmentCounts as $department)
                            {{ $department['reports_count'] }},
                        @endforeach
                    ],

                    borderWidth: 1

                }]
            },

            options: {

                responsive: true,
                maintainAspectRatio: false

            }

        });

    </script>

</x-app-layout>