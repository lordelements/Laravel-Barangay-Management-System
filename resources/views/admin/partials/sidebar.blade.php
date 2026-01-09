<aside x-data="{ 
    open: true, 
    settingsOpen: {{ request()->routeIs('admin.streets-list*') ? 'true' : 'false' }} 
}" :class="open ? 'w-64' : 'w-20'"
    class="relative transition-all duration-300 ease-in-out min-h-screen bg-white dark:bg-gray-700 shadow-md text-gray-800 dark:text-gray-200">

    <button @click="open = !open"
        class="absolute -right-3 top-10 z-10 bg-indigo-600 text-white rounded-full p-1 shadow-lg hover:bg-indigo-700 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-300"
            :class="open ? 'rotate-0' : 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    <div class="p-4 mb-4 flex flex-col items-center gap-2 overflow-hidden">
        <div class="flex justify-center">
            <img src="{{ asset('admin/img/sk_biton_logo.jpg') }}" alt="Logo" class="w-12 h-12">
        </div>

        <span x-show="open" x-transition.opacity
            class="font-bold text-lg leading-tight text-center break-words uppercase tracking-wide">
            Brgy Management <br> System
        </span>
    </div>

    <ul class="space-y-2 p-4">
        {{-- Dashboard --}}
        <li>
            <a href="{{ route('admin.dashboard') }}" title="Dashboard" class="flex items-center gap-3 px-4 py-2 rounded transition-colors
               {{ request()->routeIs('admin.dashboard')
                   ? 'bg-indigo-600 text-white'
                   : 'text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600'
               }}">
                <div class="min-w-[24px]">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <span x-show="open" x-transition.opacity class="whitespace-nowrap">Dashboard</span>
            </a>
        </li>

        {{-- Residents --}}
        <li>
            <a href="{{ route('admin.residents-list') }}" title="Residents"
                class="flex items-center gap-3 px-4 py-2 rounded transition-colors {{ request()->routeIs('admin.residents-list') ? 'bg-indigo-50 dark:bg-gray-600 text-indigo-600 dark:text-white' : 'hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                <div class="min-w-[24px]">
                    <i class="fas fa-users w-6 h-6 text-gray-800 dark:text-white"></i>
                </div>
                <span x-show="open" x-transition.opacity class="whitespace-nowrap">Residents Record</span>
            </a>
        </li>

        {{-- Barangay Officials --}}
        <li>
            <a href="{{ route('admin.officials-list') }}" title="Barangay Officials"
                class="flex items-center gap-3 px-4 py-2 rounded transition-colors {{ request()->routeIs('admin.officials-list') ? 'bg-indigo-50 dark:bg-gray-600 text-indigo-600 dark:text-white' : 'hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                <div class="min-w-[24px]">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" fill="currentColor" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <span x-show="open" x-transition.opacity class="whitespace-nowrap">Brgy Officials Record</span>
            </a>
        </li>

        {{-- Barangay Issuance Certificate --}}
        <li>
            <a href="{{ route('admin.officials-list') }}" title="Barangay Officials"
                class="flex items-center gap-3 px-4 py-2 rounded transition-colors {{ request()->routeIs('admin.officials-list') ? 'bg-indigo-50 dark:bg-gray-600 text-indigo-600 dark:text-white' : 'hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                <div class="min-w-[24px]">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v6.41A7.5 7.5 0 1 0 10.5 22H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                            d="M9 16a6 6 0 1 1 12 0 6 6 0 0 1-12 0Zm6-3a1 1 0 0 1 1 1v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 1 1 0-2h1v-1a1 1 0 0 1 1-1Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <span x-show="open" x-transition.opacity class="whitespace-nowrap">Issuance Certificate</span>
            </a>
        </li>

        {{-- Barangay Households Community --}}
        <li>
            <a href="{{ route('admin.officials-list') }}" title="Barangay Officials"
                class="flex items-center gap-3 px-4 py-2 rounded transition-colors {{ request()->routeIs('admin.officials-list') ? 'bg-indigo-50 dark:bg-gray-600 text-indigo-600 dark:text-white' : 'hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                <div class="min-w-[24px]">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <span x-show="open" x-transition.opacity class="whitespace-nowrap">Households Community</span>
            </a>
        </li>

        {{-- Barangay Blotter Reports --}}
        <li>
            <a href="{{ route('admin.officials-list') }}" title="Barangay Officials"
                class="flex items-center gap-3 px-4 py-2 rounded transition-colors {{ request()->routeIs('admin.officials-list') ? 'bg-indigo-50 dark:bg-gray-600 text-indigo-600 dark:text-white' : 'hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                <div class="min-w-[24px]">
                    <i class="fas fa-file-alt w-6 h-6 text-gray-800 dark:text-white"></i>
                </div>
                <span x-show="open" x-transition.opacity class="whitespace-nowrap">Blotter Reports</span>
            </a>
        </li>

        {{-- Settings Dropdown --}}
        <div class="border-t border-gray-200 dark:border-gray-600 my-4"></div>

        <li>
            <button @click="settingsOpen = !settingsOpen"
                class="flex items-center justify-between w-full px-4 py-2 rounded transition-colors hover:bg-gray-200 dark:hover:bg-gray-600 group">
                <div class="flex items-center gap-3">
                    <div class="min-w-[24px]">
                        <svg class="w-6 h-6 {{ request()->routeIs('admin.streets-list*') ? 'text-indigo-600' : 'text-gray-500' }} group-hover:text-indigo-600"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span x-show="open" x-transition.opacity class="whitespace-nowrap">Settings</span>
                </div>

                <svg x-show="open" :class="settingsOpen ? 'rotate-180' : ''"
                    class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <ul x-show="settingsOpen && open" x-cloak x-collapse class="mt-2 space-y-1 ml-9 overflow-hidden">
                <li>
                    <a href="{{ route('admin.streets-list') }}"
                        class="block px-4 py-2 text-sm rounded transition-colors {{ request()->routeIs('admin.streets-list') ? 'text-indigo-600 font-bold' : 'hover:text-indigo-600 dark:hover:text-indigo-400 text-gray-500' }}">
                        Streets (Puroks)
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2 text-sm rounded hover:text-indigo-600 dark:hover:text-indigo-400 text-gray-500 transition-colors">
                        User Permissions
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.official-positions-list') }}"
                        class="block px-4 py-2 text-sm rounded hover:text-indigo-600 dark:hover:text-indigo-400 text-gray-500 transition-colors">
                        Brgy Officials Position
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.committee-positions-list') }}"
                        class="block px-4 py-2 text-sm rounded hover:text-indigo-600 dark:hover:text-indigo-400 text-gray-500 transition-colors">
                        Brgy Committee Position
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>