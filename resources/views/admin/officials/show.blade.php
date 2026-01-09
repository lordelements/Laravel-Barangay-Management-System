@extends('layouts.admin')

@section('page_title', 'Official Profile')

@section('content')
<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
    <div class="mx-auto max-w-screen-xl">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
            <a href="{{ route('admin.officials-list') }}"
                class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700 dark:text-blue-500 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Officials List
            </a>
            <div class="flex items-center space-x-3">
                <button type="button" onclick="window.print()"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 transition-all shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M5 4a2 2 0 012-2h6a2 2 0 012 2v1h1c1.1 0 2 .9 2 2v1h-3V4H7v3H4V6c0-1.1.9-2 2-2h1V4zm1 7h8v4H6v-4zm10 0h1a2 2 0 012 2v3a2 2 0 01-2 2h-1v-2a2 2 0 00-2-2H5a2 2 0 00-2 2v2H2a2 2 0 01-2-2v-3a2 2 0 012-2h1v-2a2 2 0 012-2h10a2 2 0 012 2v2z" />
                    </svg>
                    Print Profile
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-4">
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-8 text-center sticky top-5">
                    <div class="relative w-44 h-44 mx-auto mb-6">
                        @if ($official->photo)
                        <img class="w-full h-full object-cover rounded-2xl shadow-xl border-4 border-white dark:border-gray-700"
                            src="{{ Str::startsWith($official->photo, '/storage/') ? $official->photo : asset('storage/' . $official->photo) }}"
                            alt="Profile Photo">
                        @else
                        <div
                            class="w-full h-full bg-blue-50 dark:bg-gray-700 rounded-2xl flex items-center justify-center border-4 border-white dark:border-gray-700 shadow-lg">
                            <svg class="w-24 h-24 text-blue-200 dark:text-gray-600" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>
                        </div>
                        @endif
                        <span class="absolute -bottom-1 -right-1 flex h-6 w-6">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span
                                class="relative inline-flex rounded-full h-6 w-6 bg-green-500 border-4 border-white dark:border-gray-800"></span>
                        </span>
                    </div>

                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">
                        {{ $official->first_name }} {{ $official->middle_name }} {{ $official->last_name }}
                        <span class="text-gray-500 font-medium">{{ $official->suffix }}</span>
                    </h2>
                    <p class="text-blue-600 dark:text-blue-400 font-medium mt-1 mb-6">
                        {{ $official->email ?? 'No Email Provided' }}</p>

                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight mb-6">
                        {{ $official->position?->position ?? 'N/A' }}
                    </h2>
                    <div class="flex flex-wrap justify-center gap-2">
                        <span
                            class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full {{ $official->voter_status == 'registered_voter' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' }}">
                            {{ $official->voter_status == 'registered_voter' ? 'Registered Voter' : 'Non-Voter' }}
                        </span>
                        <span
                            class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                            {{ $official->civil_status }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-6">
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div
                        class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">Personal & Service Details</h3>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-8 gap-x-12">
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Phone
                                    Number</label>
                                <p class="text-gray-900 dark:text-white font-semibold text-lg">
                                    {{ $official->phone_number ?? 'N/A' }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Age
                                    / Gender</label>
                                <p class="text-gray-900 dark:text-white font-semibold text-lg">
                                    {{ $official->age }} yrs old / {{ ucfirst($official->gender) }}
                                </p>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Birthdate</label>
                                <p class="text-gray-900 dark:text-white font-semibold">
                                    {{ $official->birthdate ? \Carbon\Carbon::parse($official->birthdate)->format('F d, Y') : 'N/A' }}
                                </p>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Birthplace</label>
                                <p class="text-gray-900 dark:text-white font-semibold">
                                    {{ $official->birthplace ?? 'N/A' }}
                                </p>
                            </div>
                            <div class="sm:col-span-2">
                                <label
                                    class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Assigned
                                    Purok / Area</label>
                                <p class="text-gray-900 dark:text-white font-semibold">
                                    {{ $official->purok?->street ?? 'No Assigned Area' }}
                                </p>
                            </div>
                            <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Term
                                    Start</label>
                                <p class="text-green-600 dark:text-green-400 font-bold text-lg">
                                    {{ $official->term_start ? \Carbon\Carbon::parse($official->term_start)->format('M d, Y') : 'N/A' }}
                                </p>
                            </div>
                            <div class="pt-4 border-t border-gray-100 dark:border-gray-700">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Term
                                    End</label>
                                <p class="text-red-600 dark:text-red-400 font-bold text-lg">
                                    {{ $official->term_end ? \Carbon\Carbon::parse($official->term_end)->format('M d, Y') : 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection