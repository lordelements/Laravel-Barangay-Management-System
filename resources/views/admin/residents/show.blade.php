@extends('layouts.admin')

@section('page_title', 'Resident Profile')

@section('content')
<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl">
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('admin.residents-list') }}"
                class="flex items-center text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Resident List
            </a>
            <div class="flex space-x-2">
                <button type="button"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 transition-all shadow-md">
                    Print Profile
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <div class="lg:col-span-4">
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 text-center">
                    <div class="relative w-40 h-40 mx-auto mb-4">
                        @if ($resident->photo)
                        <img class="w-full h-full object-cover rounded-2xl shadow-lg border-4 border-white dark:border-gray-700"
                            src="{{ asset('storage/' . $resident->photo) }}" alt="Profile">
                        @else
                        <div
                            class="w-full h-full bg-blue-100 dark:bg-gray-700 rounded-2xl flex items-center justify-center border-4 border-white dark:border-gray-700 shadow-lg">
                            <svg class="w-20 h-20 text-blue-400 opacity-50" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>
                        </div>
                        @endif
                        <span class="absolute bottom-2 right-2 flex h-4 w-4">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span
                                class="relative inline-flex rounded-full h-4 w-4 bg-green-500 border-2 border-white dark:border-gray-800"></span>
                        </span>
                    </div>

                    <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                        {{ $resident->first_name }} {{ $resident->middle_name }} {{ $resident->last_name }}
                        {{ $resident->suffix }}
                    </h2>
                    <p class="text-blue-600 dark:text-blue-400 font-medium text-sm mb-4">{{ $resident->email }}</p>

                    <div class="flex flex-wrap justify-center gap-2">
                        <span
                            class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300">
                            {{ $resident->voter_status == 'registered_voter' ? 'Registered Voter' : 'Non-Voter' }}
                        </span>
                        <span
                            class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                            {{ $resident->civil_status }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-6">

                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">Resident Information</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Phone
                                    Number</label>
                                <p class="mt-1 text-gray-900 dark:text-white font-semibold">
                                    {{ $resident->phone_number }}</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Age /
                                    Gender</label>
                                <p class="mt-1 text-gray-900 dark:text-white font-semibold">{{ $resident->age }} yrs old
                                    / {{ ucfirst($resident->gender) }}</p>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Birthdate</label>
                                <p class="mt-1 text-gray-900 dark:text-white font-semibold">
                                    {{ \Carbon\Carbon::parse($resident->birthdate)->format('F d, Y') }}</p>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Birthplace</label>
                                <p class="mt-1 text-gray-900 dark:text-white font-semibold">{{ $resident->birthplace }}
                                </p>
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Address
                                    (Purok/Street)</label>
                                <p class="mt-1 text-gray-900 dark:text-white font-semibold">
                                    {{ $resident->purok?->street ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- <div
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <h4 class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-widest mb-3">
                            Occupation</h4>
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                            {{ $resident->occupation ?? 'No occupation recorded' }}
                        </p>
                    </div> -->
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                        <h4 class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-widest mb-3">
                            Resident
                            Details
                            additional info</h4>
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed italic">
                            {{ $resident->description ?? 'No additional info.' }}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection