<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        {{-- For icons (if used in navigation) --}}
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> --}}

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    {{-- Changed body background to a slightly brighter shade for cleaner look --}}
    <body class="font-sans antialiased bg-gray-50"> 
        <div class="min-h-screen">
            
            {{-- Navigation (typically the top bar/menu) --}}
            @include('layouts.navigation')

            @isset($header)
                {{-- Enhanced header style: cleaner shadow and border for definition --}}
                <header class="bg-white shadow-lg border-b border-gray-100">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="py-12">
                {{-- Content wrapper for slot/yield --}}
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{-- This container gives the main content a card-like separation from the background --}}
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-10">
                        {{-- Laravel's standard slot for content --}}
                        {{ $slot ?? '' }} 
                        
                        {{-- Your preferred content yield --}}
                        @yield('content')
                    </div>
                </div>
            </main>
            
        </div>
    </body>
</html>