@extends('layouts.admin')

@section('page_title', 'Profile Settings')

@section('content')
<div class="space-y-8 p-6 rounded-lg">

    <!-- Profile Information Card -->
    <div class="bg-white dark:bg-gray-700 shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 text-gray-800 dark:text-gray-200">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <!-- Password Update Card -->
    <div class="bg-white dark:bg-gray-700 shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 text-gray-800 dark:text-gray-200">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <!-- Delete User Card -->
    <div class="bg-white dark:bg-gray-700 shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 text-gray-800 dark:text-gray-200">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</div>
@endsection
