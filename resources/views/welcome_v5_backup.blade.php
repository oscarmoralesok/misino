<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Misino - Creando Momentos Inolvidables</title>
    
    <meta name="theme-color" content="#F9FAFB">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F3F4F6; color: #111827; }
        .font-display { font-family: 'Outfit', sans-serif; letter-spacing: -0.03em; }

        /* Bento Box Layout */
        .bento-card {
            background-color: #FFF;
            border-radius: 2.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.02);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
        }
        .bento-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
        }

        /* Swiper Fixes */
        .swiper-pagination { position: relative !important; margin-top: 2rem !important; }
        .swiper-pagination-bullet { background: #D1D5DB; opacity: 1; transition: all 0.3s ease; width: 6px; height: 6px; border-radius: 50%; }
        .swiper-pagination-bullet-active { background: #111827 !important; width: 20px; border-radius: 4px; }

        /* Floating WP */
        .wa-float {
            position: fixed; width: 60px; height: 60px; bottom: 30px; right: 30px;
            background-color: #25d366; color: #FFF; border-radius: 50px; text-align: center;
            font-size: 30px; box-shadow: 0 10px 20px rgba(37,211,102,0.3); z-index: 100; transition: transform 0.3s ease;
        }

        .hide-scrollbar::-webkit-scrollbar { display: none; }
        
        .pulse-slow { animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: .7; } }
    </style>
</head>
<body class="selection:bg-gray-200 selection:text-gray-900">

    {{-- Minimal Sleek Header --}}
    <header class="w-full relative z-50 pt-8 pb-4 px-6 lg:px-12 flex justify-between items-center max-w-[96rem] mx-auto">
        <div class="flex flex-col">
            <img src="{{ asset('img/logo-misino.png') }}" alt="Misino" class="h-8 w-auto object-contain">
        </div>
        <nav class="hidden md:flex items-center gap-2 bg-white/60 backdrop-blur-xl px-4 py-2 rounded-full border border-gray-200/50 shadow-sm">
            <a href="#galeria" class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors rounded-full hover:bg-gray-100">Trabajos</a>
            <a href="#servicios" class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors rounded-full hover:bg-gray-100">Diseño</a>
            <a href="#opiniones" class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors rounded-full hover:bg-gray-100">Opiniones</a>
        </nav>
        <div class="flex">
            <a href="https://wa.me/5493517482565" target="_blank" class="px-6 py-3 bg-black text-white rounded-full text-sm font-medium hover:scale-105 transition-transform">
                Consultar Fecha
            </a>
        </div>
    </header>

    <main class="max-w-[96rem] mx-auto px-4 sm:px-6 lg:px-12 pb-24 pt-8">
        {{-- BENTO GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6 auto-rows-[minmax(180px,auto)]">
            
            {{-- HERO BENTO CELL (Takes up big top-left chunk) --}}
            <div class="bento-card col-span-1 md:col-span-4 lg:col-span-4 row-span-2 p-8 lg:p-14 flex flex-col justify-between bg-gradient-to-br from-white to-gray-50">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-orange-100/50 text-orange-600 font-medium text-xs mb-8 border border-orange-200/50">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 pulse-slow"></span> Activos para tu evento
                    </div>
                    <h1 class="font-display font-extrabold text-5xl sm:text-6xl lg:text-[5rem] leading-[0.95] text-gray-900 mb-6">
                        No imagines tu fiesta. <br>
                        <span class="text-gray-400">Vívela desde hoy.</span>
                    </h1>
                </div>
                <div class="flex flex-col sm:flex-row gap-8 items-end justify-between mt-12">
                    <p class="text-gray-500 text-lg font-medium max-w-sm leading-relaxed">
                        Ambientación inmersiva, candy bars milimétricos y logística puntual para deslumbrar a cada uno de tus invitados.
                    </p>
                    <a href="https://wa.me/5493517482565" target="_blank" class="w-full sm:w-auto px-8 py-5 bg-[#f9aa2b] text-white rounded-full text-base font-bold shadow-lg shadow-[#f9aa2b]/30 hover:scale-105 transition-all text-center">
                        Contáctanos
                    </a>
                </div>
            </div>

            {{-- GALLERY PREVIEW BENTO CELL (Top right) --}}
            <div id="galeria" class="bento-card col-span-1 md:col-span-2 lg:col-span-2 row-span-2 group">
                <img src="{{ asset('img/ambient.jpg') }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-[1.5s]">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-transparent to-transparent p-8 flex flex-col justify-end">
                    <p class="text-white/80 text-sm font-medium mb-1">Mobiliario & Estructuras</p>
                    <h3 class="font-display font-bold text-2xl text-white">Galería Exclusiva</h3>
                </div>
            </div>

            {{-- SERVICE 1: AMBIENTACION (Middle left block) --}}
            <div id="servicios" class="bento-card col-span-1 md:col-span-2 lg:col-span-2 row-span-1 p-8 bg-[#111827] text-white">
                <div class="h-10 w-10 rounded-2xl bg-white/10 flex items-center justify-center mb-16 backdrop-blur-md">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                </div>
                <h4 class="font-display font-bold text-2xl mb-2">Montaje Candy Bar</h4>
                <p class="text-gray-400 font-medium text-sm">Disposición de bases torneadas, fondos y mesas impecables.</p>
            </div>

            {{-- MINI GALLERY / SWIPER (Middle span-4 spanning horizontal) --}}
            <div class="bento-card col-span-1 md:col-span-4 lg:col-span-4 row-span-1 bg-[#f9aa2b] relative overflow-hidden group p-0">
                <!-- A thin horizontal carousel -->
                <div class="swiper bentoSwiper h-full">
                    <div class="swiper-wrapper">
                        @foreach(range(1, 10) as $i)
                        <div class="swiper-slide h-full w-1/3">
                            <img src="{{ asset('img/gallery/' . $i . '.jpg') }}" loading="lazy" class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="absolute inset-y-0 left-0 w-32 bg-gradient-to-r from-[#f9aa2b] to-transparent z-10 pointer-events-none"></div>
                <div class="absolute top-8 left-8 z-20">
                     <span class="bg-white/90 backdrop-blur-sm text-[#f9aa2b] px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest">El Proceso</span>
                </div>
            </div>

            {{-- SERVICE 2: DETALLES (Bottom left) --}}
            <div class="bento-card col-span-1 md:col-span-3 lg:col-span-3 row-span-1 p-8 bg-[#05cca6]/10 border border-[#05cca6]/20">
                <h4 class="font-display font-bold text-3xl text-gray-900 mb-4">Logística propia y puntual</h4>
                <p class="text-gray-600 font-medium max-w-sm mb-8">Un estrés menos. Transportamos cada mueble, lo posicionamos antes de que arranque todo y lo retiramos cuando termine la magia.</p>
                <div class="inline-flex h-12 w-12 rounded-full bg-[#05cca6] items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
            </div>

            {{-- METRICS / TESTIMONIAL SNAPSHOT (Bottom right) --}}
            <div id="opiniones" class="bento-card col-span-1 md:col-span-3 lg:col-span-3 row-span-1 p-8 flex flex-col justify-between">
                <div>
                     <div class="flex -space-x-4 mb-4">
                        <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-200 flex justify-center items-center font-bold text-xs">C</div>
                        <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-300 flex justify-center items-center font-bold text-xs">F</div>
                        <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-400 flex justify-center items-center font-bold text-xs">V</div>
                        <div class="w-10 h-10 rounded-full border-2 border-white bg-[#7149c9] text-white flex justify-center items-center font-bold text-xs">+</div>
                    </div>
                    <div class="flex text-[#f9aa2b] mb-2">
                        @for($i=0; $i<5; $i++)
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                    </div>
                </div>
                <div>
                     <p class="font-display font-medium text-xl md:text-2xl text-gray-900 leading-tight">
                        "El Candy Bar quedó tal cual lo soñamos. Súper puntuales y la estructura estaba impecable."
                     </p>
                     <p class="text-sm text-gray-400 font-medium mt-4">— Carolina M. · Cumpleaños 15</p>
                </div>
            </div>
            
            {{-- BOTTOM FULL SPAN CTA --}}
            <div class="bento-card col-span-1 md:col-span-4 lg:col-span-6 p-8 lg:p-12 mb-12 bg-white flex flex-col md:flex-row items-center justify-between text-center md:text-left gap-8 border-t-4 border-[#7149c9]">
                <div>
                    <h2 class="font-display font-extrabold text-3xl md:text-4xl text-gray-900 mb-2">Hagamos que suceda.</h2>
                    <p class="text-gray-500 font-medium text-lg">Envíanos un mensaje y comencemos a darle forma a tu decoración.</p>
                </div>
                <a href="https://wa.me/5493517482565" target="_blank" class="px-10 py-5 bg-[#7149c9] text-white rounded-full font-bold shadow-lg shadow-[#7149c9]/30 hover:bg-[#5b3eb0] hover:-translate-y-1 transition-transform whitespace-nowrap text-lg">
                    Contactar Vía WhatsApp
                </a>
            </div>

        </div>
    </main>

    {{-- Minimal Footer --}}
    <footer class="max-w-[96rem] mx-auto px-6 lg:px-12 py-10 flex flex-col md:flex-row justify-between items-center bg-transparent">
        <p class="text-sm text-gray-400 font-medium mb-4 md:mb-0">
            &copy; {{ date('Y') }} Misino. Ambientes Inolvidables.
        </p>
        <div class="flex gap-4">
            <a href="https://instagram.com" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-gray-400 hover:text-gray-900 hover:shadow-md transition-all">Ig</a>
        </div>
    </footer>

    {{-- WhatsApp flotante --}}
    <a href="https://wa.me/5493517482565" class="wa-float flex items-center justify-center hover:scale-110" target="_blank">
        <svg fill="currentColor" class="w-8 h-8" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 .004 5.411.002 12.048c0 2.12.54 4.19 1.563 6.04L0 24l6.082-1.594a11.819 11.819 0 005.96 1.604h.005c6.636 0 12.048-5.411 12.051-12.049a11.829 11.829 0 00-3.626-8.53z"/></svg>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swiperBento = new Swiper('.bentoSwiper', {
                slidesPerView: 'auto',
                spaceBetween: 0,
                grabCursor: true,
                loop: true,
                speed: 4000,
                autoplay: {
                    delay: 0,
                    disableOnInteraction: false,
                },
            });
        });
    </script>
</body>
</html>
