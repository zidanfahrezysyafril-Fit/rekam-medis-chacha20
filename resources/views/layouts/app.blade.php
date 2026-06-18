<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EMR System') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-blue-50 text-slate-800 flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside class="w-64 bg-blue-900 text-white flex flex-col hidden md:flex">
            <div class="h-16 flex items-center justify-center border-b border-blue-800 font-bold text-xl tracking-wider">
                EMR System
            </div>
            <div class="flex-1 overflow-y-auto py-4">
                <nav class="space-y-1 px-2">
                    @include('layouts.sidebar-links')
                </nav>
            </div>
            <div class="p-4 border-t border-blue-800 text-sm">
                <div class="truncate">{{ Auth::user()->name }}</div>
                <div class="text-blue-300 text-xs uppercase font-semibold mt-1">{{ Auth::user()->role }}</div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Topbar -->
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 z-10">
                <div class="flex items-center">
                    <!-- Mobile Menu Button -->
                    <button class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    @isset($header)
                        <h2 class="text-xl font-semibold text-gray-800 leading-tight ml-4 md:ml-0">
                            {{ $header }}
                        </h2>
                    @endisset
                </div>
                
                <div class="flex items-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-600 hover:text-blue-600 font-medium">
                            Log Out
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-6">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
