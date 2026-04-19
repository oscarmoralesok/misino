<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Misino - Creando Momentos Inolvidables</title>
    
    <!-- Meta Theme -->
    <meta name="theme-color" content="#ffffff" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#0a0a0a" media="(prefers-color-scheme: dark)">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;700;800&display=swap" rel="stylesheet">

    <!-- Vite Custom CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        /* Animaciones para la Landing */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        /* Personalización de Paginación Swiper */
        .swiper-pagination {
            position: relative !important;
            margin-top: 2.5rem !important;
            bottom: auto !important;
        }
        .swiper-pagination-bullet { background: #d1d5db; opacity: 1; transition: all 0.3s ease; }
        .dark .swiper-pagination-bullet { background: #4b5563; }
        .swiper-pagination-bullet-active { background: #f9aa2b !important; width: 24px; border-radius: 8px; }

        .float { animation: float 6s ease-in-out infinite; }
        
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
            opacity: 0.2; 
        }

        /* Botón de WhatsApp flotante */
        .wa-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 30px;
            right: 30px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }
        .my-float {
            margin-top: 15px;
        }
        .dark .wa-float { box-shadow: 0 4px 10px rgba(0,0,0,0.3); }

        /* Esconder scrollbar del carrusel pero mantener scroll */
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-white dark:bg-[#080808] dark:text-gray-200 min-h-screen flex flex-col relative overflow-x-hidden selection:bg-[#f9aa2b]/30 selection:text-[#7149c9] dark:selection:text-[#f9aa2b]">

    {{-- Background Blobs for Glassmorphism Effect --}}
    <div class="hero-blob bg-[#f9aa2b] w-[500px] h-[500px] -top-32 -left-32 animate-float"></div>
    <div class="hero-blob bg-[#7149c9] w-[400px] h-[400px] top-64 -right-16 animate-float-delayed"></div>
    <div class="hero-blob bg-[#05cca6] w-[600px] h-[600px] top-[40rem] left-1/4 opacity-40 animate-float" style="animation-duration: 10s;"></div>

    {{-- Header / Navbar (Sin Login) --}}
    <header class="relative z-50 py-6 px-6 lg:px-12 flex justify-between items-center backdrop-blur-md bg-white/70 dark:bg-[#080808]/70 border-b border-gray-100/50 dark:border-gray-800/50 sticky top-0 w-full">
        <div class="flex items-center gap-3">
            <img src="{{ asset('img/logo-misino.png') }}" alt="Misino Eventos Logo" class="h-10 w-auto object-contain">
        </div>

        <nav class="hidden md:flex items-center gap-8 font-medium">
            <a href="#servicios" class="text-sm text-gray-600 dark:text-gray-300 hover:text-[#f9aa2b] transition-colors uppercase tracking-widest">
                Nuestros Servicios
            </a>
            <a href="#contacto" class="text-sm text-gray-600 dark:text-gray-300 hover:text-[#f9aa2b] transition-colors uppercase tracking-widest">
                Contacto
            </a>
            <a href="https://wa.me/5493517482565" target="_blank" class="px-6 py-2.5 bg-[#f9aa2b] text-white rounded-xl shadow-md shadow-[#f9aa2b]/30 hover:bg-[#e09927] hover:shadow-lg hover:shadow-[#f9aa2b]/40 transition-all font-bold text-xs uppercase tracking-widest active:scale-95">
                Hablar por WhatsApp
            </a>
        </nav>
    </header>

    {{-- Main Content --}}
    <main class="flex-grow relative z-10 flex flex-col justify-center">

        {{-- Hero Section --}}
        <section class="max-w-7xl mx-auto px-6 lg:px-8 pt-20 pb-24 lg:pt-32 lg:pb-32 text-center flex flex-col items-center">
            <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest bg-[#f9aa2b]/10 text-[#f9aa2b] dark:bg-[#f9aa2b]/20 dark:text-[#f9aa2b] border border-[#f9aa2b]/30 dark:border-[#f9aa2b]/40 mb-8 animate-fade-in shadow-sm">
                Diseño, Ambientación y Mobiliario
            </span>

            <h1 class="font-display font-extrabold tracking-tight text-5xl sm:text-6xl lg:text-7xl mb-6 lg:mb-8 max-w-4xl mx-auto leading-[1.1] animate-translate-up" style="animation-delay: 50ms;">
                Creando el <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f9aa2b] to-[#7149c9]">Ambiente Perfecto</span> para tu Evento
            </h1>

            <p class="text-lg sm:text-xl text-gray-500 dark:text-gray-400 mb-10 max-w-2xl mx-auto leading-relaxed animate-translate-up font-medium" style="animation-delay: 100ms;">
                Desde el alquiler del Candy Bar más soñado hasta la decoración integral de tu fiesta. Nos encargamos de todo, incluso de llevarlo hasta donde estés.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 items-center animate-translate-up" style="animation-delay: 150ms;">
                <a href="https://wa.me/5493517482565?text=Hola!%20Me%20gustar%C3%ADa%20solicitar%20un%20presupuesto." target="_blank" class="bg-[#f9aa2b] hover:bg-[#e09927] text-white rounded-2xl px-8 py-4 text-base font-bold shadow-xl shadow-[#f9aa2b]/30 active:scale-95 flex items-center group w-full sm:w-auto justify-center transition-all">
                    Solicitar Presupuesto
                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                <a href="#servicios" class="px-8 py-4 text-base font-bold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white uppercase tracking-widest transition-colors w-full sm:w-auto text-center hover:bg-gray-50 dark:hover:bg-gray-800/50 rounded-2xl">
                    Ver Opciones
                </a>
            </div>

            {{-- Decorative Grid / Images (Abstract) --}}
            <div class="mt-20 w-full max-w-5xl relative animate-translate-up" style="animation-delay: 200ms;">
                <div class="absolute -inset-1 bg-gradient-to-r from-[#f9aa2b] to-[#7149c9] rounded-[2rem] blur-xl opacity-30 dark:opacity-40 shadow-2xl"></div>
                <div class="relative bg-white/60 dark:bg-[#121212]/80 backdrop-blur-xl border border-gray-100 dark:border-gray-800 rounded-[2rem] shadow-xl p-4 sm:p-6 overflow-hidden">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 aspect-video overflow-hidden rounded-xl">
                        <div class="col-span-2 md:col-span-2 row-span-2 rounded-xl flex items-center justify-center bg-cover bg-center border border-[#f9aa2b]/50 relative group shadow-sm transition-transform hover:scale-[1.02] duration-300" style="background-image: url('{{ asset('img/ambient.jpg') }}');">
                            {{-- Placeholder for main image --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent rounded-xl flex items-end p-6">
                                <h3 class="text-white font-display font-bold text-2xl tracking-widest uppercase">Ambientación</h3>
                            </div>
                        </div>
                        <div class="col-span-1 md:col-span-2 rounded-xl flex items-center justify-center bg-cover bg-center border border-[#7149c9]/50 relative group shadow-sm transition-transform hover:scale-[1.02] duration-300" style="background-image: url('{{ asset('img/candy.jpg') }}');">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent rounded-xl flex items-end p-4">
                                <h3 class="text-white font-display font-bold text-sm tracking-widest uppercase">Candy Bars</h3>
                            </div>
                        </div>
                        <div class="rounded-xl flex items-center justify-center bg-cover bg-center border border-[#05cca6]/50 relative group shadow-sm transition-transform hover:scale-[1.02] duration-300" style="background-image: url('{{ asset('img/structure.jpeg') }}');">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent rounded-xl flex items-end p-4">
                                <h3 class="text-white font-display font-bold text-xs tracking-widest uppercase">Estructuras</h3>
                            </div>
                        </div>
                        <div class="rounded-xl flex items-center justify-center bg-cover bg-center border border-[#f9aa2b]/50 relative group shadow-sm transition-transform hover:scale-[1.02] duration-300" style="background-image: url('{{ asset('img/accesories.jpeg') }}');">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent rounded-xl flex items-end p-4">
                                <h3 class="text-white font-display font-bold text-xs tracking-widest uppercase">Accesorios</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Features / Services Section --}}
        <section id="servicios" class="py-24 bg-gray-50/50 dark:bg-[#0c0c0c] relative border-t border-gray-100 dark:border-gray-800/50">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-[#7149c9] font-bold tracking-widest uppercase text-sm mb-3">Qué Hacemos</h2>
                    <h3 class="font-display font-bold text-3xl sm:text-4xl text-gray-900 dark:text-white leading-tight">Todo lo que necesitas para tu festejo.</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    {{-- Service 1 --}}
                    <div class="bg-white dark:bg-[#161615] rounded-3xl p-8 group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-gray-800 hover:border-[#f9aa2b] dark:hover:border-[#f9aa2b]/50 shadow-[0_8px_30px_rgb(0,0,0,0.04)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.2)]">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#f9aa2b]/20 to-[#f9aa2b]/10 rounded-2xl flex items-center justify-center text-[#f9aa2b] mb-6 group-hover:scale-110 transition-transform shadow-inner">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <h4 class="text-xl font-display font-bold text-gray-900 dark:text-white mb-3">Mobiliario Candy Bar</h4>
                        <p class="text-gray-500 dark:text-gray-400 leading-relaxed font-medium">Contamos con una amplia variedad de mesas, alzadas, carritos y estructuras modernas para destacar la mesa dulce de tu evento.</p>
                    </div>

                    {{-- Service 2 --}}
                    <div class="bg-white dark:bg-[#161615] rounded-3xl p-8 group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-gray-800 hover:border-[#7149c9] dark:hover:border-[#7149c9]/50 shadow-[0_8px_30px_rgb(0,0,0,0.04)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.2)]">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#7149c9]/20 to-[#7149c9]/10 rounded-2xl flex items-center justify-center text-[#7149c9] mb-6 group-hover:scale-110 transition-transform shadow-inner">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <h4 class="text-xl font-display font-bold text-gray-900 dark:text-white mb-3">Decoración y Ambientación</h4>
                        <p class="text-gray-500 dark:text-gray-400 leading-relaxed font-medium">Buscamos el concepto ideal para tu fiesta y lo hacemos realidad. Fondos, arcos orgánicos, telones, globología y mucho detalle.</p>
                    </div>

                    {{-- Service 3 --}}
                    <div class="bg-white dark:bg-[#161615] rounded-3xl p-8 group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-gray-800 hover:border-[#05cca6] dark:hover:border-[#05cca6]/50 shadow-[0_8px_30px_rgb(0,0,0,0.04)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.2)]">
                        <div class="w-14 h-14 bg-gradient-to-br from-[#05cca6]/20 to-[#05cca6]/10 rounded-2xl flex items-center justify-center text-[#05cca6] mb-6 group-hover:scale-110 transition-transform shadow-inner">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                        </div>
                        <h4 class="text-xl font-display font-bold text-gray-900 dark:text-white mb-3">Nos encargamos del Envío</h4>
                        <p class="text-gray-500 dark:text-gray-400 leading-relaxed font-medium">Relájate en tu gran día. Llevamos y montamos la estructura en el salón o lugar del evento, en el horario coordinado. Logística propia resolutiva.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Galería de Trabajos --}}
        <section id="galeria" class="py-24 relative border-t border-gray-100 dark:border-gray-800/50 bg-white dark:bg-[#080808]">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-[#05cca6] font-bold tracking-widest uppercase text-sm mb-3">Nuestros Trabajos</h2>
                    <h3 class="font-display font-bold text-3xl sm:text-4xl text-gray-900 dark:text-white leading-tight">Momentos irrepetibles.</h3>
                </div>
                
                <div class="swiper galeriaSwiper overflow-visible pb-12">
                    <div class="swiper-wrapper pb-2">
                        @foreach(range(1, 16) as $i)
                        <div class="swiper-slide relative group rounded-2xl overflow-hidden shadow-sm shadow-[#05cca6]/10">
                            <img src="{{ asset('img/gallery/' . $i . '.jpg') }}" alt="Mobiliario Misino Evento {{ $i }}" class="w-full h-[300px] sm:h-[400px] object-cover transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                                <span class="text-white font-bold tracking-wider uppercase text-sm">Nuestros Trabajos</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Paginación -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        {{-- Testimonios --}}
        <section id="testimonios" class="py-24 bg-gray-50/50 dark:bg-[#0c0c0c] relative border-t border-gray-100 dark:border-gray-800/50 overflow-hidden">
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-[#f9aa2b]/5 blur-3xl shadow-sm hover:shadow-2xl"></div>
            <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-[#7149c9] font-bold tracking-widest uppercase text-sm mb-3">Lo que dicen de nosotros</h2>
                    <h3 class="font-display font-bold text-3xl sm:text-4xl text-gray-900 dark:text-white leading-tight">Clientes felices y eventos soñados.</h3>
                </div>
                <div class="swiper testimoSwiper overflow-visible pt-4 pb-12">
                    <div class="swiper-wrapper pb-2">
                        @php
                        $reviews = [
                            ['name' => 'Carolina M.', 'event' => 'Cumpleaños 15', 'text' => 'El Candy Bar quedó tal cual lo soñamos. Súper puntuales con el horario de armado en el salón y la estructura estaba impecable. Recomendadísimos.'],
                            ['name' => 'Florencia T.', 'event' => 'Bautismo', 'text' => 'Excelente presentación del mobiliario, todos nos preguntaron de dónde era. Ya los estamos recomendando para el bautismo de mi sobrino.'],
                            ['name' => 'Valeria S.', 'event' => 'Fiesta Infantil', 'text' => 'Me resolvieron todo. Los cilindros y las mesas cilíndricas le dieron un toque súper moderno al cumple de 5 de mi nena. Son unos genios.'],
                            ['name' => 'Gustavo R.', 'event' => 'Primer Añito', 'text' => 'La calidad de las estructuras es espectacular. Montaron el fondo circular y las luces LED sin molestar a nadie. Muy profesionales.'],
                            ['name' => 'Sabrina L.', 'event' => 'Comunión', 'text' => 'Es la segunda vez que les alquilo bases para mi Candy Bar. Tienen muchísima variedad y los precios son re accesibles.'],
                            ['name' => 'Mariana P.', 'event' => 'Baby Shower', 'text' => 'Impecable el mobiliario. Llegaron a tiempo, armaron la escenografía muy prolija y a la hora de retirar fueron súper cordiales.']
                        ];
                        @endphp
                        @foreach($reviews as $review)
                        <div class="swiper-slide bg-white/80 dark:bg-[#161615]/80 backdrop-blur-sm rounded-3xl p-8 border border-gray-100 dark:border-gray-800 shadow-sm relative hover:-translate-y-2 transition-transform duration-300 h-auto flex flex-col justify-between">
                            <div class="flex text-[#f9aa2b] mb-4">
                                @for($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                @endfor
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 italic mb-6">"{{ $review['text'] }}"</p>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white text-sm">{{ $review['name'] }}</p>
                                <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">{{ $review['event'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Paginación -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        {{-- Call To Action Footer --}}
        <section id="contacto" class="max-w-7xl mx-auto px-6 lg:px-8 my-20 lg:my-32">
            <div class="relative text-center py-16 lg:py-24 px-6 lg:px-12 bg-gradient-to-br from-[#f9aa2b]/20 to-[#f9aa2b]/5 dark:from-[#f9aa2b]/10 dark:to-transparent border border-[#f9aa2b]/20 dark:border-[#f9aa2b]/10 rounded-[3rem] shadow-sm overflow-hidden">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-[#f9aa2b]/20 blur-3xl rounded-full pointer-events-none"></div>

            <h2 class="font-display font-bold text-3xl md:text-5xl text-gray-900 dark:text-white mb-6">¿Preparando tu próximo festejo?</h2>
            <p class="text-gray-500 dark:text-gray-400 mb-10 text-lg max-w-xl mx-auto">Cuéntanos sobre la fecha y temática y te pasaremos un presupuesto a medida con todo el mobiliario y la decoración que necesitas.</p>

            <a href="https://wa.me/5493517482565?text=Hola!%20Me%20encanta%20lo%20que%20hacen,%20quisiera%20consultar%20por%20sus%20servicios." target="_blank" class="bg-[#f9aa2b] hover:bg-[#e09927] text-white rounded-2xl px-10 py-4 text-base font-bold shadow-xl shadow-[#f9aa2b]/30 active:scale-95 inline-flex items-center group transition-all">
                Enviar un WhatsApp
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
            </div>
        </section>

    </main>

    {{-- Footer --}}
    <footer class="border-t border-gray-100 dark:border-gray-800/80 bg-white/50 dark:bg-black/50 backdrop-blur-sm z-20 py-8 px-6 text-center">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2">
                <img src="{{ asset('img/logo-misino.png') }}" alt="Misino Logo" class="h-6 w-auto object-contain">
            </div>
            
            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                &copy; {{ date('Y') }} Misino. Creando momentos.
            </p>
        </div>
    </footer>

    {{-- Floating WhatsApp Icon --}}
    <a href="https://wa.me/5493517482565" class="wa-float flex items-center justify-center hover:scale-110 transition-transform" target="_blank" aria-label="Hablar por WhatsApp">
        <svg fill="currentColor" class="w-8 h-8" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 .004 5.411.002 12.048c0 2.12.54 4.19 1.563 6.04L0 24l6.082-1.594a11.819 11.819 0 005.96 1.604h.005c6.636 0 12.048-5.411 12.051-12.049a11.829 11.829 0 00-3.626-8.53z"/>
        </svg>
    </a>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swiper1 = new Swiper('.galeriaSwiper', {
                slidesPerView: 1.2,
                spaceBetween: 16,
                grabCursor: true,
                loop: false,
                pagination: {
                    el: ".galeriaSwiper .swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    640: { slidesPerView: 2.2, spaceBetween: 24 },
                    1024: { slidesPerView: 4, spaceBetween: 24 }
                }
            });

            const swiper2 = new Swiper('.testimoSwiper', {
                slidesPerView: 1.1,
                spaceBetween: 16,
                grabCursor: true,
                loop: false,
                pagination: {
                    el: ".testimoSwiper .swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    640: { slidesPerView: 2, spaceBetween: 24 },
                    1024: { slidesPerView: 3, spaceBetween: 32 }
                }
            });
        });
    </script>
</body>
</html>
