@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')
<div class="space-y-8">

    <!-- Welcome Section -->
    <div class="bg-white dark:bg-gray-700 shadow-lg rounded-lg p-6 border border-gray-200 dark:border-gray-600">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-2">
            Welcome to the Barangay Admin Dashboard
        </h1>
        <p class="text-gray-600 dark:text-gray-300">
            Manage residents, view reports, and oversee community activities efficiently.
        </p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Total Residents -->
        <div class="bg-white dark:bg-gray-700 shadow-lg rounded-lg p-6 border border-gray-200 dark:border-gray-600 hover:shadow-xl transition">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-full">
                    <i class="fas fa-users text-blue-600 dark:text-blue-300 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Residents</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalResidents ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Active Reports -->
        <div class="bg-white dark:bg-gray-700 shadow-lg rounded-lg p-6 border border-gray-200 dark:border-gray-600 hover:shadow-xl transition">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 dark:bg-green-900 rounded-full">
                    <i class="fas fa-file-alt text-green-600 dark:text-green-300 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Active Reports</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $activeReports ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Pending Requests -->
        <div class="bg-white dark:bg-gray-700 shadow-lg rounded-lg p-6 border border-gray-200 dark:border-gray-600 hover:shadow-xl transition">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-full">
                    <i class="fas fa-clock text-yellow-600 dark:text-yellow-300 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Pending Requests</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pendingRequests ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- System Alerts -->
        <div class="bg-white dark:bg-gray-700 shadow-lg rounded-lg p-6 border border-gray-200 dark:border-gray-600 hover:shadow-xl transition">
            <div class="flex items-center">
                <div class="p-3 bg-red-100 dark:bg-red-900 rounded-full">
                    <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-300 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">System Alerts</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $systemAlerts ?? 0 }}</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Activities -->
    <div class="bg-white dark:bg-gray-700 shadow-lg rounded-lg border border-gray-200 dark:border-gray-600">
        <div class="p-6 border-b border-gray-200 dark:border-gray-600">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Recent Activities</h2>
        </div>

        <div class="p-6">
            <ul class="space-y-4">

                <li class="flex items-center space-x-4">
                    <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-full">
                        <i class="fas fa-user-plus text-blue-600 dark:text-blue-300"></i>
                    </div>
                    <div>
                        <p class="text-gray-800 dark:text-gray-200 font-medium">
                            New resident registered: John Doe
                        </p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">2 hours ago</p>
                    </div>
                </li>

                <li class="flex items-center space-x-4">
                    <div class="p-2 bg-green-100 dark:bg-green-900 rounded-full">
                        <i class="fas fa-check-circle text-green-600 dark:text-green-300"></i>
                    </div>
                    <div>
                        <p class="text-gray-800 dark:text-gray-200 font-medium">Report #123 resolved</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">1 day ago</p>
                    </div>
                </li>

                <li class="flex items-center space-x-4">
                    <div class="p-2 bg-yellow-100 dark:bg-yellow-900 rounded-full">
                        <i class="fas fa-clock text-yellow-600 dark:text-yellow-300"></i>
                    </div>
                    <div>
                        <p class="text-gray-800 dark:text-gray-200 font-medium">Pending request for clearance</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">3 days ago</p>
                    </div>
                </li>

            </ul>

            <div class="mt-6">
                <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:underline font-medium">
                    View All Activities →
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
