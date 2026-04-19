<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Misino - Ambientación Premium</title>
    
    <meta name="theme-color" content="#0a0a0a">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #050505; color: #e5e7eb; }
        .font-serif { font-family: 'Playfair Display', serif; }
        
        .text-gold { color: #C5A059; }
        .bg-gold { background-color: #C5A059; }
        .border-gold { border-color: #C5A059; }
        
        /* Swiper Fixes */
        .swiper-pagination { position: relative !important; margin-top: 3rem !important; }
        .swiper-pagination-bullet { background: #374151; opacity: 1; transition: all 0.3s ease; border-radius: 0; width: 12px; height: 4px; }
        .swiper-pagination-bullet-active { background: #C5A059 !important; width: 32px; }

        /* WhatsApp flotante */
        .wa-float {
            position: fixed; width: 60px; height: 60px; bottom: 30px; right: 30px;
            background-color: #25d366; color: #FFF; border-radius: 50px; text-align: center;
            font-size: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.5); z-index: 100;
        }

        .reveal { animation: fadeIn 1.2s cubic-bezier(0.16, 1, 0.3, 1) both; }
        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        .delay-3 { animation-delay: 0.6s; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="selection:bg-[#C5A059]/30 selection:text-white">

    {{-- Header Minimal --}}
    <header class="fixed top-0 w-full z-50 py-6 px-8 flex justify-between items-center mix-blend-difference">
        <div class="flex items-center gap-3">
            <span class="font-serif text-2xl font-bold tracking-widest text-white uppercase">Misino.</span>
        </div>
        <nav class="hidden md:flex gap-10">
            <a href="#servicios" class="text-xs text-gray-300 hover:text-white uppercase tracking-[0.2em] transition-colors">Servicios</a>
            <a href="#galeria" class="text-xs text-gray-300 hover:text-white uppercase tracking-[0.2em] transition-colors">Galería</a>
            <a href="#contacto" class="text-xs text-gray-300 hover:text-white uppercase tracking-[0.2em] transition-colors">Contacto</a>
        </nav>
    </header>

    <main class="flex-grow">
        {{-- Hero Split --}}
        <section class="min-h-screen flex flex-col lg:flex-row">
            <div class="w-full lg:w-1/2 flex items-center px-8 lg:px-24 pt-32 pb-20 justify-center lg:justify-start">
                <div class="max-w-xl">
                    <p class="text-gold text-xs uppercase tracking-[0.3em] mb-8 font-semibold reveal">Mobiliario de Autor</p>
                    <h1 class="font-serif text-5xl sm:text-6xl lg:text-7xl leading-[1.1] mb-8 text-white reveal delay-1">
                        Elegancia atemporal <br> <span class="italic text-gray-400 font-light">para tu evento</span>
                    </h1>
                    <p class="text-gray-400 text-lg mb-12 font-light leading-relaxed max-w-md reveal delay-2">
                        Diseñamos y montamos atmósferas únicas. Estructuras, candy bars y decoración de primer nivel para celebraciones inolvidables.
                    </p>
                    <div class="reveal delay-3">
                        <a href="https://wa.me/5493517482565" target="_blank" class="inline-flex items-center border-b border-gold text-white hover:text-gold pb-2 uppercase tracking-widest text-xs font-semibold transition-colors group">
                            Agendar Asesoría
                            <svg class="w-4 h-4 ml-3 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/2 h-[60vh] lg:h-screen relative reveal delay-2">
                <div class="absolute inset-0 bg-black/20 z-10"></div>
                <img src="{{ asset('img/ambient.jpg') }}" class="w-full h-full object-cover grayscale-[20%]">
            </div>
        </section>

        {{-- Servicios List --}}
        <section id="servicios" class="py-32 px-8 lg:px-24 bg-[#0a0a0a]">
            <div class="max-w-7xl mx-auto">
                <div class="mb-24 md:flex justify-between items-end">
                    <h2 class="font-serif text-4xl lg:text-5xl text-white">Nuestra <br><span class="italic text-gray-500">Expertise</span></h2>
                    <p class="text-gray-400 mt-6 md:mt-0 max-w-sm text-sm leading-relaxed font-light">Cuidamos cada detalle para que no tengas que preocuparte por nada durante tu gran día.</p>
                </div>

                <div class="border-t border-gray-800">
                    {{-- Service 1 --}}
                    <div class="py-12 border-b border-gray-800 md:flex items-start group hover:bg-[#111] transition-colors -mx-8 px-8">
                        <div class="text-gold font-serif text-2xl w-24 mb-4 md:mb-0">01</div>
                        <div class="flex-grow md:grid grid-cols-2 gap-12">
                            <h3 class="text-2xl text-white font-light tracking-wide mb-4 md:mb-0 group-hover:text-gold transition-colors">Mobiliario Candy Bar</h3>
                            <p class="text-gray-400 font-light text-sm leading-relaxed">
                                Contamos con una amplia variedad de mesas, alzadas, carritos y estructuras modernas para destacar la mesa dulce de tu evento. Materiales premium y acabados perfectos.
                            </p>
                        </div>
                    </div>
                    {{-- Service 2 --}}
                    <div class="py-12 border-b border-gray-800 md:flex items-start group hover:bg-[#111] transition-colors -mx-8 px-8">
                        <div class="text-gold font-serif text-2xl w-24 mb-4 md:mb-0">02</div>
                        <div class="flex-grow md:grid grid-cols-2 gap-12">
                            <h3 class="text-2xl text-white font-light tracking-wide mb-4 md:mb-0 group-hover:text-gold transition-colors">Decoración Total</h3>
                            <p class="text-gray-400 font-light text-sm leading-relaxed">
                                Buscamos el concepto ideal para tu fiesta y lo hacemos realidad. Fondos, arcos orgánicos, telones, globología y mucho detalle personalizado a tu paleta de colores.
                            </p>
                        </div>
                    </div>
                    {{-- Service 3 --}}
                    <div class="py-12 border-b border-gray-800 md:flex items-start group hover:bg-[#111] transition-colors -mx-8 px-8">
                        <div class="text-gold font-serif text-2xl w-24 mb-4 md:mb-0">03</div>
                        <div class="flex-grow md:grid grid-cols-2 gap-12">
                            <h3 class="text-2xl text-white font-light tracking-wide mb-4 md:mb-0 group-hover:text-gold transition-colors">Logística In-House</h3>
                            <p class="text-gray-400 font-light text-sm leading-relaxed">
                                Relájate en tu gran día. Llevamos y montamos la estructura en el salón, en el horario coordinado. Logística propia resolutiva para que tu única tarea sea disfrutar.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Galería --}}
        <section id="galeria" class="py-32 relative bg-[#050505]">
            <div class="max-w-[90rem] mx-auto px-8 lg:px-12">
                <h2 class="font-serif text-4xl lg:text-5xl text-white mb-16 text-center">Colección <span class="italic text-gray-500">Visual</span></h2>
                
                <div class="swiper galeriaSwiper overflow-visible">
                    <div class="swiper-wrapper">
                        @foreach(range(1, 10) as $i)
                        <div class="swiper-slide">
                            <div class="aspect-[3/4] relative overflow-hidden group bg-gray-900 border border-gray-900">
                                <img src="{{ asset('img/gallery/' . $i . '.jpg') }}" class="w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-110 opacity-80 group-hover:opacity-100">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-8">
                                    <span class="text-gold font-serif italic text-xl">Detalle #0{{$i}}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        {{-- Testimonios --}}
        <section id="testimonios" class="py-32 bg-[#0a0a0a] border-t border-gray-900">
            <div class="max-w-5xl mx-auto px-8">
                <div class="text-center mb-20">
                    <svg class="w-10 h-10 mx-auto text-gold mb-6 opacity-50" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                    <h2 class="font-serif text-3xl text-white">Experiencias Reales</h2>
                </div>

                <div class="swiper testimoSwiper">
                    <div class="swiper-wrapper">
                        @php
                        $reviews = [
                            ['name' => 'Carolina M.', 'event' => 'Cumpleaños 15', 'text' => 'El Candy Bar quedó tal cual lo soñamos. Súper puntuales con el horario de armado en el salón y la estructura estaba impecable. Recomendadísimos.'],
                            ['name' => 'Florencia T.', 'event' => 'Bautismo', 'text' => 'Excelente presentación del mobiliario, todos nos preguntaron de dónde era. Ya los estamos recomendando para el bautismo de mi sobrino.'],
                            ['name' => 'Valeria S.', 'event' => 'Fiesta Infantil', 'text' => 'Me resolvieron todo. Los cilindros y las mesas cilíndricas le dieron un toque súper moderno al cumple de 5 de mi nena. Son unos genios.'],
                            ['name' => 'Sabrina L.', 'event' => 'Comunión', 'text' => 'Es la segunda vez que les alquilo bases para mi Candy Bar. Tienen muchísima variedad y los precios son re accesibles.']
                        ];
                        @endphp
                        @foreach($reviews as $review)
                        <div class="swiper-slide text-center px-4 lg:px-20">
                            <p class="text-xl lg:text-2xl font-light text-gray-300 leading-relaxed mb-10">
                                "{{ $review['text'] }}"
                            </p>
                            <p class="text-white text-xs tracking-[0.2em] uppercase font-bold">{{ $review['name'] }}</p>
                            <p class="text-gold italic font-serif mt-2">{{ $review['event'] }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination mt-16"></div>
                </div>
            </div>
        </section>

        {{-- Footer Call to Action minimal --}}
        <section id="contacto" class="py-32 px-8 text-center bg-[#050505]">
            <h2 class="font-serif text-4xl md:text-6xl text-white mb-8">¿Comenzamos a planear?</h2>
            <br>
            <a href="https://wa.me/5493517482565" target="_blank" class="inline-block bg-white text-black px-12 py-5 uppercase tracking-[0.2em] text-xs font-bold hover:bg-gold hover:text-white transition-colors">
                Contactar por WhatsApp
            </a>
        </section>
    </main>

    {{-- Footer --}}
    <footer class="py-12 border-t border-gray-900 bg-[#020202] text-center">
        <span class="font-serif text-xl font-bold tracking-widest text-gray-500 uppercase">Misino.</span>
        <p class="text-[10px] text-gray-600 uppercase tracking-widest mt-6">
            &copy; {{ date('Y') }} Misino Eventos. Todos los derechos reservados.
        </p>
    </footer>

    {{-- Floating WhatsApp Icon --}}
    <a href="https://wa.me/5493517482565" class="wa-float flex items-center justify-center hover:scale-110 transition-transform" target="_blank">
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
                    1024: { slidesPerView: 3.5 }
                }
            });

            const swiper2 = new Swiper('.testimoSwiper', {
                slidesPerView: 1,
                spaceBetween: 40,
                grabCursor: true,
                pagination: { el: ".testimoSwiper .swiper-pagination", clickable: true }
            });
        });
    </script>
</body>
</html>
