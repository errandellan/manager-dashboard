@extends(
    Auth::user()->role_id == 1 ? 'layouts.admin' :
    (Auth::user()->role_id == 2 ? 'layouts.manager' : 'layouts.employee')
)

@section('content')

<h2 class="text-3xl font-bold mb-8">
    👤 My Profile
</h2>

<p class="text-gray-600 mb-8">
    Manage your personal information, update your password, and keep your account secure.
</p>

<div class="space-y-8">

    <div class="bg-white shadow rounded-xl p-6">
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        @include('profile.partials.update-password-form')
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        @include('profile.partials.delete-user-form')
    </div>

</div>

@endsection