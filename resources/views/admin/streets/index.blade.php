@extends('layouts.admin')

@section('page_title', 'Purok Management')

@section('content')
<section class="p-4 sm:p-6 antialiased">
    <div class="mx-auto max-w-screen-xl">
        <div class="flex flex-col md:flex-row items-center justify-between mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Purok Management</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">View and manage local jurisdictional puroks.</p>
            </div>
            <button type="button" 
                data-modal-target="default-modal" 
                data-modal-toggle="default-modal"
                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 transition-all shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Purok
            </button>
        </div>

        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm overflow-hidden">
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50/50 dark:bg-gray-700/50 border-b dark:border-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold">ID</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Purok Name</th>
                            <th scope="col" class="px-6 py-4 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse ($puroks as $purok)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs text-gray-500">#{{ $purok->id }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ $purok->street }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <button onclick="openEditModal({{ $purok->id }}, '{{ $purok->street }}')" 
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg dark:hover:bg-blue-900/30 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </button>
                                    <form action="{{ route('admin.puroks.destroy', $purok->id) }}" method="POST" onsubmit="return confirm('Delete this purok?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg dark:hover:bg-red-900/30 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                No records found. Click "Add New Purok" to get started.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 border-t dark:border-gray-700 flex flex-col sm:flex-row justify-between items-center gap-4">
                <span class="text-sm text-gray-600 dark:text-gray-400">
                    Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $puroks->count() }}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{ $puroks->total() }}</span> entries
                </span>
                <div>
                    {{ $puroks->links() }}
                </div>
            </div>
        </div>
    </div>

    <div id="modal-backdrop" class="hidden fixed inset-0 z-40 bg-gray-900/50 backdrop-blur-sm"></div>

    <div id="default-modal" tabindex="-1" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="relative w-full max-w-md bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden">
            <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">New Purok</h3>
                <button type="button" data-modal-hide="default-modal" class="text-gray-400 hover:text-gray-900 dark:hover:text-white p-1.5 ml-auto inline-flex items-center rounded-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <form action="{{ route('admin.puroks.store') }}" method="POST" class="p-6">
                @csrf
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purok Name</label>
                    <input type="text" name="street" required
                        class="w-full p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="e.g. Purok Malakas">
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" data-modal-hide="default-modal" class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-indigo-700 focus:z-10 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors">Create Purok</button>
                </div>
            </form>
        </div>
    </div>

    <div id="edit-modal" tabindex="-1" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="relative w-full max-w-md bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden border dark:border-gray-700">
             <div class="p-6">
                <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Edit Purok</h3>
                <form id="editForm" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">New Name</label>
                        <input type="text" id="editStreetName" name="street" required
                            class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-gray-500 hover:text-gray-700">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Update Changes</button>
                    </div>
                </form>
             </div>
        </div>
    </div>
</section>

<script>
    function openEditModal(id, name) {
        const modal = document.getElementById('edit-modal');
        const form = document.getElementById('editForm');
        const input = document.getElementById('editStreetName');
        
        // Update form action URL dynamically
        form.action = `/admin/puroks/${id}`; 
        input.value = name;
        
        modal.classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
    }
</script>
@endsection