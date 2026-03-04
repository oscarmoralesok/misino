<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('img/icon.svg') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-950 text-gray-900 selection:bg-primary-100">
        <!-- Background Decoration -->
        <div class="fixed inset-0 z-[-1] pointer-events-none overflow-hidden">
            <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-primary-500/5 blur-[120px]"></div>
            <div class="absolute top-[20%] -right-[5%] w-[30%] h-[30%] rounded-full bg-accent-500/5 blur-[100px]"></div>
        </div>

        <div class="flex h-screen overflow-hidden">
            <!-- Desktop Sidebar -->
            @include('layouts.sidebar')
            
            <div class="flex flex-col flex-1 w-0 overflow-hidden">
                <!-- Mobile Navigation (Old component, can be refined later if needed) -->
                <div class="md:hidden">
                    @include('layouts.navigation')
                </div>

                <!-- Top Bar -->
                @include('layouts.topbar')

                <!-- Main Content -->
                <main class="flex-1 relative overflow-y-auto focus:outline-none scroll-smooth">
                    <div class="py-12">
                        <div class="mx-auto px-6 sm:px-10 lg:px-20">
                            <!-- Page Heading Refined -->
                            @isset($header)
                                <div class="mb-10 animate-fade-in">
                                    {{ $header }}
                                </div>
                            @endisset

                            <div class="animate-translate-up">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        @stack('scripts')
    </body>
</html>
