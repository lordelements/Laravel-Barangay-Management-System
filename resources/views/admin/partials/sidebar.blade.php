<aside class="w-64 min-h-screen bg-white dark:bg-gray-700 shadow-md text-gray-800 dark:text-gray-200">
    <ul class="space-y-2 p-4">

        {{-- Dashboard --}}
        <li>
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-2 rounded
               {{ request()->routeIs('admin.dashboard')
                    ? 'bg-indigo-600 text-white hover:bg-indigo-700 dark:hover:bg-indigo-500'
                    : 'text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600'
               }}">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z"
                        clip-rule="evenodd" />
                </svg>
                Dashboard
            </a>
        </li>

        {{-- Profile --}}
        <li>
            <a href="{{ route('admin.profile.admin-edit') }}"
                class="block px-4 py-2 rounded
               text-gray-700 dark:text-gray-200
               hover:bg-gray-200 dark:hover:bg-gray-600">
                Profile
            </a>
        </li>

        {{-- Residents --}}
        <li>
            <a href="{{ route('admin.residents-list') }}"
                class="block px-4 py-2 rounded
               text-gray-700 dark:text-gray-200
               hover:bg-gray-200 dark:hover:bg-gray-600">
                Residents
            </a>
        </li>

        {{-- Officials --}}
        <li>
            <a href="{{ route('admin.officials-list') }}"
                class="block px-4 py-2 rounded
               text-gray-700 dark:text-gray-200
               hover:bg-gray-200 dark:hover:bg-gray-600">
                Officials
            </a>
        </li>

        {{-- Reports --}}
        <li>
            <a href="{{ route('admin.reports-list') }}"
                class="block px-4 py-2 rounded
               text-gray-700 dark:text-gray-200
               hover:bg-gray-200 dark:hover:bg-gray-600">
                Reports
            </a>
        </li>


        {{-- Settings --}}
        <div class="divider border-t border-gray-200 dark:border-gray-600 my-2">
            <li>
                <a href="#"
                    class="block px-4 py-2 rounded
               text-gray-700 dark:text-gray-200
               hover:bg-gray-200 dark:hover:bg-gray-600">
                    Settings
                </a>
            </li>

            {{-- Users --}}
            <li>
                <a href="#"
                    class="block px-4 py-2 rounded
               text-gray-700 dark:text-gray-200
               hover:bg-gray-200 dark:hover:bg-gray-600">
                    Users
                </a>
            </li>
        </div>

    </ul>
</aside>