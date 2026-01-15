@extends('layouts.admin')

@section('page_title', 'Audit Logs')

@section('content')
<section class="bg-gray-50 dark:bg-gray-900 p-4 antialiased">
    <div class="mx-auto max-w-screen-2xl">
        <div
            class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg border border-gray-200 dark:border-gray-700">

            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-5">
                <div class="w-full md:w-1/3">
                    <form class="flex items-center">
                        <label for="myInput" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="myInput"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Search logs..." required="">
                        </div>
                    </form>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Showing {{ $auditTrails->firstItem() }}-{{ $auditTrails->lastItem() }} of
                        {{ $auditTrails->total() }}
                    </span>
                </div>
            </div>

            <div class="overflow-x-auto min-h-[500px]">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-bold">Date created</th>
                            <th scope="col" class="px-6 py-4 font-bold">Date updated</th>
                            <th scope="col" class="px-6 py-4 font-bold">User Details</th>
                            <th scope="col" class="px-6 py-4 font-bold">Role</th>
                            <th scope="col" class="px-6 py-4 font-bold">Activity</th>
                            <th scope="col" class="px-6 py-4 font-bold">Description</th>
                            <th scope="col" class="px-6 py-4 font-bold text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($auditTrails as $log)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-white">
                                {{ $log->created_at->format('M d, Y') }}
                                <div class="text-xs font-normal text-gray-500">{{ $log->created_at->format('h:i A') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-white">
                                {{ $log->updated_at->format('M d, Y') }}
                                <div class="text-xs font-normal text-gray-500">{{ $log->updated_at->format('h:i A') }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-gray-900 dark:text-white font-semibold">{{ $log->name }}</span>
                                    <span class="text-xs">{{ $log->email }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                    {{ $log->role }}
                                </span>
                            </td>
                            <!-- <td class="px-6 py-4 text-center">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                                    {{ $log->action == 'CREATE' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $log->action == 'DELETE' ? 'bg-red-100 text-red-700' : '' }}
                                    {{ $log->action == 'UPDATE' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ $log->action }}
                                </span>
                            </td> -->
                            <td class="px-6 py-4 max-w-xs truncate">
                                {{ $log->activity }}
                            </td>
                            <td class="px-6 py-4 max-w-xs truncate">
                                {{ $log->description }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <nav
                class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4 border-t dark:border-gray-700">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    Total Records: <span
                        class="font-semibold text-gray-900 dark:text-white">{{ $auditTrails->total() }}</span>
                </span>
                <div class="inline-flex items-stretch -space-x-px">
                    {{ $auditTrails->links('pagination::tailwind') }}
                </div>
            </nav>
        </div>
    </div>
</section>
@endsection