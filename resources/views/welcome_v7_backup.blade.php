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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@300;400;600;700;900&display=swap" rel="stylesheet">

    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #ffffff; color: #111111; font-weight: 400; }
        .font-display { font-family: 'Outfit', sans-serif; letter-spacing: -0.02em; }
        
        .accent-orange { color: #f9aa2b; }
        .bg-accent-orange { background-color: #f9aa2b; }

        /* Nordic / Architectural Sharp Borders */
        .sharp-border { border: 1px solid #E5E5E5; }
        .sharp-border-dark { border: 1px solid #111111; }
        
        /* Swiper Fixes */
        .swiper-pagination { position: relative !important; margin-top: 3rem !important; }
        .swiper-pagination-bullet { background: #E5E5E5; opacity: 1; transition: all 0.3s ease; width: 40px; height: 2px; border-radius: 0; }
        .swiper-pagination-bullet-active { background: #111111 !important; }

        /* Floating WP - Sharp Minimal */
        .wa-float {
            position: fixed; width: 55px; height: 55px; bottom: 30px; right: 30px;
            background-color: #111111; color: #FFF; border-radius: 0; text-align: center;
            font-size: 24px; z-index: 100; transition: transform 0.3s ease; display: flex; align-items: center; justify-content: center;
        }
        .wa-float:hover { background-color: #25d366; transform: translateY(-4px); }

        .hide-scrollbar::-webkit-scrollbar { display: none; }
        
        /* Slide & Reveal Animation */
        .reveal-left { animation: slideInLeft 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; transform: translateX(-40px); }
        .reveal-up { animation: slideInUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; transform: translateY(40px); }
        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        @keyframes slideInLeft { to { opacity: 1; transform: translateX(0); } }
        @keyframes slideInUp { to { opacity: 1; transform: translateY(0); } }
        
        /* Image hover zoom */
        .img-zoom-container { overflow: hidden; }
        .img-zoom-container img { transition: transform 1.5s cubic-bezier(0.16, 1, 0.3, 1); }
        .img-zoom-container:hover img { transform: scale(1.05); }
    </style>
</head>
<body class="selection:bg-[#111111] selection:text-white overflow-x-hidden">

    {{-- Strict Minimal Header --}}
    <header class="w-full relative z-40 py-6 px-6 lg:px-12 flex justify-between items-center border-b border-gray-100 bg-white">
        <div class="flex items-center gap-3">
            <img src="{{ asset('img/logo-misino.png') }}" alt="Misino" class="h-8 w-auto object-contain">
        </div>
        <nav class="hidden md:flex items-center gap-10">
            <a href="#servicios" class="text-xs font-semibold tracking-widest uppercase text-gray-500 hover:text-black transition-colors">Servicios</a>
            <a href="#galeria" class="text-xs font-semibold tracking-widest uppercase text-gray-500 hover:text-black transition-colors">Trabajos</a>
            <a href="#testimonios" class="text-xs font-semibold tracking-widest uppercase text-gray-500 hover:text-black transition-colors">Clientes</a>
        </nav>
        <div class="hidden md:block">
             <a href="https://wa.me/5493517482565" target="_blank" class="px-6 py-3 bg-[#f9aa2b] text-white text-xs font-bold uppercase tracking-widest transition-transform hover:-translate-y-1 inline-block">
                Contáctanos
            </a>
        </div>
    </header>

    <main>
        {{-- Hero Nordic High Contrast --}}
        <section class="max-w-[100rem] mx-auto px-6 lg:px-12 pt-16 pb-24 flex flex-col lg:flex-row items-center justify-between gap-16 lg:gap-8 min-h-[85vh]">
            <div class="w-full lg:w-1/2">
                <span class="inline-block px-3 py-1 sharp-border text-[10px] font-bold uppercase tracking-[0.2em] mb-8 text-gray-500 reveal-left">
                    Arquitectura de Eventos
                </span>
                
                <h1 class="font-display font-black text-6xl md:text-7xl lg:text-[6.5rem] leading-[0.95] text-[#111111] mb-8 reveal-left delay-1 uppercase">
                    Celebra <br> a lo <span class="accent-orange">grande.</span>
                </h1>
                
                <p class="text-gray-500 text-lg md:text-xl font-light max-w-lg mb-12 leading-relaxed reveal-left delay-2">
                    Estructuras minimalistas, candy bars y montajes que le dan vida a tus fiestas sin perder la sofisticación.
                </p>
                
                <div class="flex items-center gap-6 reveal-left delay-2">
                    <a href="https://wa.me/5493517482565" target="_blank" class="px-8 py-4 bg-[#111111] text-white text-sm font-semibold uppercase tracking-widest transition-colors hover:bg-[#f9aa2b]">
                        Cotizar Estructura
                    </a>
                    <a href="#galeria" class="text-xs font-bold uppercase tracking-widest border-b-2 border-[#111111] pb-1 hover:text-[#f9aa2b] hover:border-[#f9aa2b] transition-colors">
                        Ver galería
                    </a>
                </div>
            </div>
            
            <div class="w-full lg:w-1/2 relative h-[500px] lg:h-[750px] reveal-up delay-1">
                {{-- Sharp Architectural Grid --}}
                <div class="absolute top-0 right-0 w-3/4 h-[85%] bg-gray-100 img-zoom-container z-10">
                    <img src="{{ asset('img/ambient.jpg') }}" class="w-full h-full object-cover">
                </div>
                <div class="absolute bottom-0 left-0 w-1/2 h-[45%] bg-white img-zoom-container sharp-border p-3 z-20">
                    <div class="w-full h-full overflow-hidden">
                        <img src="{{ asset('img/candy.jpg') }}" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </section>

        {{-- Servicios - Sharp Box Layout --}}
        <section id="servicios" class="py-32 bg-[#FAFAFA] border-t border-gray-200">
            <div class="max-w-[100rem] mx-auto px-6 lg:px-12">
                <div class="flex flex-col md:flex-row justify-between items-end mb-24">
                    <div>
                        <h2 class="font-display font-bold text-5xl md:text-6xl text-[#111111] leading-none uppercase">Lo que hacemos</h2>
                    </div>
                    <div class="mt-6 md:mt-0 max-w-sm">
                        <p class="text-gray-500 font-light text-base leading-relaxed">Combinamos diseño funcional y logística impecable para dar forma al evento ideal.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-0 sharp-border-dark bg-[#111111]">
                    {{-- Item 1 --}}
                    <div class="bg-white p-10 lg:p-14 border border-gray-100 group hover:bg-[#f9aa2b] transition-colors duration-500">
                        <div class="mb-16">
                            <h3 class="font-display font-black text-3xl md:text-4xl text-gray-200 group-hover:text-white transition-colors">01</h3>
                        </div>
                        <h4 class="font-display text-2xl font-bold mb-4 text-[#111] group-hover:text-white transition-colors">Mobiliario Candy</h4>
                        <p class="text-gray-500 font-light leading-relaxed group-hover:text-white/90 transition-colors">
                            Cilindros, alzadas, carritos y estructuras versátiles. Líneas rectas y simples que hacen brillar a tu repostería.
                        </p>
                    </div>

                    {{-- Item 2 --}}
                    <div class="bg-white p-10 lg:p-14 border border-gray-100 group hover:bg-[#111111] transition-colors duration-500">
                        <div class="mb-16">
                            <h3 class="font-display font-black text-3xl md:text-4xl text-gray-200 group-hover:text-[#444] transition-colors">02</h3>
                        </div>
                        <h4 class="font-display text-2xl font-bold mb-4 text-[#111] group-hover:text-white transition-colors">Fondos y Decó</h4>
                        <p class="text-gray-500 font-light leading-relaxed group-hover:text-gray-400 transition-colors">
                            Telones, arcos orgánicos y backdrops pensados para crear puntos focales fotográficos de alto impacto.
                        </p>
                    </div>

                    {{-- Item 3 --}}
                    <div class="bg-white p-10 lg:p-14 border border-gray-100 group hover:bg-[#f9aa2b] transition-colors duration-500">
                        <div class="mb-16">
                            <h3 class="font-display font-black text-3xl md:text-4xl text-gray-200 group-hover:text-white transition-colors">03</h3>
                        </div>
                        <h4 class="font-display text-2xl font-bold mb-4 text-[#111] group-hover:text-white transition-colors">Logística Integral</h4>
                        <p class="text-gray-500 font-light leading-relaxed group-hover:text-white/90 transition-colors">
                            Llevamos todo, montamos con precisión antes de la fiesta y desarmamos al finalizar para que solo disfrutes.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Galería "Editorial" --}}
        <section id="galeria" class="py-32 bg-white">
            <div class="max-w-[100rem] mx-auto px-6 lg:px-12">
                <div class="mb-16">
                    <h2 class="font-display font-bold text-5xl md:text-6xl text-[#111111] mb-6 uppercase">Visuales</h2>
                    <div class="w-24 h-1 bg-[#f9aa2b]"></div>
                </div>
                
                <div class="swiper galeriaSwiper overflow-hidden">
                    <div class="swiper-wrapper">
                        @foreach(range(1, 10) as $i)
                        <div class="swiper-slide">
                            <div class="relative w-full aspect-[4/5] img-zoom-container sharp-border bg-gray-50 group">
                                <img src="{{ asset('img/gallery/' . $i . '.jpg') }}" loading="lazy" class="w-full h-full object-cover">
                                <div class="absolute inset-x-0 bottom-0 p-8 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <p class="text-white font-display font-semibold uppercase tracking-widest text-sm">Proyecto {{ sprintf("%02d", $i) }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        {{-- Testimonios (Clean Grid) --}}
        <section id="testimonios" class="py-32 bg-white border-t border-gray-100">
            <div class="max-w-6xl mx-auto px-6 lg:px-12">
                <h2 class="font-display font-bold text-5xl md:text-6xl text-[#111111] mb-20 text-center uppercase">Comentarios</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @php
                    $reviews = [
                        ['name' => 'Carolina M.', 'event' => 'Cumpleaños 15', 'text' => 'Excelente presentación del mobiliario. Líneas muy limpias y montaje súper rápido. El Candy Bar quedó tal cual lo soñamos.'],
                        ['name' => 'Florencia T.', 'event' => 'Bautismo', 'text' => 'Ya los estamos recomendando. Puntualidad y precisión en la ambientación impecable.'],
                        ['name' => 'Valeria S.', 'event' => 'Fiesta 18', 'text' => 'Me resolvieron todo. Los cilindros le dieron un toque súper moderno a la fiesta de mi hija. Trabajo muy profesional.'],
                    ];
                    @endphp
                    @foreach($reviews as $review)
                    <div class="p-10 bg-gray-50 sharp-border relative">
                        <div class="absolute top-6 left-6 text-6xl font-display text-gray-200 leading-none">"</div>
                        <p class="text-gray-600 font-light leading-relaxed mb-8 relative z-10 pt-8 text-sm md:text-base">
                            {{ $review['text'] }}
                        </p>
                        <div class="border-t border-gray-200 pt-6">
                            <p class="font-display font-bold text-[#111] tracking-widest uppercase text-xs mb-1">{{ $review['name'] }}</p>
                            <p class="text-xs text-[#f9aa2b] font-bold uppercase tracking-widest">{{ $review['event'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Footer CTA High Contrast --}}
        <section id="contacto" class="py-32 bg-[#111111] text-center border-t-[8px] border-[#f9aa2b]">
            <div class="max-w-2xl mx-auto px-6">
                <h2 class="font-display font-black text-5xl md:text-7xl text-white mb-8 uppercase">Hablemos.</h2>
                <p class="text-gray-400 font-light mb-12 text-lg">Escríbenos para conversar sobre tu evento. Estilo, funcionalidad y logística en un solo lugar.</p>
                <a href="https://wa.me/5493517482565" target="_blank" class="inline-block bg-[#f9aa2b] text-white px-12 py-5 text-sm font-bold uppercase tracking-widest hover:bg-white hover:text-[#111] transition-colors">
                    Línea Directa WhatsApp
                </a>
            </div>
        </section>
    </main>

    {{-- Minimal Footer --}}
    <footer class="py-10 bg-white text-center border-t border-gray-100">
        <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-gray-500">
            &copy; {{ date('Y') }} Misino. Todos los derechos reservados.
        </p>
    </footer>

    {{-- WhatsApp flotante --}}
    <a href="https://wa.me/5493517482565" class="wa-float" target="_blank">
        <svg fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 .004 5.411.002 12.048c0 2.12.54 4.19 1.563 6.04L0 24l6.082-1.594a11.819 11.819 0 005.96 1.604h.005c6.636 0 12.048-5.411 12.051-12.049a11.829 11.829 0 00-3.626-8.53z"/></svg>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swiper1 = new Swiper('.galeriaSwiper', {
                slidesPerView: 1.2,
                spaceBetween: 30,
                grabCursor: true,
                pagination: { el: ".galeriaSwiper .swiper-pagination", clickable: true },
                breakpoints: {
                    640: { slidesPerView: 2.2 },
                    1024: { slidesPerView: 3.5, spaceBetween: 50 }
                }
            });
        });
    </script>
</body>
</html>
