<header class="bg-white dark:bg-gray-800 shadow-sm h-16 flex items-center justify-between px-6">

    {{-- Left: Page title --}}
    <h1 class="text-lg font-semibold text-gray-700 dark:text-gray-200">
        @yield('page_title', 'Admin Dashboard')
    </h1>

    {{-- Right side --}}
    <div class="flex items-center gap-4">

        {{-- Dark mode --}}
        <button onclick="toggleDarkMode()" class="text-gray-600 dark:text-gray-300">
            <i class="fas fa-moon"></i>
        </button>

        {{-- Notifications --}}
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="relative text-gray-600 dark:text-gray-300">
                {{-- <i class="fas fa-bell text-lg"></i> --}}
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M3.559 4.544c.355-.35.834-.544 1.33-.544H19.11c.496 0 .975.194 1.33.544.356.35.559.829.559 1.331v9.25c0 .502-.203.981-.559 1.331-.355.35-.834.544-1.33.544H15.5l-2.7 3.6a1 1 0 0 1-1.6 0L8.5 17H4.889c-.496 0-.975-.194-1.33-.544A1.868 1.868 0 0 1 3 15.125v-9.25c0-.502.203-.981.559-1.331ZM7.556 7.5a1 1 0 1 0 0 2h8a1 1 0 0 0 0-2h-8Zm0 3.5a1 1 0 1 0 0 2H12a1 1 0 1 0 0-2H7.556Z"
                        clip-rule="evenodd" />
                </svg>

                <span class="absolute -top-1 -right-1 bg-red-600 text-xs text-white rounded-full px-1">
                    3
                </span>
            </button>

            <div x-show="open" x-transition @click.outside="open = false"
                class="absolute right-0 mt-2 w-72 bg-white dark:bg-gray-700 shadow-lg rounded-lg overflow-hidden z-50">

                <div class="p-4 border-b font-semibold dark:text-gray-200">
                    Notifications
                </div>

                <ul class="divide-y dark:divide-gray-600">
                    <li class="p-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-sm">
                        New resident registered
                    </li>
                    <li class="p-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-sm">
                        Pending clearance request
                    </li>
                </ul>

                <a href="#" class="block text-center py-2 text-indigo-600 hover:bg-gray-50 dark:hover:bg-gray-600">
                    View All
                </a>
            </div>
        </div>

        {{-- User Dropdown --}}
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                <span>{{ Auth::user()->name }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" x-transition @click.outside="open = false"
                class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-md shadow-lg border dark:border-gray-600 z-50">

                <a href="{{ route('admin.profile.admin-edit') }}"
                    class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600">
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </div>
</header>