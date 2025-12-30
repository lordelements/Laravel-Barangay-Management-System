<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - Barangay System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="bg-gray-100 flex h-screen overflow-hidden dark:bg-gray-900 text-gray-800 dark:text-gray-200">

    {{-- Sidebar --}}
    @include('admin.partials.sidebar')

    {{-- Main area --}}
    <div class="flex-1 flex flex-col">

        {{-- Topbar --}}
        @include('admin.partials.topbar')

        {{-- SCROLLABLE CONTENT --}}
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>

    </div>


    <script>
    function toggleDarkMode() {
        document.documentElement.classList.toggle('dark');
        localStorage.theme = document.documentElement.classList.contains('dark')

            ?
            'dark' :
            'light';

    }

    // Load preference
    if (localStorage.theme === 'dark') {
        document.documentElement.classList.add('dark');
    }
    </script>

</body>

</html>