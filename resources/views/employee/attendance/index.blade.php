@extends('layouts.employee')

@section('content')

<div class="space-y-6">


    <!-- Page Header -->

    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl shadow p-6 text-white">


        <h1 class="text-3xl font-bold">
            My Attendance
        </h1>


        <p class="mt-2 text-blue-100">
            View your daily login, logout records and working duration.
        </p>


    </div>





    <!-- Attendance Table -->


    <div class="bg-white rounded-xl shadow overflow-hidden">


        <div class="p-6 border-b">


            <h2 class="text-xl font-bold text-gray-800">
                Attendance History
            </h2>


            <p class="text-sm text-gray-500 mt-1">

                Your previous attendance records are displayed below.

            </p>


        </div>





        <div class="overflow-x-auto">


            <table class="w-full text-left">


                <thead class="bg-gray-50 border-b">


                    <tr>


                        <th class="p-4 text-sm font-semibold text-gray-600">
                            Date
                        </th>


                        <th class="p-4 text-sm font-semibold text-gray-600">
                            Login Time
                        </th>


                        <th class="p-4 text-sm font-semibold text-gray-600">
                            Logout Time
                        </th>


                        <th class="p-4 text-sm font-semibold text-gray-600">
                            Duration
                        </th>


                        <th class="p-4 text-sm font-semibold text-gray-600">
                            Status
                        </th>


                    </tr>


                </thead>





                <tbody class="divide-y">


                @forelse($attendanceLogs as $attendance)



                    <tr class="hover:bg-gray-50 transition">



                        <td class="p-4 text-gray-700">


                            {{ $attendance->login_time->format('d M Y') }}


                        </td>





                        <td class="p-4 text-gray-700">


                            <div class="flex items-center gap-2">


                                <span class="text-blue-500">
                                    ●
                                </span>


                                {{ $attendance->login_time->format('h:i A') }}


                            </div>


                        </td>





                        <td class="p-4 text-gray-700">


                            @if($attendance->logout_time)


                                {{ $attendance->logout_time->format('h:i A') }}


                            @else


                                <span class="text-orange-600 font-medium">

                                    Still Active

                                </span>


                            @endif


                        </td>





                        <td class="p-4 text-gray-700">


                            <span class="bg-gray-100 px-3 py-1 rounded-full text-sm">


                                {{ $attendance->session_duration ?? 0 }}
                                minutes


                            </span>


                        </td>





                        <td class="p-4">


                            @if($attendance->status == 'active')


                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">

                                    Active

                                </span>


                            @else


                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-semibold">

                                    {{ ucfirst($attendance->status) }}

                                </span>


                            @endif


                        </td>



                    </tr>




                @empty



                    <tr>


                        <td colspan="5" class="p-8 text-center">


                            <div class="text-gray-400">


                                <p class="text-lg font-semibold">

                                    No Attendance Records

                                </p>


                                <p class="text-sm mt-2">

                                    Your attendance history will appear here after login.

                                </p>


                            </div>


                        </td>


                    </tr>



                @endforelse



                </tbody>


            </table>

        </div>


        <!-- Pagination -->

        <div class="p-6 border-t">

            {{ $attendanceLogs->links() }}

        </div>


    </div>



</div>





@endsection