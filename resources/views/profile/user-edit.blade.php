@extends('layouts.app')

@section('content')
    <div class="space-y-8">
        <!-- Profile Information Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
            <div class="px-6 py-4 bg-slate-100 border-b border-slate-200">
                <h2 class="text-xl font-semibold text-slate-800 flex items-center">
                    <i class="fas fa-user w-5 mr-3 text-indigo-600"></i>
                    Profile Information
                </h2>
            </div>
            <div class="p-6">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Password Update Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
            <div class="px-6 py-4 bg-slate-100 border-b border-slate-200">
                <h2 class="text-xl font-semibold text-slate-800 flex items-center">
                    <i class="fas fa-lock w-5 mr-3 text-indigo-600"></i>
                    Update Password
                </h2>
            </div>
            <div class="p-6">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete User Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
            <div class="px-6 py-4 bg-slate-100 border-b border-slate-200">
                <h2 class="text-xl font-semibold text-slate-800 flex items-center">
                    <i class="fas fa-user-slash w-5 mr-3 text-red-600"></i>
                    Delete Account
                </h2>
            </div>
            <div class="p-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection