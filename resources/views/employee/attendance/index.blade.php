@extends('layouts.employee')

@section('content')


<div class="bg-white rounded-xl shadow p-6">


    <h2 class="text-2xl font-bold mb-6">
        My Attendance
    </h2>
    <table class="w-full">
        <thead>
            <tr class="border-b">
                <th class="text-left p-3">
                    Date
                </th>

                <th class="text-left p-3">
                    Login Time
                </th>

                <th class="text-left p-3">
                    Logout Time
                </th>

                <th class="text-left p-3">
                    Duration
                </th>

                <th class="text-left p-3">
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
        @forelse($attendanceLogs as $attendance)

            <tr class="border-b">
                <td class="p-3">
                    {{ $attendance->login_time->format('d M Y') }}
                </td>
               <td class="p-3">

                    {{ $attendance->login_time->format('h:i A') }}

                </td>
                <td class="p-3">
                    @if($attendance->logout_time)

                        {{ $attendance->logout_time->format('h:i A') }}

                    @else

                        Still Active

                    @endif

                </td>
                <td class="p-3">

                    {{ $attendance->session_duration ?? 0 }}
                    minutes

                </td>
                <td class="p-3">

                    {{ ucfirst($attendance->status) }}

                </td>
            </tr>
        @empty
            <tr>

                <td colspan="5" class="p-5 text-center text-gray-500">

                    No attendance records available yet.

                </td>

            </tr>

        @endforelse
   </tbody>
    </table>
</div>
@endsection