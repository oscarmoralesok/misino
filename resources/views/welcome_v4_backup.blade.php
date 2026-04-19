<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Misino - Creando Momentos Inolvidables</title>
    
    <meta name="theme-color" content="#ffffff">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #ffffff; color: #374151; }
        .font-display { font-family: 'Outfit', sans-serif; }
        
        .brand-gradient { background: linear-gradient(135deg, #f9aa2b 0%, #7149c9 100%); }
        .text-brand-gradient { background: linear-gradient(135deg, #f9aa2b 0%, #7149c9 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        
        /* Swiper Fixes */
        .swiper-pagination { position: relative !important; margin-top: 2rem !important; }
        .swiper-pagination-bullet { background: #E5E7EB; opacity: 1; transition: all 0.3s ease; width: 8px; height: 8px; border-radius: 50%; }
        .swiper-pagination-bullet-active { background: #f9aa2b !important; width: 24px; border-radius: 8px; }

        /* Floating WP */
        .wa-float {
            position: fixed; width: 60px; height: 60px; bottom: 30px; right: 30px;
            background-color: #25d366; color: #FFF; border-radius: 50px; text-align: center;
            font-size: 30px; box-shadow: 0 10px 20px rgba(37,211,102,0.3); z-index: 100; transition: transform 0.3s ease;
        }

        .hide-scrollbar::-webkit-scrollbar { display: none; }
        
        /* Gentle entry animation */
        .fade-in-up { animation: fadeInUp 0.8s ease forwards; opacity: 0; transform: translateY(20px); }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="selection:bg-[#f9aa2b]/20 selection:text-[#f9aa2b]">

    {{-- Header --}}
    <header class="w-full z-50 py-5 px-6 lg:px-12 flex justify-between items-center bg-white/90 backdrop-blur-md sticky top-0 border-b border-gray-100">
        <div class="flex items-center gap-3">
            {{-- RESTORED ORIGINAL LOGO --}}
            <img src="{{ asset('img/logo-misino.png') }}" alt="Misino" class="h-9 w-auto object-contain">
        </div>
        <nav class="hidden md:flex items-center gap-8">
            <a href="#servicios" class="text-sm font-semibold text-gray-500 hover:text-gray-900 transition-colors">Servicios</a>
            <a href="#galeria" class="text-sm font-semibold text-gray-500 hover:text-gray-900 transition-colors">Nuestros Trabajos</a>
            <a href="#testimonios" class="text-sm font-semibold text-gray-500 hover:text-gray-900 transition-colors">Clientes</a>
            <a href="https://wa.me/5493517482565" target="_blank" class="px-5 py-2.5 bg-gray-900 text-white rounded-xl text-sm font-semibold hover:bg-gray-800 transition-colors shadow-lg shadow-gray-200">
                Contactar
            </a>
        </nav>
    </header>

    <main>
        {{-- Hero Modern Clean --}}
        <section class="max-w-7xl mx-auto px-6 lg:px-8 py-16 lg:py-28 flex flex-col-reverse lg:flex-row items-center gap-12 lg:gap-8">
            <div class="w-full lg:w-1/2 text-center lg:text-left">
                <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold text-[#7149c9] bg-[#7149c9]/10 mb-6 fade-in-up">
                    Alquiler de Mobiliario y Decoración
                </span>
                <h1 class="font-display font-extrabold text-5xl md:text-6xl lg:text-7xl leading-[1.1] mb-6 text-gray-900 fade-in-up delay-100">
                    Tu evento, <br>
                    <span class="text-brand-gradient">hecho realidad.</span>
                </h1>
                <p class="text-gray-500 text-lg md:text-xl font-medium max-w-xl mx-auto lg:mx-0 mb-10 fade-in-up delay-200">
                    Brindamos todo estructural para que tu celebración destaque. Contamos con logística propia para que no tengas que preocuparte por absolutamente nada.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 fade-in-up delay-200">
                    <a href="https://wa.me/5493517482565" target="_blank" class="w-full sm:w-auto px-8 py-4 brand-gradient text-white rounded-2xl font-bold shadow-xl shadow-[#f9aa2b]/30 hover:shadow-2xl hover:scale-105 transition-all text-center">
                        Armar Presupuesto
                    </a>
                </div>
            </div>
            
            <div class="w-full lg:w-1/2 relative fade-in-up">
                {{-- Decorative pattern --}}
                <div class="absolute -top-10 -right-10 w-48 h-48 bg-[#05cca6]/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-[#f9aa2b]/10 rounded-full blur-3xl"></div>
                
                {{-- Dynamic Photo Grid --}}
                <div class="grid grid-cols-2 gap-4 relative z-10">
                    <div class="space-y-4 pt-12">
                        <div class="rounded-3xl overflow-hidden shadow-lg h-56">
                            <img src="{{ asset('img/ambient.jpg') }}" class="w-full h-full object-cover">
                        </div>
                        <div class="rounded-3xl overflow-hidden shadow-lg h-40">
                            <img src="{{ asset('img/structure.jpeg') }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="rounded-3xl overflow-hidden shadow-lg h-48">
                            <img src="{{ asset('img/candy.jpg') }}" class="w-full h-full object-cover">
                        </div>
                        <div class="rounded-3xl overflow-hidden shadow-lg h-60">
                            <img src="{{ asset('img/accesories.jpeg') }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Servicios Clean --}}
        <section id="servicios" class="py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="font-display font-extrabold text-3xl md:text-5xl text-gray-900 mb-4">¿En qué te ayudamos?</h2>
                    <p class="text-gray-500 font-medium max-w-2xl mx-auto">Nuestro abanico de piezas y propuestas estructurales para tu festejo.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 hover:border-[#f9aa2b]/50 group transition-colors">
                        <div class="w-12 h-12 rounded-xl bg-[#f9aa2b]/10 flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-[#f9aa2b]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <h4 class="font-display font-bold text-xl text-gray-900 mb-3">Mesas y Candy</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Cilindros, alzadas, carritos y estructuras versátiles para destacar el sector más dulce del lugar.</p>
                    </div>

                    <div class="bg-white p-8 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 hover:border-[#7149c9]/50 group transition-colors">
                        <div class="w-12 h-12 rounded-xl bg-[#7149c9]/10 flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-[#7149c9]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <h4 class="font-display font-bold text-xl text-gray-900 mb-3">Decoración y Fondos</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Montajes visuales soñados. Arcos, telones y backdrops diseñados a medida para tus fotos.</p>
                    </div>

                    <div class="bg-white p-8 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-gray-100 hover:border-[#05cca6]/50 group transition-colors">
                        <div class="w-12 h-12 rounded-xl bg-[#05cca6]/10 flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-[#05cca6]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                        </div>
                        <h4 class="font-display font-bold text-xl text-gray-900 mb-3">Envíos y Armado</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">Vos dedícate a disfrutar. Nosotros montamos las estructuras en tu locación a tiempo exacto.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Galeria Modern --}}
        <section id="galeria" class="py-24">
            <div class="max-w-[100rem] mx-auto px-6 lg:px-12">
                <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                    <div>
                        <h2 class="font-display font-extrabold text-3xl md:text-5xl text-gray-900 mb-4">Nuestros Trabajos</h2>
                        <p class="text-gray-500 font-medium">Un vistazo a algunos de nuestros últimos setups integrales.</p>
                    </div>
                </div>
                
                <div class="swiper galeriaSwiper overflow-hidden pb-4">
                    <div class="swiper-wrapper">
                        @foreach(range(1, 10) as $i)
                        <div class="swiper-slide">
                            <div class="relative w-full aspect-[4/5] rounded-[2rem] overflow-hidden group bg-gray-100">
                                <img src="{{ asset('img/gallery/' . $i . '.jpg') }}" loading="lazy" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500 ease-in-out">
                                <div class="absolute inset-x-0 bottom-0 p-6 bg-gradient-to-t from-black/60 to-transparent">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        {{-- Testimonios Clean --}}
        <section id="testimonios" class="py-24 bg-gray-50 border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <h2 class="font-display font-extrabold text-3xl md:text-5xl text-gray-900 mb-16 text-center">Clientes Felices</h2>
                
                <div class="swiper testimoSwiper">
                    <div class="swiper-wrapper py-2">
                        @php
                        $reviews = [
                            ['name' => 'Carolina M.', 'event' => 'Cumpleaños 15', 'text' => 'El Candy Bar quedó tal cual lo soñamos. Súper puntuales con el horario de armado en el salón y la estructura impecable. Recomendadísimos.'],
                            ['name' => 'Florencia T.', 'event' => 'Bautismo', 'text' => 'Excelente presentación del mobiliario, todos nos preguntaron de dónde era. Ya los estamos recomendando para el bautismo de mi sobrino.'],
                            ['name' => 'Valeria S.', 'event' => 'Fiesta', 'text' => 'Me resolvieron todo. Los cilindros y las mesas cilíndricas le dieron un toque súper moderno al cumple de mi nena. Son unos genios.'],
                            ['name' => 'Mariana P.', 'event' => 'Empresarial', 'text' => 'Impecable el mobiliario. Llegaron a tiempo, armaron la escenografía súper profesional y el retiro fue súper puntual. Excelentes.']
                        ];
                        @endphp
                        @foreach($reviews as $review)
                        <div class="swiper-slide">
                            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 h-full flex flex-col justify-between">
                                <div>
                                    <div class="flex gap-1 text-[#f9aa2b] mb-4">
                                        @for($i=0; $i<5; $i++)
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        @endfor
                                    </div>
                                    <p class="text-gray-600 leading-relaxed mb-6">"{{ $review['text'] }}"</p>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">{{ $review['name'] }}</p>
                                    <p class="text-sm text-gray-400 font-medium">{{ $review['event'] }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        {{-- CTA CTA --}}
        <section id="contacto" class="py-24 max-w-5xl mx-auto px-6">
            <div class="brand-gradient rounded-[3rem] p-12 text-center shadow-2xl shadow-[#7149c9]/20">
                <h2 class="font-display font-extrabold text-3xl md:text-5xl text-white mb-6">¿Agendamos tu Evento?</h2>
                <p class="text-white/80 font-medium max-w-lg mx-auto mb-10">Escríbenos por WhatsApp con los detalles de qué necesitas y la fecha deseada. Responderemos de inmediato con una asesoría y cotización.</p>
                <a href="https://wa.me/5493517482565" target="_blank" class="inline-block bg-white text-gray-900 px-10 py-4 rounded-2xl font-bold hover:scale-105 transition-transform shadow-lg shadow-black/10">
                    Contactar por WhatsApp
                </a>
            </div>
        </section>
    </main>

    {{-- Footer Simple --}}
    <footer class="py-8 border-t border-gray-100 bg-white text-center">
        <p class="text-sm text-gray-400 font-medium font-display">
            &copy; {{ date('Y') }} Misino. Ambientes Inolvidables.
        </p>
    </footer>

    {{-- WhatsApp flotante --}}
    <a href="https://wa.me/5493517482565" class="wa-float flex items-center justify-center hover:scale-110" target="_blank">
        <svg fill="currentColor" class="w-8 h-8" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 .004 5.411.002 12.048c0 2.12.54 4.19 1.563 6.04L0 24l6.082-1.594a11.819 11.819 0 005.96 1.604h.005c6.636 0 12.048-5.411 12.051-12.049a11.829 11.829 0 00-3.626-8.53z"/></svg>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swiper1 = new Swiper('.galeriaSwiper', {
                slidesPerView: 1.2,
                spaceBetween: 16,
                grabCursor: true,
                pagination: { el: ".galeriaSwiper .swiper-pagination", clickable: true },
                breakpoints: {
                    640: { slidesPerView: 2.2, spaceBetween: 24 },
                    1024: { slidesPerView: 4, spaceBetween: 24 }
                }
            });

            const swiper2 = new Swiper('.testimoSwiper', {
                slidesPerView: 1.1,
                spaceBetween: 16,
                grabCursor: true,
                pagination: { el: ".testimoSwiper .swiper-pagination", clickable: true },
                breakpoints: {
                    640: { slidesPerView: 2, spaceBetween: 24 },
                    1024: { slidesPerView: 3, spaceBetween: 24 }
                }
            });
        });
    </script>
</body>
</html>
