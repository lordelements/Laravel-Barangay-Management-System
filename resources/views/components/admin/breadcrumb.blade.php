<nav class="text-sm text-gray-500">
    <ol class="flex space-x-2">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600">
                Dashboard
            </a>
        </li>

        @foreach ($items as $item)
            <li>/</li>
            <li class="{{ $loop->last ? 'text-gray-800 font-semibold' : '' }}">
                {{ $item }}
            </li>
        @endforeach
    </ol>
</nav>
