<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Misino - Creando Momentos Inolvidables</title>
    
    <meta name="theme-color" content="#FCFAF8">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        body { font-family: 'Montserrat', sans-serif; background-color: #FCFAF8; color: #4A4A4A; }
        .font-serif { font-family: 'Cormorant Garamond', serif; }
        
        .text-sage { color: #5B6D5B; } /* Olive/Sage Green */
        .bg-sage { background-color: #5B6D5B; }
        
        .text-peach { color: #DDA785; } /* Warm Peach */
        .bg-peach { background-color: #DDA785; }
        .hover-bg-peach:hover { background-color: #C8916F; }

        .border-soft { border-color: #EDE8DF; }

        /* Arcos fotográficos */
        .arch-shape { border-radius: 9999px 9999px 24px 24px; }
        
        /* Swiper Fixes */
        .swiper-pagination { position: relative !important; margin-top: 3rem !important; }
        .swiper-pagination-bullet { background: #D0C9BE; opacity: 1; transition: all 0.3s ease; width: 10px; height: 10px; border-radius: 50%; }
        .swiper-pagination-bullet-active { background: #5B6D5B !important; transform: scale(1.3); }

        /* Line SVG decoration */
        .squiggly-line { width: 80px; height: auto; stroke: #DDA785; stroke-width: 2; fill: none; margin: 0 auto; }

        .reveal { animation: subtleUp 1s ease forwards; opacity: 0; transform: translateY(20px); }
        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        @keyframes subtleUp { to { opacity: 1; transform: translateY(0); } }

        /* Floating WP */
        .wa-float {
            position: fixed; width: 60px; height: 60px; bottom: 30px; right: 30px;
            background-color: #25d366; color: #FFF; border-radius: 50px; text-align: center;
            font-size: 30px; box-shadow: 0 10px 20px rgba(37,211,102,0.3); z-index: 100; transition: transform 0.3s ease;
        }

        .hide-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="selection:bg-[#DDA785]/30 selection:text-[#5B6D5B]">

    {{-- Header --}}
    <header class="w-full relative z-50 py-8 px-6 lg:px-12 flex justify-between items-center bg-transparent">
        <div class="flex items-center gap-3">
            <span class="font-serif text-3xl font-bold tracking-wider text-sage">Misino</span>
        </div>
        <nav class="hidden md:flex items-center gap-10">
            <a href="#servicios" class="text-xs font-semibold text-[#8B8881] hover:text-sage uppercase tracking-[0.1em] transition-colors">Servicios</a>
            <a href="#galeria" class="text-xs font-semibold text-[#8B8881] hover:text-sage uppercase tracking-[0.1em] transition-colors">Portafolio</a>
            <a href="https://wa.me/5493517482565" target="_blank" class="px-6 py-3 bg-sage text-white rounded-full text-xs font-semibold uppercase tracking-widest hover:bg-[#485748] transition-colors shadow-lg shadow-sage/20">
                Contacto
            </a>
        </nav>
    </header>

    <main>
        {{-- Hero Organico --}}
        <section class="max-w-7xl mx-auto px-6 lg:px-8 pt-10 pb-20 text-center">
            
            <p class="text-peach text-sm uppercase tracking-[0.2em] mb-4 font-semibold reveal">Ambientación y Mobiliario</p>
            
            <h1 class="font-serif text-5xl md:text-7xl lg:text-[5.5rem] leading-[1.1] text-sage mb-8 reveal delay-1 max-w-4xl mx-auto">
                Belleza natural para tus <span class="italic text-peach">momentos únicos.</span>
            </h1>

            <svg class="squiggly-line mb-10 reveal delay-2" viewBox="0 0 100 20">
                <path d="M0,10 Q12.5,0 25,10 T50,10 T75,10 T100,10" />
            </svg>

            <div class="mt-16 relative block w-full max-w-md mx-auto aspect-[3/4] arch-shape overflow-hidden shadow-2xl reveal delay-2">
                <img src="{{ asset('img/ambient.jpg') }}" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-[2s]">
                <div class="absolute inset-x-0 bottom-0 py-8 bg-gradient-to-t from-black/50 to-transparent flex justify-center">
                    <a href="https://wa.me/5493517482565" target="_blank" class="px-8 py-4 bg-white text-sage rounded-full text-xs font-bold uppercase tracking-widest hover:bg-peach hover:text-white transition-colors">
                        Cotizar mi Evento
                    </a>
                </div>
            </div>
            
            {{-- Decorative circles background --}}
            <div class="absolute top-[20%] left-[10%] w-[30vw] h-[30vw] bg-[#F3EFE9] rounded-full mix-blend-multiply blur-3xl opacity-60 -z-10"></div>
            <div class="absolute top-[30%] right-[10%] w-[25vw] h-[25vw] bg-peach/20 rounded-full mix-blend-multiply blur-3xl opacity-60 -z-10"></div>
        </section>

        {{-- Servicios --}}
        <section id="servicios" class="py-24 bg-[#F7F4EF]">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-20">
                    <h2 class="font-serif text-4xl lg:text-5xl text-sage mb-4">Lo que hacemos</h2>
                    <p class="text-[#8B8881] font-light max-w-lg mx-auto">Cuidamos todos los rincones visuales para transformar cualquier espacio en el lugar de tus sueños.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-8">
                    {{-- Service 1 --}}
                    <div class="flex flex-col items-center text-center">
                        <div class="w-full max-w-xs mx-auto aspect-[4/5] arch-shape overflow-hidden mb-8 shadow-lg">
                             <img src="{{ asset('img/candy.jpg') }}" class="w-full h-full object-cover">
                        </div>
                        <h4 class="font-serif text-2xl text-sage mb-3">Mobiliario Candy Bar</h4>
                        <p class="text-[#8B8881] text-sm leading-relaxed px-4">
                            Mesas cilíndricas, estructuras y alzadas para resaltar la repostería de tu fiesta con gran distinción.
                        </p>
                    </div>

                    {{-- Service 2 --}}
                    <div class="flex flex-col items-center text-center mt-0 md:mt-12">
                        <div class="w-full max-w-xs mx-auto aspect-[4/5] arch-shape overflow-hidden mb-8 shadow-lg">
                             <img src="{{ asset('img/structure.jpeg') }}" class="w-full h-full object-cover">
                        </div>
                        <h4 class="font-serif text-2xl text-sage mb-3">Fondos y Escenografías</h4>
                        <p class="text-[#8B8881] text-sm leading-relaxed px-4">
                            Diseñamos fondos para fotos memorables, arcos orgánicos y entelados que marcan el estilo de la velada.
                        </p>
                    </div>

                    {{-- Service 3 --}}
                    <div class="flex flex-col items-center text-center mt-0 md:-mt-12 lg:mt-0">
                        <div class="w-full max-w-xs mx-auto aspect-[4/5] arch-shape overflow-hidden mb-8 shadow-lg">
                             <img src="{{ asset('img/accesories.jpeg') }}" class="w-full h-full object-cover">
                        </div>
                        <h4 class="font-serif text-2xl text-sage mb-3">Logística Integral</h4>
                        <p class="text-[#8B8881] text-sm leading-relaxed px-4">
                            No te estreses corriendo antes del evento. Llevamos, armamos y retiramos todo para tu tranquilidad.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Galería Carrusel --}}
        <section id="galeria" class="py-32 overflow-hidden bg-[#FCFAF8]">
            <div class="max-w-[100rem] mx-auto px-6 lg:px-12 text-center">
                <svg class="squiggly-line mb-6" viewBox="0 0 100 20">
                    <path d="M0,10 Q12.5,0 25,10 T50,10 T75,10 T100,10" />
                </svg>
                <h2 class="font-serif text-4xl lg:text-5xl text-sage mb-16">Inspiración Reciente</h2>
                
                <div class="swiper galeriaSwiper overflow-visible">
                    <div class="swiper-wrapper">
                        @foreach(range(1, 10) as $i)
                        <div class="swiper-slide">
                            <div class="relative w-full aspect-[4/5] rounded-[30px] overflow-hidden group shadow-md shadow-[#ECE9E0]">
                                <img src="{{ asset('img/gallery/' . $i . '.jpg') }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-in-out">
                                <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/40 to-transparent"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        {{-- Testimonios Calidos --}}
        <section id="testimonios" class="py-24 bg-[#EBE7DF] border-y border-soft">
            <div class="max-w-4xl mx-auto px-6">
                <h2 class="font-serif text-4xl text-sage mb-16 text-center">Momentos Felices</h2>
                <div class="swiper testimoSwiper">
                    <div class="swiper-wrapper">
                        @php
                        $reviews = [
                            ['name' => 'Carolina M.', 'event' => 'Cumpleaños 15', 'text' => 'El Candy Bar quedó tal cual lo soñamos. Súper puntuales con el horario de armado en el salón y la estructura impecable.'],
                            ['name' => 'Florencia T.', 'event' => 'Bautismo', 'text' => 'Excelente presentación del mobiliario, todos nos preguntaron de dónde era. Ya los estamos recomendando para el bautismo de mi sobrino.'],
                            ['name' => 'Valeria S.', 'event' => 'Fiesta Infantil', 'text' => 'Me resolvieron todo. Los cilindros le dieron un toque súper moderno al cumple de mi nena. Son unos genios.']
                        ];
                        @endphp
                        @foreach($reviews as $review)
                        <div class="swiper-slide bg-white rounded-[2rem] p-10 lg:p-14 text-center shadow-sm">
                            <div class="text-peach text-5xl font-serif mb-4 leading-none">"</div>
                            <p class="text-gray-600 text-base md:text-lg italic font-light leading-relaxed mb-8">
                                {{ $review['text'] }}
                            </p>
                            <span class="block w-12 h-[1px] bg-peach mx-auto mb-4"></span>
                            <p class="font-bold text-sage text-sm uppercase tracking-widest">{{ $review['name'] }}</p>
                            <p class="text-xs text-[#8B8881] mt-1">{{ $review['event'] }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination mt-6"></div>
                </div>
            </div>
        </section>

        {{-- Footer Call To Action --}}
        <section id="contacto" class="py-24 bg-sage text-center px-6 border-b-[8px] border-peach">
            <h2 class="font-serif text-4xl md:text-5xl text-[#F7F4EF] mb-8">Hablemos de tu celebración</h2>
            <p class="text-[#D0C9BE] font-light max-w-lg mx-auto mb-10">Cuéntanos sobre tus fechas y paleta de colores. Te asesoramos con opciones a la medida de tu presupuesto.</p>
            <a href="https://wa.me/5493517482565" target="_blank" class="inline-block bg-peach text-white px-10 py-4 uppercase tracking-[0.15em] text-xs font-bold hover-bg-peach transition-colors rounded-full shadow-lg shadow-black/10">
                Contactar por WhatsApp
            </a>
        </section>
    </main>

    {{-- Footer --}}
    <footer class="py-8 bg-[#FCFAF8] text-center">
        <p class="text-[10px] text-[#8B8881] uppercase tracking-widest mt-2">
            &copy; {{ date('Y') }} Misino Eventos. Todo florece con amor.
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
                spaceBetween: 24,
                grabCursor: true,
                pagination: { el: ".galeriaSwiper .swiper-pagination", clickable: true },
                breakpoints: {
                    640: { slidesPerView: 2.2 },
                    1024: { slidesPerView: 3.8 }
                }
            });

            const swiper2 = new Swiper('.testimoSwiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                grabCursor: true,
                pagination: { el: ".testimoSwiper .swiper-pagination", clickable: true },
                breakpoints: {
                    1024: { slidesPerView: 2, spaceBetween: 40 }
                }
            });
        });
    </script>
</body>
</html>
