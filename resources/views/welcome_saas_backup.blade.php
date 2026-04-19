<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Misino - Servicios Premium para Eventos</title>
    
    <!-- Meta Theme -->
    <meta name="theme-color" content="#ffffff" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#0a0a0a" media="(prefers-color-scheme: dark)">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;700;800&display=swap" rel="stylesheet">

    <!-- Vite Custom CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Animaciones para la Landing */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .animate-float-delayed {
            animation: float 6s ease-in-out 3s infinite;
        }

        .hero-blob {
            position: absolute;
            filter: blur(80px);
            opacity: 0.5;
            z-index: 0;
            border-radius: 50%;
        }

        .dark .hero-blob { 
            opacity: 0.15; 
        }

        /* Degradado de texto */
        .text-gradient {
            background: linear-gradient(to right, theme('colors.primary.500'), theme('colors.indigo.400'));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-white dark:bg-[#080808] dark:text-gray-200 min-h-screen flex flex-col relative overflow-x-hidden selection:bg-primary-500/30 selection:text-primary-900 dark:selection:text-primary-100">

    {{-- Background Blobs for Glassmorphism Effect --}}
    <div class="hero-blob bg-primary-400 w-[500px] h-[500px] -top-32 -left-32 animate-float"></div>
    <div class="hero-blob bg-indigo-400 w-[400px] h-[400px] top-64 -right-16 animate-float-delayed"></div>
    <div class="hero-blob bg-blue-300 w-[600px] h-[600px] top-[40rem] left-1/4 opacity-40 animate-float" style="animation-duration: 10s;"></div>

    {{-- Header / Navbar --}}
    <header class="relative z-50 py-6 px-6 lg:px-12 flex justify-between items-center backdrop-blur-md bg-white/70 dark:bg-[#080808]/70 border-b border-gray-100/50 dark:border-gray-800/50 sticky top-0 w-full">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-indigo-600 rounded-2xl flex justify-center items-center shadow-lg shadow-primary-500/30">
                <span class="text-white font-display font-bold text-xl leading-none">M</span>
            </div>
            <span class="font-display font-extrabold text-2xl tracking-tighter text-gray-900 dark:text-white">misino</span>
        </div>

        @if (Route::has('login'))
            <nav class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-primary shadow-md hover:shadow-primary-500/20 active:scale-95 transition-all text-sm px-6 py-2.5">
                        Ir al Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="font-bold text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors uppercase tracking-widest hidden sm:block">
                        Iniciar Sesión
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-primary shadow-md hover:shadow-primary-500/20 active:scale-95 transition-all text-xs font-bold px-6 py-2.5 uppercase tracking-widest">
                            Regístrate
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    {{-- Main Content --}}
    <main class="flex-grow relative z-10 flex flex-col justify-center">

        {{-- Hero Section --}}
        <section class="max-w-7xl mx-auto px-6 lg:px-8 pt-20 pb-24 lg:pt-32 lg:pb-32 text-center flex flex-col items-center">
            <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest bg-primary-50 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400 border border-primary-100 dark:border-primary-800/50 mb-8 animate-fade-in shadow-sm">
                La plataforma líder para gestión de eventos
            </span>
            
            <h1 class="font-display font-extrabold tracking-tight text-5xl sm:text-6xl lg:text-7xl mb-6 lg:mb-8 max-w-4xl mx-auto leading-[1.1] animate-translate-up" style="animation-delay: 50ms;">
                Eleva el <span class="text-gradient">Estándar</span> de tus Eventos al Máximo
            </h1>
            
            <p class="text-lg sm:text-xl text-gray-500 dark:text-gray-400 mb-10 max-w-2xl mx-auto leading-relaxed animate-translate-up font-medium" style="animation-delay: 100ms;">
                Crea presupuestos dinámicos, controla la logística diaria y calcula rutas inteligentes combinando tecnología y diseño espectacular.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 items-center animate-translate-up" style="animation-delay: 150ms;">
                <a href="{{ route('register') ?? route('login') }}" class="btn-primary px-8 py-4 text-base font-bold shadow-xl shadow-primary-500/30 active:scale-95 flex items-center group w-full sm:w-auto justify-center">
                    Comenzar Gratis Hoy
                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                <a href="#servicios" class="px-8 py-4 text-base font-bold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white uppercase tracking-widest transition-colors w-full sm:w-auto text-center hover:bg-gray-50 dark:hover:bg-gray-800/50 rounded-2xl">
                    Ver Características
                </a>
            </div>

            {{-- Mockup/Preview Image (Abstract representation) --}}
            <div class="mt-20 w-full max-w-5xl relative animate-translate-up" style="animation-delay: 200ms;">
                <div class="absolute -inset-1 bg-gradient-to-r from-primary-600 to-indigo-600 rounded-[2rem] blur-xl opacity-20 dark:opacity-40 shadow-2xl"></div>
                <div class="relative bg-white/40 dark:bg-[#121212]/80 backdrop-blur-xl border border-gray-100 dark:border-gray-800 rounded-[2rem] shadow-2xl p-4 lg:p-6 overflow-hidden">
                    {{-- Mimic browser/dashboard window --}}
                    <div class="flex items-center gap-2 mb-4 px-2">
                        <div class="w-3 h-3 rounded-full bg-red-400"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                        <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
                    </div>
                    {{-- Dashboard Mock Layout --}}
                    <div class="bg-gray-50 dark:bg-[#161615] rounded-xl h-[400px] md:h-[500px] border border-gray-100 dark:border-gray-800/50 flex flex-col md:flex-row overflow-hidden shadow-inner w-full">
                        {{-- Mock Sidebar --}}
                        <div class="hidden md:flex w-64 border-r border-gray-200 dark:border-gray-800 p-6 flex-col gap-4">
                            <div class="w-32 h-4 bg-gray-200 dark:bg-gray-700/50 rounded-full mb-4"></div>
                            <div class="w-full h-10 bg-primary-50 dark:bg-primary-900/20 rounded-xl"></div>
                            <div class="w-full h-10 bg-gray-100 dark:bg-gray-800/50 rounded-xl"></div>
                            <div class="w-full h-10 bg-gray-100 dark:bg-gray-800/50 rounded-xl"></div>
                        </div>
                        {{-- Mock Content area --}}
                        <div class="flex-1 p-6 md:p-8 flex flex-col gap-6 w-full">
                            <div class="flex flex-col sm:flex-row justify-between gap-4">
                                <div>
                                    <div class="w-48 h-8 bg-gray-200 dark:bg-gray-700/50 rounded-full mb-2"></div>
                                    <div class="w-32 h-4 bg-gray-100 dark:bg-gray-800/50 rounded-full"></div>
                                </div>
                                <div class="w-32 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-xl self-start"></div>
                            </div>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div class="h-28 bg-emerald-50 dark:bg-emerald-900/10 border border-emerald-100 dark:border-emerald-900/20 rounded-2xl"></div>
                                <div class="h-28 bg-blue-50 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-900/20 rounded-2xl"></div>
                                <div class="h-28 bg-amber-50 dark:bg-amber-900/10 border border-amber-100 dark:border-amber-900/20 rounded-2xl hidden sm:block"></div>
                            </div>

                            <div class="flex-1 bg-white dark:bg-[#1C1C1A] border border-gray-100 dark:border-gray-800 rounded-2xl shadow-sm mt-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Features / Services Section --}}
        <section id="servicios" class="py-24 bg-gray-50/50 dark:bg-[#0c0c0c] relative border-t border-gray-100 dark:border-gray-800/50">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-primary-600 dark:text-primary-400 font-bold tracking-widest uppercase text-sm mb-3">La Suite Definitiva</h2>
                    <h3 class="font-display font-bold text-3xl sm:text-4xl text-gray-900 dark:text-white leading-tight">Soluciones diseñadas para quienes organizan experiencias memorables.</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    {{-- Service 1 --}}
                    <div class="premium-card p-8 group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-transparent hover:border-primary-200 dark:hover:border-primary-800/50">
                        <div class="w-14 h-14 bg-gradient-to-br from-indigo-100 to-indigo-50 dark:from-indigo-900/40 dark:to-indigo-900/10 rounded-2xl flex items-center justify-center text-indigo-600 mb-6 group-hover:scale-110 transition-transform shadow-inner">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                        <h4 class="text-xl font-display font-bold text-gray-900 dark:text-white mb-3">Cotizaciones Potentes</h4>
                        <p class="text-gray-500 dark:text-gray-400 leading-relaxed font-medium">Genera presupuestos detallados en segundos con cálculo en tiempo real, múltiples items y opciones claras para presentar al cliente.</p>
                    </div>

                    {{-- Service 2 --}}
                    <div class="premium-card p-8 group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-transparent hover:border-emerald-200 dark:hover:border-emerald-800/50">
                        <div class="w-14 h-14 bg-gradient-to-br from-emerald-100 to-emerald-50 dark:from-emerald-900/40 dark:to-emerald-900/10 rounded-2xl flex items-center justify-center text-emerald-600 mb-6 group-hover:scale-110 transition-transform shadow-inner">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <h4 class="text-xl font-display font-bold text-gray-900 dark:text-white mb-3">Transporte Inteligente</h4>
                        <p class="text-gray-500 dark:text-gray-400 leading-relaxed font-medium">Integra Google Maps para calcular exactamente los kilómetros y aplica automáticamente el costo ajustado por viaje de tus envíos.</p>
                    </div>

                    {{-- Service 3 --}}
                    <div class="premium-card p-8 group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-transparent hover:border-amber-200 dark:hover:border-amber-800/50">
                        <div class="w-14 h-14 bg-gradient-to-br from-amber-100 to-amber-50 dark:from-amber-900/40 dark:to-amber-900/10 rounded-2xl flex items-center justify-center text-amber-600 mb-6 group-hover:scale-110 transition-transform shadow-inner">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h4 class="text-xl font-display font-bold text-gray-900 dark:text-white mb-3">Logística Perfecta</h4>
                        <p class="text-gray-500 dark:text-gray-400 leading-relaxed font-medium">Una agenda diaria pensada y diseñada de cero para el staff en calle. Fechas, destinos, números de WhatsApp y listados de items listos para usar.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Call To Action Footer --}}
        <section class="max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-32 relative text-center">
            <div class="absolute inset-0 bg-gradient-to-b from-primary-50/50 to-white dark:from-[#0f1115] dark:to-[#080808] -z-10 rounded-3xl opacity-50"></div>
            
            <h2 class="font-display font-bold text-3xl md:text-5xl text-gray-900 dark:text-white mb-6">Listo para agilizar la producción de tus eventos?</h2>
            <p class="text-gray-500 dark:text-gray-400 mb-10 text-lg max-w-xl mx-auto">Únete a cientos de empresas que ya optimizaron la forma en que trabajan de cara al cliente y en equipo.</p>
            
            <a href="{{ route('register') ?? route('login') }}" class="btn-primary px-10 py-4 text-base font-bold shadow-xl shadow-primary-500/30 active:scale-95 inline-flex items-center group">
                Empieza tu Prueba Hoy
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </section>

    </main>

    {{-- Footer --}}
    <footer class="border-t border-gray-100 dark:border-gray-800/80 bg-white/50 dark:bg-black/50 backdrop-blur-sm z-20 py-8 px-6 text-center">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 bg-gradient-to-br from-primary-500 to-indigo-600 rounded flex justify-center items-center shadow-lg">
                    <span class="text-white font-display font-bold text-[10px] leading-none">M</span>
                </div>
                <span class="font-display font-bold text-sm tracking-tighter text-gray-900 dark:text-white">misino</span>
            </div>
            
            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                &copy; {{ date('Y') }} Misino. Todos los derechos reservados.
            </p>
        </div>
    </footer>
</body>
</html>
