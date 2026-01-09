@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')
<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <div
            class="bg-white dark:bg-gray-800 relative shadow-sm border border-gray-200 dark:border-gray-700 sm:rounded-xl overflow-hidden">

            <div
                class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border-b dark:border-gray-700">
                <div class="w-full md:w-1/2">
                    <input id="myInput" class="bg-gray-50 border-gray-300 text-sm rounded-lg pl-10 p-2.5 w-full"
                        type="text" placeholder="Search by ID, Name, Address, Contact Number, and etc.">
                </div>
                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal"
                        class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition-all">
                        <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Add New Official
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto overflow-y-auto relative w-full h-[600px]">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-fixed">
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 sticky top-0 z-10">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold w-32">Picture</th>
                            <th scope="col" class="px-6 py-4 font-semibold w-64">Full Name/Civil Status</th>
                            <th scope="col" class="px-6 py-4 font-semibold w-56">Contact & Email</th>
                            <th scope="col" class="px-6 py-4 font-semibold text-center w-32">Age/Gender</th>
                            <th scope="col" class="px-6 py-4 font-semibold w-40">Purok (Area)</th>
                            <th scope="col" class="px-6 py-4 font-semibold w-56">Position/Committee</th>
                            <th scope="col" class="px-6 py-4 text-right w-40">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700" id='myTable'>
                        @foreach ($brgyfficials as $official)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-16 h-16 flex-shrink-0"> @if ($official->photo)
                                    <img class="w-full h-full object-cover rounded-xl shadow-md border-2 border-white dark:border-gray-700"
                                        src="{{ Str::startsWith($official->photo, '/storage/') ? $official->photo : asset('storage/' . $official->photo) }}"
                                        alt="Profile Photo">
                                    @else
                                    <div
                                        class="w-full h-full bg-blue-50 dark:bg-gray-700 rounded-xl flex items-center justify-center border-2 border-white dark:border-gray-700">
                                        <svg class="w-8 h-8 text-blue-200 dark:text-gray-600" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                        </svg>
                                    </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 truncate">
                                <div class="flex flex-col">
                                    <span class="text-base font-medium text-gray-900 dark:text-white truncate">
                                        {{ $official->first_name }} {{ $official->last_name }}
                                    </span>
                                    <span class="text-xs text-gray-400 italic">{{ $official->civil_status }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span
                                        class="text-gray-900 dark:text-white font-medium">{{ $official->phone_number }}</span>
                                    <span class="text-xs text-gray-500 italic truncate">{{ $official->email }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex flex-col">
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white">{{ $official->computed_age }}</span>
                                    <span
                                        class="text-[10px] uppercase font-bold text-gray-400">{{ $official->gender }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="text-xs text-gray-500 italic">{{ $official->purok?->street ?? 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span
                                        class="text-xs text-gray-800 dark:text-gray-200 font-bold">{{ $official->position?->position ?? 'N/A' }}</span>
                                    <span
                                        class="text-xs text-gray-500 italic truncate">{{ $official->committee?->committee_name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                        onclick="openEditModal(this)" data-official='@json($official)'
                                        data-route="{{ route('admin.officials-update', $official->id) }}"
                                        title="Edit Official">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>

                                    @if ($official->term_end < now()) <form method="POST"
                                        action="{{ route('admin.officials-delete', $official->id) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                            title="Remove Record">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                        </form>
                                        @else
                                        <span
                                            class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Active</span>
                                        @endif

                                        <a href="{{ route('admin.officials-show', $official->id) }}"
                                            class="p-2 text-sky-800 hover:bg-blue-50 rounded-lg transition-colors">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-width="2"
                                                    d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                                <path stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div
                class="p-4 bg-gray-50 dark:bg-gray-700/50 border-t dark:border-gray-700 flex justify-between items-center">
                <p class="text-xs text-gray-500 uppercase tracking-wider font-bold">
                    Total Registered Brgy Official: {{ $brgyfficials->total() }}
                </p>
                <div>
                    {{ $brgyfficials->links() }}
                </div>
            </div>

        </div>
    </div>

    <!-- Add Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto bg-gray-900/60 backdrop-blur-sm transition-opacity">

        <div class="mx-auto max-w-4xl p-6 w-full">
            <div
                class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">

                <div class="bg-blue-700 p-5 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Barangay Official Registration
                        </h2>
                        <p class="text-blue-100 text-sm mt-1">Please ensure all administrative details are accurate.</p>
                    </div>
                    <button type="button"
                        class="text-blue-100 bg-transparent hover:bg-blue-600 hover:text-white rounded-lg text-sm p-2 transition-colors"
                        data-modal-hide="default-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('admin.officials-store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-0">
                    @csrf
                    <div class="p-8 space-y-8 overflow-y-auto max-h-[70vh]">

                        <div>
                            <h3
                                class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center border-b pb-2">
                                <span
                                    class="bg-blue-100 text-blue-700 w-6 h-6 rounded-full inline-flex items-center justify-center text-xs mr-2">01</span>
                                Personal Details
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">First
                                        Name</label>
                                    <input type="text" name="first_name"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="e.g. Ricardo" required>
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Middle
                                        Name</label>
                                    <input type="text" name="middle_name"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="e.g. Santos">
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Last
                                        Name</label>
                                    <input type="text" name="last_name"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="e.g. Dela Cruz" required>
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Suffix</label>
                                    <select name="suffix"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                                        <option value="">None</option>
                                        <option value="jr">Jr.</option>
                                        <option value="sr">Sr.</option>
                                        <option value="iii">III</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block mb-1.5 text-xs font-bold uppercase text-gray-500">
                                        Position
                                    </label>

                                    <select name="position_id" id="positionSelect" required
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm">
                                        <option value="">Select Position</option>
                                        @foreach ($brgy_positions as $brgy_pos)
                                        <option value="{{ $brgy_pos->id }}">{{ $brgy_pos->position }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block mb-1.5 text-xs font-bold uppercase text-gray-500">
                                        Committee Position
                                    </label>

                                    <select name="committee_id" id="committeePositionSelect" required
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm">
                                        <option value="">Select Committee Position</option>
                                        @foreach ($committees as $committee)
                                        <option value="{{ $committee->id }}">{{ $committee->committee_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Gender</label>
                                    <div class="flex mt-3 space-x-4">
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="radio" name="gender" value="male"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500"
                                                required>
                                            <span
                                                class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Male</span>
                                        </label>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="radio" name="gender" value="female"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                            <span
                                                class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Female</span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Civil
                                        Status</label>
                                    <select name="civil_status"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                                        <option value="">Select Civil Status</option>
                                        <option value="single">Single</option>
                                        <option value="married">Married</option>
                                        <option value="widowed">Widowed</option>
                                        <option value="separated">Separated</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Birthdate</label>
                                    <input type="date" name="birthdate"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </div>
                                <!-- <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Age</label>
                                    <input type="number" name="age"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="0">
                                </div> -->
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Birthplace</label>
                                    <input type="text" name="birthplace"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="City/Province">
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3
                                class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center border-b pb-2">
                                <span
                                    class="bg-blue-100 text-blue-700 w-6 h-6 rounded-full inline-flex items-center justify-center text-xs mr-2">02</span>
                                Contact & Location
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Email
                                        Address</label>
                                    <input type="email" name="email"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="name@example.com">
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Phone
                                        Number</label>
                                    <input type="tel" name="phone_number"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="09XX-XXX-XXXX">
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Purok
                                        (Area ID)</label>
                                    <select name="purok_id"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                                        <option value="">None</option>
                                        @foreach ($puroks as $purok)
                                        <option value="{{ $purok->id }}">{{ $purok->street }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3
                                class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center border-b pb-2">
                                <span
                                    class="bg-blue-100 text-blue-700 w-6 h-6 rounded-full inline-flex items-center justify-center text-xs mr-2">03</span>
                                Term & Profile Photo
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Term
                                        Start Date</label>
                                    <input type="date" name="term_start"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Term
                                        End Date</label>
                                    <input type="date" name="term_end"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </div>
                                <div class="md:col-span-2">
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Official
                                        Profile Photo</label>
                                    <input type="file" name="photo"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200 rounded-b dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                        <button type="reset"
                            class="text-gray-600 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-300 text-sm font-medium px-5 py-2.5 transition-all dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:bg-gray-600">
                            Clear Form
                        </button>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-8 py-2.5 text-center shadow-lg shadow-blue-500/30 transition-all active:scale-95">
                            Save Official Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Official Modal -->
    <div id="edit-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto bg-gray-900/70 backdrop-blur-sm transition-opacity">

        <div class="relative w-full max-w-5xl max-h-full">
            <div
                class="relative bg-white rounded-2xl shadow-2xl dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden">

                <div class="bg-gradient-to-r from-blue-700 to-blue-800 p-6 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-extrabold text-white flex items-center tracking-tight">
                            <svg class="w-7 h-7 mr-3 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Brgy Official Profile
                        </h3>
                        <p class="text-blue-100 text-sm mt-1 opacity-80">Update the existing information for this
                            official.</p>
                    </div>
                    <button type="button" onclick="closeEditModal()"
                        class="text-blue-100 bg-white/10 hover:bg-white/20 hover:text-white rounded-full text-sm p-2 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form id="editOfficialForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="official_id" id="edit_id">

                    <div class="p-8 space-y-8 overflow-y-auto max-h-[70vh]">

                        <div>
                            <h3
                                class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center border-b pb-2">
                                <span
                                    class="bg-blue-100 text-blue-700 w-6 h-6 rounded-full inline-flex items-center justify-center text-xs mr-2">01</span>
                                Personal Details
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">First
                                        Name</label>
                                    <input type="text" id="edit_first_name" name="first_name"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="e.g. Ricardo" required>
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Middle
                                        Name</label>
                                    <input type="text" id="edit_middle_name" name="middle_name"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="e.g. Santos">
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Last
                                        Name</label>
                                    <input type="text" id="edit_last_name" name="last_name"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="e.g. Dela Cruz" required>
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Suffix</label>
                                    <select id="edit_suffix" name="suffix"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                                        <option value="">None</option>
                                        <option value="jr">Jr.</option>
                                        <option value="sr">Sr.</option>
                                        <option value="iii">III</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block mb-1.5 text-xs font-bold uppercase text-gray-500">
                                        Position
                                    </label>

                                    <select id="edit_position_id" name="position_id" required
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm">
                                        <option value="">Select Position</option>
                                        @foreach ($brgy_positions as $brgy_pos)
                                        <option value="{{ $brgy_pos->id }}">{{ $brgy_pos->position }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block mb-1.5 text-xs font-bold uppercase text-gray-500">
                                        Committee Position
                                    </label>

                                    <select name="committee_id" id="edit_committee_id" required
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm">
                                        <option value="">Select Committee Position</option>
                                        @foreach ($committees as $committee)
                                        <option value="{{ $committee->id }}">{{ $committee->committee_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Gender</label>
                                    <div class="flex mt-3 space-x-4">
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="radio" name="gender" value="male"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500"
                                                required>
                                            <span
                                                class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Male</span>
                                        </label>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="radio" name="gender" value="female"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                            <span
                                                class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Female</span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Civil
                                        Status</label>
                                    <select name="civil_status" id="edit_civil_status"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                                        <option value="">Select Civil Status</option>
                                        <option value="single">Single</option>
                                        <option value="married">Married</option>
                                        <option value="widowed">Widowed</option>
                                        <option value="separated">Separated</option>

                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Birthdate</label>
                                    <input type="date" name="birthdate" id="edit_birthdate"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Age</label>
                                    <input type="number" name="age" id="edit_age"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="0">
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Birthplace</label>
                                    <input type="text" name="birthplace" id="edit_birthplace"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="City/Province">
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3
                                class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center border-b pb-2">
                                <span
                                    class="bg-blue-100 text-blue-700 w-6 h-6 rounded-full inline-flex items-center justify-center text-xs mr-2">02</span>
                                Contact & Location
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Email
                                        Address</label>
                                    <input type="email" name="email" id="edit_email"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="name@example.com">
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Phone
                                        Number</label>
                                    <input type="tel" name="phone_number" id="edit_phone_number"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        placeholder="09XX-XXX-XXXX">
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Purok
                                        (Area ID)</label>
                                    <select name="purok_id" id="edit_purok_id"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                                        <option value="">None</option>
                                        @foreach ($puroks as $purok)
                                        <option value="{{ $purok->id }}">{{ $purok->street }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3
                                class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center border-b pb-2">
                                <span
                                    class="bg-blue-100 text-blue-700 w-6 h-6 rounded-full inline-flex items-center justify-center text-xs mr-2">03</span>
                                Term & Profile Photo
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Term
                                        Start Date</label>
                                    <input type="date" name="term_start" id="edit_term_start"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Term
                                        End Date</label>
                                    <input type="date" name="term_end" id="edit_term_end"
                                        class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </div>
                                <div class="md:col-span-2">
                                    <div class="mb-4">
                                        <label
                                            class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Current
                                            Profile Photo</label>
                                        <img id="edit_photo_preview" src="" alt="Official Photo"
                                            class="w-32 h-32 object-cover rounded-lg border">
                                    </div>

                                    <label
                                        class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Official
                                        Profile Photo</label>
                                    <input type="file" name="photo" id="edit_photo"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-end p-6 space-x-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                        <button type="button" onclick="closeEditModal()"
                            class="px-6 py-2.5 text-sm font-semibold text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-all dark:bg-gray-700 dark:text-gray-300">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-10 py-2.5 text-sm font-bold text-white bg-blue-700 rounded-lg hover:bg-blue-800 shadow-lg shadow-blue-500/20 transition-all transform active:scale-95">
                            Update Official Information
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Modal -->


</section>

<script>
function openEditModal(button) {
    const official = JSON.parse(button.getAttribute('data-official'));

    // Use the route from the button's data attribute
    const route = button.getAttribute('data-route');
    document.getElementById('editOfficialForm').action = route;

    document.getElementById('edit-modal').classList.remove('hidden');

    document.getElementById('edit_first_name').value = official.first_name;
    document.getElementById('edit_middle_name').value = official.middle_name ?? '';
    document.getElementById('edit_last_name').value = official.last_name;
    document.getElementById('edit_suffix').value = official.suffix;
    document.getElementById('edit_email').value = official.email;
    document.getElementById('edit_phone_number').value = official.phone_number;
    document.getElementById('edit_age').value = official.age;

    // Radio buttons
    document.querySelectorAll('input[name="gender"]').forEach(radio => {
        radio.checked = radio.value === official.gender;
    });

    document.getElementById('edit_birthdate').value = official.birthdate;
    document.getElementById('edit_birthplace').value = official.birthplace;
    document.getElementById('edit_civil_status').value = official.civil_status;
    document.getElementById('edit_purok_id').value = official.purok_id;
    document.getElementById('edit_position_id').value = official.position_id;
    document.getElementById('edit_committee_id').value = official.committee_id;
    document.getElementById('edit_term_start').value = official.term_start;
    document.getElementById('edit_term_end').value = official.term_end;

    // Show current photo preview
    document.getElementById('edit_photo_preview').src = official.photo ?
        `/storage/${official.photo.replace('public/', '')}` :
        '/admin/img/default_profile.png';
}


function closeEditModal() {
    document.getElementById('edit-modal').classList.add('hidden');
}

// Search Functionality  
$(document).ready(function() {
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>

@endsection