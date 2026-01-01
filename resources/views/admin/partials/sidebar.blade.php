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

    <div class="p-4 mb-4 flex items-center gap-3 overflow-hidden">
        <div class="min-w-[40px]">
            <img src="/logo.svg" alt="Logo" class="w-10 h-10">
        </div>
        <span x-show="open" x-transition.opacity class="font-bold text-xl whitespace-nowrap">
            BMS
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
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <span x-show="open" x-transition.opacity class="whitespace-nowrap">Residents Lists</span>
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
            </ul>
        </li>
    </ul>
</aside>