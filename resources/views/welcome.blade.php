<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Misino - Creando Momentos Inolvidables</title>
    
    <meta name="theme-color" content="#FAF7F2">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FAF7F2; color: #433E3A; }
        .font-display { font-family: 'Outfit', sans-serif; }
        
        /* Lively Nordic Palette */
        .text-nordic-dark { color: #2E2A27; }
        .text-accent { color: #E88D67; } /* Warm terracotta/peach for party vibes */
        .bg-accent { background-color: #E88D67; }
        .bg-sage-light { background-color: #E3E9DF; } /* Soft Nordic Sage */

        /* Rounded pebble corners */
        .pebble-rounded { border-radius: 2rem; }
        
        /* Swiper Fixes */
        .swiper-pagination { position: relative !important; margin-top: 3rem !important; }
        .swiper-pagination-bullet { background: #DBCDBB; opacity: 1; transition: all 0.4s ease; width: 8px; height: 8px; border-radius: 50%; }
        .swiper-pagination-bullet-active { background: #E88D67 !important; transform: scale(1.5); }

        /* Floating WP */
        .wa-float {
            position: fixed; width: 55px; height: 55px; bottom: 30px; right: 30px;
            background-color: #FFF; color: #E88D67; box-shadow: 0 10px 30px rgba(232,141,103,0.15); border: 2px solid #E88D67; border-radius: 2rem; text-align: center;
            font-size: 26px; z-index: 100; transition: transform 0.3s ease; display: flex; align-items: center; justify-content: center;
        }
        .wa-float:hover { background-color: #E88D67; color: #FFF; transform: translateY(-4px); border-radius: 50%; }

        /* Subtle Party Sparkle */
        .sparkle { position: absolute; color: #E88D67; opacity: 0.6; animation: rotateSlow 6s linear infinite; }
        @keyframes rotateSlow { 100% { transform: rotate(360deg); } }

        .hide-scrollbar::-webkit-scrollbar { display: none; }
        
        /* Smooth Entrance */
        .fade-in-up { animation: fadeInUp 0.8s ease forwards; opacity: 0; transform: translateY(20px); }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="selection:bg-[#E88D67]/20 selection:text-[#E88D67] overflow-x-hidden">

    {{-- Header Liviano y Feliz --}}
    <header class="w-full relative z-40 py-6 px-6 lg:px-12 flex justify-between items-center bg-[#FAF7F2]">
        <div class="flex items-center gap-3">
            <img src="{{ asset('img/logo-misino.png') }}" alt="Misino" class="h-10 w-auto object-contain drop-shadow-sm">
        </div>
        <nav class="hidden md:flex items-center gap-10">
            <a href="#servicios" class="text-sm font-semibold text-gray-500 hover:text-accent transition-colors">Servicios</a>
            <a href="#galeria" class="text-sm font-semibold text-gray-500 hover:text-accent transition-colors">Celebraciones</a>
            <a href="#testimonios" class="text-sm font-semibold text-gray-500 hover:text-accent transition-colors">Clientes</a>
        </nav>
        <div class="hidden md:block">
             <a href="https://wa.me/5493517482565" target="_blank" class="px-6 py-2.5 bg-accent text-white pebble-rounded text-sm font-bold shadow-md shadow-[#E88D67]/20 hover:scale-105 transition-transform">
                Consultar
            </a>
        </div>
    </header>

    <main>
        {{-- Hero: Nordic Party Life --}}
        <section class="max-w-[85rem] mx-auto px-6 lg:px-12 pt-12 pb-24 flex flex-col lg:flex-row items-center justify-between gap-16 min-h-[80vh] relative">
            
            {{-- Sparkles Vivos --}}
            <svg class="sparkle top-[10%] left-[45%] w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0l2.5 8.5L23 11l-8.5 2.5L12 22l-2.5-8.5L1 11l8.5-2.5z"/></svg>
            <svg class="sparkle bottom-[20%] right-[10%] w-4 h-4 text-[#A5B6A0]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0l2.5 8.5L23 11l-8.5 2.5L12 22l-2.5-8.5L1 11l8.5-2.5z"/></svg>

            <div class="w-full lg:w-1/2 text-center lg:text-left relative z-10">
                <span class="inline-block px-4 py-1.5 pebble-rounded bg-sage-light text-[#63765e] font-bold text-xs uppercase tracking-widest mb-8 fade-in-up">
                    Diseño & Mobiliario
                </span>
                
                <h1 class="font-display font-extrabold text-5xl md:text-6xl lg:text-7xl leading-[1.05] text-nordic-dark mb-6 fade-in-up delay-100">
                    Hagamos que sea <br>
                    <span class="text-accent">inolvidable.</span>
                </h1>
                
                <p class="text-gray-500 text-lg md:text-xl font-medium max-w-md mx-auto lg:mx-0 mb-10 leading-relaxed fade-in-up delay-200">
                    Ambientaciones escandinavas, fondos hermosos y mobiliario premium para fiestas llenas de vida.
                </p>
                
                <div class="fade-in-up delay-200">
                    <a href="https://wa.me/5493517482565" target="_blank" class="inline-flex items-center justify-center px-8 py-4 bg-accent text-white font-bold text-lg pebble-rounded shadow-xl shadow-[#E88D67]/30 hover:-translate-y-1 hover:shadow-[#E88D67]/40 transition-all gap-2">
                        Reservar mi Fecha 
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
            
            <div class="w-full lg:w-1/2 relative h-[450px] lg:h-[650px] fade-in-up delay-100">
                <div class="absolute -top-10 -right-10 w-96 h-96 bg-sage-light rounded-full blur-[80px] opacity-60"></div>
                
                {{-- Vibrant Soft Images Grid --}}
                <div class="w-full h-full relative">
                    <img src="{{ asset('img/ambient.jpg') }}" class="absolute top-0 right-0 w-[80%] h-[75%] object-cover pebble-rounded shadow-2xl z-10 transform hover:scale-105 transition-transform duration-700">
                    <img src="{{ asset('img/candy.jpg') }}" class="absolute bottom-4 left-0 w-[55%] h-[50%] object-cover pebble-rounded shadow-xl border-4 border-[#FAF7F2] z-20 transform hover:-translate-y-2 transition-transform duration-700">
                </div>
            </div>
        </section>

        {{-- Servicios Lively --}}
        <section id="servicios" class="py-24 bg-white">
            <div class="max-w-[85rem] mx-auto px-6 lg:px-12">
                <div class="text-center mb-20 relative">
                    <svg class="sparkle -top-10 left-1/4 w-3 h-3 text-[#E88D67]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0l2.5 8.5L23 11l-8.5 2.5L12 22l-2.5-8.5L1 11l8.5-2.5z"/></svg>
                    <h2 class="font-display font-extrabold text-4xl lg:text-5xl text-nordic-dark mb-4">¿Cómo decoramos <br> tu momento?</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    {{-- Item 1 --}}
                    <div class="bg-[#FAF7F2] p-10 pebble-rounded group hover:shadow-lg transition-shadow duration-300">
                        <div class="w-14 h-14 bg-white pebble-rounded shadow-sm flex items-center justify-center mb-8 group-hover:scale-110 transition-transform text-[#E88D67]">
                             <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <h4 class="font-display font-bold text-2xl text-nordic-dark mb-3">Mesas y Mobiliario</h4>
                        <p class="text-gray-500 font-medium leading-relaxed text-sm">
                            Cilindros, alzadas, carritos y estructuras versátiles. Líneas muy limpias que dejarán que tu repostería respire y destaque.
                        </p>
                    </div>

                    {{-- Item 2 --}}
                    <div class="bg-[#FAF7F2] p-10 pebble-rounded group hover:shadow-lg transition-shadow duration-300">
                        <div class="w-14 h-14 bg-white pebble-rounded shadow-sm flex items-center justify-center mb-8 group-hover:scale-110 transition-transform text-[#A5B6A0]">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <h4 class="font-display font-bold text-2xl text-nordic-dark mb-3">Fondos Festivos</h4>
                        <p class="text-gray-500 font-medium leading-relaxed text-sm">
                            Telones, arcos decorativos y escenografías pensadas para ser el centro de una fiesta llena de fotografías preciosas.
                        </p>
                    </div>

                    {{-- Item 3 --}}
                    <div class="bg-[#FAF7F2] p-10 pebble-rounded group hover:shadow-lg transition-shadow duration-300">
                        <div class="w-14 h-14 bg-white pebble-rounded shadow-sm flex items-center justify-center mb-8 group-hover:scale-110 transition-transform text-[#E88D67]">
                             <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                        </div>
                        <h4 class="font-display font-bold text-2xl text-nordic-dark mb-3">Logística Mágica</h4>
                        <p class="text-gray-500 font-medium leading-relaxed text-sm">
                            Tranquilidad 100%. Llevamos las cosas, montamos y cuando termina tu festejo, lo retiramos con exactitud de reloj suizo.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Galería Lively --}}
        <section id="galeria" class="py-24 bg-[#E3E9DF]/30">
            <div class="max-w-[100rem] mx-auto px-6 lg:px-12">
                <div class="flex flex-col md:flex-row justify-between items-end mb-16 px-4">
                    <h2 class="font-display font-extrabold text-4xl lg:text-5xl text-nordic-dark">Fiestas de <br> nuestros clientes</h2>
                </div>
                
                <div class="swiper galeriaSwiper overflow-hidden py-4">
                    <div class="swiper-wrapper">
                        @foreach(range(1, 10) as $i)
                        <div class="swiper-slide px-2">
                            {{-- Vibrant images, soft curves! --}}
                            <div class="relative w-full aspect-[4/5] pebble-rounded overflow-hidden group shadow-md shadow-gray-200">
                                <img src="{{ asset('img/gallery/' . $i . '.jpg') }}" loading="lazy" class="w-full h-full object-cover transform group-hover:scale-105 transition-all duration-[1s]">
                                <div class="absolute inset-x-0 bottom-0 p-8 bg-gradient-to-t from-black/50 to-transparent"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        {{-- Testimonios (Warm & Happy) --}}
        <section id="testimonios" class="py-32 bg-white">
            <div class="max-w-[95rem] mx-auto px-6 lg:px-12 text-center">
                <h2 class="font-display font-extrabold text-4xl lg:text-5xl text-nordic-dark mb-16">Ellos lo respaldan</h2>
                
                <div class="swiper testimoSwiper">
                    <div class="swiper-wrapper py-4">
                        @php
                        $reviews = [
                            ['name' => 'Carolina M.', 'event' => 'Cumpleaños 15', 'text' => 'El Candy Bar quedó súper vibrante pero limpio. Los colores destacaron muchísimo y el montaje impecable.'],
                            ['name' => 'Florencia T.', 'event' => 'Bautismo', 'text' => 'Todo el mundo quedó enamorado del diseño del mobiliario. Cumplió perfectamente el balance entre sutil y festivo.'],
                            ['name' => 'Valeria S.', 'event' => 'Fiesta Infantil', 'text' => 'Me resolvieron todo. Los cilindros le dieron un look re moderno y dinámico al cumple de mi nena. Geniales.'],
                            ['name' => 'Sabrina L.', 'event' => 'Comunión', 'text' => 'El diseño se sintió súper cálido. Las bases y los arreglos geométricos encajaron perfecto con lo que buscábamos. A todos les encantó.'],
                            ['name' => 'Mariana P.', 'event' => 'Baby Shower', 'text' => 'Impecable el mobiliario. Llegaron a tiempo, armaron la escenografía muy prolija y a la hora de retirar fueron súper cordiales.'],
                            ['name' => 'Estefanía R.', 'event' => 'Cumpleaños 50', 'text' => 'No sabía cómo decorar un salón tan grande y ellos lo resolvieron con estructuras limpias que se robaron las miradas de los invitados.'],
                            ['name' => 'Lucía F.', 'event' => 'Evento Privado', 'text' => 'Puntualidad, diseño y muy buen trato general. Es la segunda vez que contrato el Candy Bar y siempre es un verdadero placer.']
                        ];
                        @endphp
                        @foreach($reviews as $review)
                        <div class="swiper-slide px-4">
                            <div class="bg-[#FAF7F2] pebble-rounded p-10 lg:p-14 h-full relative">
                                <svg class="w-10 h-10 text-accent mb-6 mx-auto opacity-50" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                                
                                <p class="text-gray-600 font-medium leading-relaxed mb-8 text-lg">
                                    "{{ $review['text'] }}"
                                </p>
                                
                                <div>
                                    <p class="font-display font-bold text-nordic-dark text-lg">{{ $review['name'] }}</p>
                                    <p class="font-medium text-accent text-sm mt-1">{{ $review['event'] }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        {{-- Footer CTA High Contrast --}}
        <section id="contacto" class="py-24 bg-accent text-center px-6">
            <div class="max-w-2xl mx-auto">
                <svg class="sparkle -top-10 right-0 w-8 h-8 text-white opacity-40 mx-auto mb-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0l2.5 8.5L23 11l-8.5 2.5L12 22l-2.5-8.5L1 11l8.5-2.5z"/></svg>
                <h2 class="font-display font-extrabold text-4xl md:text-6xl text-white mb-6">Empecemos a planear.</h2>
                <p class="text-white/90 font-medium mb-12 text-lg">Nos escribes, nos cuentas tu idea y coordinamos la estructura para que tu evento sea inolvidable.</p>
                <a href="https://wa.me/5493517482565" target="_blank" class="inline-block bg-white text-accent px-10 py-5 text-sm font-bold pebble-rounded shadow-xl shadow-black/10 hover:-translate-y-1 transition-all">
                    Escribir por WhatsApp
                </a>
            </div>
        </section>
    </main>

    {{-- Minimal Footer --}}
    <footer class="py-10 bg-[#FAF7F2] text-center">
        <p class="text-[11px] font-bold text-gray-400">
            &copy; {{ date('Y') }} Misino. Ambientes para celebrar.
        </p>
    </footer>

    {{-- WhatsApp flotante --}}
    <a href="https://wa.me/5493517482565" class="wa-float" target="_blank">
        <svg fill="currentColor" class="w-7 h-7" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 .004 5.411.002 12.048c0 2.12.54 4.19 1.563 6.04L0 24l6.082-1.594a11.819 11.819 0 005.96 1.604h.005c6.636 0 12.048-5.411 12.051-12.049a11.829 11.829 0 00-3.626-8.53z"/></svg>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swiper1 = new Swiper('.galeriaSwiper', {
                slidesPerView: 1.2,
                spaceBetween: 24,
                grabCursor: true,
                loop: true,
                centeredSlides: true,
                pagination: { el: ".galeriaSwiper .swiper-pagination", clickable: true },
                breakpoints: {
                    640: { slidesPerView: 2.2 },
                    1024: { slidesPerView: 4.5, spaceBetween: 40 }
                }
            });

            const swiper2 = new Swiper('.testimoSwiper', {
                slidesPerView: 1.1,
                spaceBetween: 20,
                grabCursor: true,
                pagination: { el: ".testimoSwiper .swiper-pagination", clickable: true },
                breakpoints: {
                    640: { slidesPerView: 2.2, spaceBetween: 24 },
                    1024: { slidesPerView: 3.5, spaceBetween: 30 }
                }
            });
        });
    </script>
</body>
</html>
