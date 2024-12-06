<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-poppins antialiased bg-gray-200">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation Bar -->
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-gradient-to-r from-blue-500 to-blue-700 text-white shadow-md">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-4xl font-extrabold tracking-tight">
                        {{ $header }}
                    </h1>
                </div>
            </header>
        @endisset

        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white rounded-lg shadow p-6">
                    @yield('content')
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-center py-6">
            <p class="text-sm text-gray-300">© {{ now()->year }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
            <a href="#" class="text-blue-400 hover:underline">Privacy Policy</a> | 
            <a href="#" class="text-blue-400 hover:underline">Terms of Service</a>
        </footer>
    </div>
     <!-- Page-Specific Scripts -->
     @yield('scripts')
</body>
</html>
