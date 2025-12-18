@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')
<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <div class="bg-white dark:bg-gray-800 relative shadow-sm border border-gray-200 dark:border-gray-700 sm:rounded-xl overflow-hidden">

            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border-b dark:border-gray-700">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Search reports</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Search by name or email..." required="">
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition-all">
                        <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Add New Reports
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold">Full Name</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Contact & Email</th>
                            <th scope="col" class="px-6 py-4 font-semibold text-center">Age/Gender</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Address</th>
                            <th scope="col" class="px-6 py-4 font-semibold text-center">Voter</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Status</th>
                            <th scope="col" class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex flex-col">
                                    <span class="text-base">Dela Cruz, Juan Mercado</span>
                                    <span class="text-xs text-gray-400 font-normal italic">First, Middle, Last</span>
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-gray-900 dark:text-white font-medium">0912-345-6789</span>
                                    <span class="text-xs text-gray-500 italic">juan.dc@email.com</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-gray-900 dark:text-white">28</span>
                                    <span class="text-[10px] uppercase font-bold text-gray-400">Male</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="max-w-[200px] truncate" title="123 Mahogany St. Barangay San Jose">123 Mahogany St. Barangay San Jose</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-2 py-1 rounded-md bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 text-xs font-bold ring-1 ring-inset ring-blue-700/10">YES</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full border border-green-200 dark:bg-green-900/40 dark:text-green-300 dark:border-green-800">Active</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Profile">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Remove Record">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="p-4 bg-gray-50 dark:bg-gray-700/50 border-t dark:border-gray-700 flex justify-between items-center">
                <p class="text-xs text-gray-500 uppercase tracking-wider font-bold">Total Registered Residents: 1,240</p>
                <div class="flex gap-2">
                    <button class="px-3 py-1 text-xs font-medium border rounded bg-white hover:bg-gray-50 text-gray-700">Prev</button>
                    <button class="px-3 py-1 text-xs font-medium border rounded bg-white hover:bg-gray-50 text-gray-700">Next</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto bg-gray-900/60 backdrop-blur-sm transition-opacity">

        <div class="relative w-full max-w-2xl h-full md:h-auto">
            <div class="relative bg-white rounded-xl shadow-2xl dark:bg-gray-800 border border-gray-100 dark:border-gray-700 overflow-hidden">

                <div class="bg-blue-700 p-5 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            Add New Report
                        </h3>
                        <p class="text-blue-100 text-sm mt-1">
                            Register a new individual to the community database.
                        </p>
                    </div>
                    <button type="button"
                        class="text-blue-100 bg-transparent hover:bg-blue-600 hover:text-white rounded-lg text-sm p-2 ml-auto inline-flex items-center transition-colors"
                        data-modal-hide="default-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('admin.residents-store') }}" method="POST">
                    @csrf

                    <div class="p-6 space-y-6 overflow-y-auto max-h-[70vh]">

                        <div class="grid gap-5 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <label class="block mb-1.5 text-sm font-semibold text-gray-700 dark:text-gray-300">First Name</label>
                                <input name="first_name" type="text" required placeholder="John"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all">
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block mb-1.5 text-sm font-semibold text-gray-700 dark:text-gray-300">Middle Name</label>
                                <input name="middle_name" type="text" placeholder="Quincy"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block mb-1.5 text-sm font-semibold text-gray-700 dark:text-gray-300">Last Name</label>
                                <input name="last_name" type="text" required placeholder="Doe"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block mb-1.5 text-sm font-semibold text-gray-700 dark:text-gray-300">Email Address</label>
                                <input name="email" type="email" required placeholder="name@company.com"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block mb-1.5 text-sm font-semibold text-gray-700 dark:text-gray-300">Home Address</label>
                                <input name="address" type="text" required placeholder="123 Street, Brgy, City"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block mb-1.5 text-sm font-semibold text-gray-700 dark:text-gray-300">Age</label>
                                <input name="age" type="number" required
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block mb-1.5 text-sm font-semibold text-gray-700 dark:text-gray-300">Civil Status</label>
                                <select name="status" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option>Single</option>
                                    <option>Married</option>
                                    <option>Widowed</option>
                                    <option>Separated</option>
                                </select>
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block mb-1.5 text-sm font-semibold text-gray-700 dark:text-gray-300">Gender</label>
                                <select name="gender" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block mb-1.5 text-sm font-semibold text-gray-700 dark:text-gray-300">Voter Status</label>
                                <select name="voter_status" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option>Registered Voter</option>
                                    <option>Non-Voter</option>
                                </select>
                            </div>
                        </div>

                        <div class="pt-2">
                            <label class="block mb-1.5 text-sm font-semibold text-gray-700 dark:text-gray-300">Additional Remarks</label>
                            <textarea name="description" rows="3" placeholder="Notes about the resident..."
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200 rounded-b dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                        <button type="reset"
                            class="text-gray-600 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-300 text-sm font-medium px-5 py-2.5 transition-all dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:bg-gray-600">
                            Clear Form
                        </button>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-8 py-2.5 text-center shadow-lg shadow-blue-500/30 transition-all active:scale-95">
                            Save Resident Report
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


</section>
@endsection