@extends('layouts.admin')

@section('page_title', 'Brgy Positions')

@section('content')
<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <div
            class="bg-white dark:bg-gray-800 shadow-sm border border-gray-200 dark:border-gray-700 sm:rounded-xl overflow-hidden">

            <!-- Header -->
            <div class="flex flex-col md:flex-row items-center justify-between p-4 border-b dark:border-gray-700 gap-3">

                <!-- Search -->
                <div class="w-full md:w-1/2">
                    <form method="GET" action="{{ route('admin.official-positions-list') }}">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="w-full pl-10 p-2.5 text-sm border rounded-lg bg-gray-50 dark:bg-gray-700 dark:text-white"
                                placeholder="Search position name...">
                            <svg class="absolute left-3 top-3 w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </form>
                </div>

                <!-- Add Button -->
                <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal"
                    class="flex items-center text-white bg-blue-700 hover:bg-blue-800 rounded-lg text-sm px-5 py-2.5">
                    <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                    </svg> Add New Position
                </button>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 dark:bg-gray-700 text-xs uppercase">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Position Name</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse ($brgy_positions as $position)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="px-6 py-4">{{ $position->id }}</td>

                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{ $position->position }}
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">

                                    <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                        onclick="openEditModal(this)" data-position='@json($position)'
                                        data-route="{{ route('admin.positions-update', ['position' => $position->id]) }}"
                                        title="Edit Official">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>

                                    <form method="POST" action="{{ route('admin.delete-position', $position->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                            title="Remove Record">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                No barangay positions found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer -->
            <div class="p-4 bg-gray-50 dark:bg-gray-700/50 border-t flex justify-between">
                <p class="text-xs font-bold text-gray-500">
                    Total Positions: {{ $brgy_positions->count() }}
                </p>
            </div>

        </div>
    </div>


    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto bg-gray-900/60 backdrop-blur-sm">

        <div class="mx-auto w-full max-w-2xl">
            <div
                class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">

                <!-- Header -->
                <div class="bg-blue-700 p-5 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-white">
                            Add Barangay Official Position
                        </h2>
                        <p class="text-blue-100 text-sm mt-1">
                            Please ensure all position details are accurate.
                        </p>
                    </div>
                    <button type="button" class="text-blue-100 hover:bg-blue-600 rounded-lg p-2"
                        data-modal-hide="default-modal">
                        ✕
                    </button>
                </div>

                <!-- FORM -->
                <form method="POST" action="{{ route('admin.official-positions-store') }}">
                    @csrf

                    <div class="p-6 space-y-6">

                        <!-- Position Name -->
                        <div>
                            <label for="name" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Barangay Position Name
                            </label>

                            <input type="text" name="position" id="position" value="{{ old('position') }}" class="w-full p-3 bg-gray-50 border border-gray-300 rounded-lg
                                   focus:ring-blue-500 focus:border-blue-500 text-sm"
                                placeholder="e.g. Barangay Captain" required>

                            @error('position')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-end p-4 gap-3 border-t bg-gray-50 dark:bg-gray-800/50">

                        <button type="reset" class="px-5 py-2.5 text-sm border rounded-lg hover:bg-gray-100">
                            Clear
                        </button>

                        <button type="submit"
                            class="px-8 py-2.5 text-sm font-bold text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                            Save Position
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Edit modal -->
    <div id="edit-modal" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto bg-gray-900/60 backdrop-blur-sm">

        <div class="mx-auto w-full max-w-2xl">
            <div
                class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">

                <!-- Header -->
                <div class="bg-blue-700 p-5 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-white">
                            Update Barangay Official Position
                        </h2>
                        <p class="text-blue-100 text-sm mt-1">
                            Please ensure all position details are accurate.
                        </p>
                    </div>
                    <button type="button" class="text-blue-100 hover:bg-blue-600 rounded-lg p-2"
                        onclick="closeEditModal()">
                        ✕
                    </button>
                </div>

                <!-- FORM -->
                <form id="editPositionForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="official_id" id="edit_id">

                    <div class="p-6 space-y-6">

                        <!-- Position Name -->
                        <div>
                            <label for="name" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                Barangay Position Name
                            </label>

                            <input type="text" name="position" id="edit_position" value="{{ old('position') }}" class="w-full p-3 bg-gray-50 border border-gray-300 rounded-lg
                                   focus:ring-blue-500 focus:border-blue-500 text-sm"
                                placeholder="e.g. Barangay Captain" required>

                            @error('position')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-end p-4 gap-3 border-t bg-gray-50 dark:bg-gray-800/50">

                        <button type="reset" class="px-5 py-2.5 text-sm border rounded-lg hover:bg-gray-100">
                            Clear
                        </button>

                        <button type="submit"
                            class="px-8 py-2.5 text-sm font-bold text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                            Save Position
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>



</section>

<script>
function openEditModal(button) {
    const position = JSON.parse(button.dataset.position);
    const route = button.dataset.route;

    const form = document.getElementById('editPositionForm');
    const modal = document.getElementById('edit-modal');

    form.action = route;
    document.getElementById('edit_position').value = position.position;

    modal.classList.remove('hidden');
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