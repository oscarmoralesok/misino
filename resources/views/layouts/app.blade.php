<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('img/icon.svg') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-200 dark:bg-gray-900">
        <div class="flex h-screen overflow-hidden">
            <!-- Desktop Sidebar -->
            @include('layouts.sidebar')

            <!-- Mobile Sidebar Overlay & Sidebar (Simplified for now, reuse navigation for mobile toggle or implement later) -->
            <!-- For now, we keep the original navigation for mobile hidden on desktop, but since we are changing layout, we need to adapt -->
            
            <div class="flex flex-col flex-1 w-0 overflow-hidden">
                <!-- Mobile Header -->
                <div class="md:hidden flex items-center justify-between bg-white border-b border-gray-200 px-4 py-2">
                    <x-application-logo class="block h-8 w-auto" />
                    <!-- Mobile Menu Button (using Alpine) -->
                    <div x-data="{ open: false }" class="relative">
                         <!-- Use the existing navigation component logic for mobile if needed, or simple dropdown -->
                         <!-- For simplicity in this iteration, I'll rely on the existing navigation.blade.php but ONLY for mobile/tablet top bar if I include it, 
                              BUT the prompt implies a design shift. I will include a simple mobile header here. -->
                    </div>
                </div>
                
                <!-- We need a Mobile Navigation handling. The easiest way is to wrap the sidebar in an optional off-canvas for mobile. 
                    However, to keep it simple and robust:
                    I will include the OLD 'layouts.navigation' ONLY for mobile (sm:block, md:hidden) 
                    and the NEW 'layouts.sidebar' ONLY for desktop (md:block, hidden).
                -->
                <div class="md:hidden">
                    @include('layouts.navigation')
                </div>

                <!-- Top Bar -->
                @include('layouts.topbar')

                <!-- Main Content -->
                <main class="flex-1 relative overflow-y-auto focus:outline-none scroll-smooth">
                    <div class="py-6">
                        <div class="mx-auto px-4 sm:px-6 lg:px-16">
                            <!-- Page Heading -->
                            @isset($header)
                                <div class="mb-6">
                                    {{ $header }}
                                </div>
                            @endisset

                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        </div>
        @stack('scripts')
    </body>
</html>
