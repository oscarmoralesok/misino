<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Misino - Creando Momentos Inolvidables</title>
    
    <meta name="theme-color" content="#FCFCFC">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Outfit:wght@300;400;500;600&family=Caveat:wght@400;600&display=swap" rel="stylesheet">

    <!-- Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FCFCFC; color: #4A4A4A; font-weight: 300; }
        .font-display { font-family: 'Outfit', sans-serif; }
        .font-hand { font-family: 'Caveat', cursive; }
        
        /* Nordic Palette: Taupe/Dusty Rose, Muted Sage, Stone Blue */
        .text-nordic-taupe { color: #D6C5B3; }
        .bg-nordic-taupe { background-color: #D6C5B3; }
        .border-nordic-taupe { border-color: #D6C5B3; }
        
        .text-nordic-sage { color: #CBD2C6; }
        .bg-nordic-sage { background-color: #CBD2C6; }
        
        .text-nordic-stone { color: #BFCAD0; }
        .bg-nordic-stone { background-color: #BFCAD0; }

        .text-nordic-dark { color: #3A3A3A; }

        /* Minimalist "Nordic Balloon" shapes */
        .shape-balloon-tall { border-radius: 9999px; }
        
        /* Subtle Floating Confetti Animation for the "Party" element */
        .confetti-dot { position: absolute; border-radius: 50%; opacity: 0.6; animation: floatUp 15s linear infinite; }
        @keyframes floatUp { 0% { transform: translateY(100vh) rotate(0deg); opacity: 0; } 10% { opacity: 0.6; } 90% { opacity: 0.6; } 100% { transform: translateY(-100px) rotate(360deg); opacity: 0; } }

        /* Swiper Fixes */
        .swiper-pagination { position: relative !important; margin-top: 2rem !important; }
        .swiper-pagination-bullet { background: #E5E5E5; opacity: 1; transition: all 0.5s ease; width: 6px; height: 6px; border-radius: 50%; }
        .swiper-pagination-bullet-active { background: #D6C5B3 !important; transform: scale(1.5); }

        /* Floating WP - Minimalist version */
        .wa-float {
            position: fixed; width: 55px; height: 55px; bottom: 30px; right: 30px;
            background-color: #FFF; color: #3A3A3A; border: 1px solid #E5E5E5; border-radius: 50px; text-align: center;
            font-size: 26px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); z-index: 100; transition: transform 0.3s ease; display: flex; align-items: center; justify-content: center;
        }
        .wa-float:hover { background-color: #25d366; color: #FFF; border-color: #25d366; transform: translateY(-3px); }

        .hide-scrollbar::-webkit-scrollbar { display: none; }
        
        /* Very subtle fade in */
        .fade-in { animation: fadeIn 1.5s ease forwards; opacity: 0; }
        .delay-1 { animation-delay: 0.3s; }
        .delay-2 { animation-delay: 0.6s; }
        @keyframes fadeIn { to { opacity: 1; } }
    </style>
</head>
<body class="selection:bg-[#D6C5B3]/20 selection:text-[#3A3A3A] overflow-x-hidden relative">

    {{-- Subtle Nordic Confetti System (Background) --}}
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        {{-- Taupe Dots --}}
        <div class="confetti-dot bg-nordic-taupe w-3 h-3 left-[10%]" style="animation-delay: 0s; animation-duration: 18s;"></div>
        <div class="confetti-dot bg-nordic-taupe w-4 h-4 left-[80%]" style="animation-delay: 5s; animation-duration: 22s;"></div>
        {{-- Sage Dots --}}
        <div class="confetti-dot bg-nordic-sage w-2.5 h-2.5 left-[30%]" style="animation-duration: 16s;"></div>
        <div class="confetti-dot bg-nordic-sage w-5 h-5 left-[60%]" style="animation-delay: 8s; animation-duration: 25s;"></div>
        {{-- Stone Dots --}}
        <div class="confetti-dot border border-nordic-stone w-4 h-4 left-[20%]" style="animation-delay: 2s; animation-duration: 20s;"></div>
        <div class="confetti-dot border border-nordic-stone w-3 h-3 left-[90%]" style="animation-delay: 10s; animation-duration: 15s;"></div>
        <div class="confetti-dot border border-nordic-taupe w-6 h-6 left-[50%]" style="animation-delay: 6s; animation-duration: 28s;"></div>
    </div>

    {{-- Header Ultra Minimal --}}
    <header class="w-full relative z-40 py-8 px-6 lg:px-16 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="{{ asset('img/logo-misino.png') }}" alt="Misino" class="h-8 w-auto object-contain opacity-80 mix-blend-multiply">
        </div>
        <nav class="hidden md:flex items-center gap-10">
            <a href="#servicios" class="text-xs tracking-[0.15em] uppercase text-gray-400 hover:text-nordic-dark transition-colors">Propuesta</a>
            <a href="#galeria" class="text-xs tracking-[0.15em] uppercase text-gray-400 hover:text-nordic-dark transition-colors">Portafolio</a>
            <a href="#testimonios" class="text-xs tracking-[0.15em] uppercase text-gray-400 hover:text-nordic-dark transition-colors">Testimonios</a>
        </nav>
        <div class="hidden md:block">
             <a href="https://wa.me/5493517482565" target="_blank" class="text-xs tracking-[0.15em] uppercase text-nordic-dark hover:text-nordic-taupe transition-colors border-b border-nordic-taupe pb-1">
                Charlemos
            </a>
        </div>
    </header>

    <main class="relative z-10">
        {{-- Hero Nordic Hygge --}}
        <section class="max-w-[90rem] mx-auto px-6 lg:px-16 pt-10 pb-32 flex flex-col-reverse lg:flex-row items-center justify-between gap-16 lg:gap-8">
            <div class="w-full lg:w-[45%] text-center lg:text-left">
                <p class="font-hand text-4xl text-nordic-taupe mb-4 fade-in" style="transform: rotate(-3deg);">celebremos bonito</p>
                
                <h1 class="font-display font-light text-5xl md:text-6xl lg:text-[5.5rem] leading-[1.05] text-nordic-dark mb-8 fade-in delay-1">
                    Ambientación <br>
                    <span class="font-medium text-[#444]">minimalista</span> <span class="font-light">para <br> grandes fiestas.</span>
                </h1>
                
                <p class="text-gray-400 font-light text-lg md:text-xl max-w-lg mx-auto lg:mx-0 mb-12 leading-relaxed fade-in delay-2">
                    Mobiliario impecable y decoración que respira. Estructuras, candy bars y logística integral para celebraciones limpias, estéticas y sin estrés.
                </p>
                
                <div class="fade-in delay-2">
                    <a href="https://wa.me/5493517482565" target="_blank" class="inline-flex items-center justify-center px-10 py-4 bg-nordic-dark text-white rounded-full text-xs uppercase tracking-widest font-normal hover:bg-[#222] transition-colors">
                        Cotizar mi espacio
                    </a>
                </div>
            </div>
            
            <div class="w-full lg:w-1/2 relative h-[500px] lg:h-[700px] fade-in">
                {{-- Nordic Balloon Image Layout --}}
                <div class="absolute top-0 right-[15%] w-2/3 h-full shape-balloon-tall overflow-hidden shadow-sm shadow-nordic-taupe/20">
                    <img src="{{ asset('img/ambient.jpg') }}" class="w-full h-full object-cover opacity-90 transform hover:scale-105 transition-transform duration-[3s]">
                </div>
                <div class="absolute bottom-10 left-[10%] w-[45%] aspect-[3/4] shape-balloon-tall overflow-hidden border-4 border-white shadow-lg bg-nordic-sage/10">
                    <img src="{{ asset('img/candy.jpg') }}" class="w-full h-full object-cover mix-blend-overlay opacity-80">
                </div>
                {{-- Soft structural circle --}}
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-nordic-taupe/20 rounded-full blur-2xl -z-10"></div>
            </div>
        </section>

        {{-- Servicios Clean Layout --}}
        <section id="servicios" class="py-32 bg-[#FCFCFC] border-t border-gray-100/50">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
                <p class="font-hand text-3xl text-nordic-sage mb-2">nuestra esencia</p>
                <h2 class="font-display font-light text-4xl lg:text-5xl text-nordic-dark mb-24">Menos es mucho más</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-16 lg:gap-20">
                    {{-- Item 1 --}}
                    <div class="flex flex-col items-center group">
                        <div class="w-48 h-48 rounded-full border border-gray-100 bg-white p-2 mb-8 shadow-sm group-hover:shadow-md transition-shadow group-hover:border-nordic-taupe">
                            <div class="w-full h-full rounded-full overflow-hidden">
                                <img src="{{ asset('img/structure.jpeg') }}" class="w-full h-full object-cover grayscale-[30%] opacity-90">
                            </div>
                        </div>
                        <h4 class="font-display font-medium text-lg text-nordic-dark mb-4 tracking-wide">Mobiliario Específico</h4>
                        <p class="text-gray-400 font-light text-sm leading-loose max-w-xs">
                            Cilindros, alzadas, carritos y estructuras versátiles. Piezas en colores neutros que dejan deslumbrar a la repostería.
                        </p>
                    </div>

                    {{-- Item 2 --}}
                    <div class="flex flex-col items-center group">
                        <div class="w-48 h-48 rounded-full border border-gray-100 bg-white p-2 mb-8 shadow-sm group-hover:shadow-md transition-shadow group-hover:border-nordic-sage mt-0 md:-mt-10">
                            <div class="w-full h-full rounded-full overflow-hidden bg-nordic-sage/10 flex items-center justify-center">
                                 <svg class="w-10 h-10 text-nordic-sage" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>
                            </div>
                        </div>
                        <h4 class="font-display font-medium text-lg text-nordic-dark mb-4 tracking-wide">Decoración Focal</h4>
                        <p class="text-gray-400 font-light text-sm leading-loose max-w-xs">
                            Montajes visuales soñados, fondos sutiles, telones y backdrops pensados para fotografías impecables sin sobrecargar visualmente.
                        </p>
                    </div>

                    {{-- Item 3 --}}
                    <div class="flex flex-col items-center group">
                        <div class="w-48 h-48 rounded-full border border-gray-100 bg-white p-2 mb-8 shadow-sm group-hover:shadow-md transition-shadow group-hover:border-nordic-stone">
                            <div class="w-full h-full rounded-full overflow-hidden">
                                <img src="{{ asset('img/accesories.jpeg') }}" class="w-full h-full object-cover grayscale-[30%] opacity-90">
                            </div>
                        </div>
                        <h4 class="font-display font-medium text-lg text-nordic-dark mb-4 tracking-wide">Logística Seria</h4>
                        <p class="text-gray-400 font-light text-sm leading-loose max-w-xs">
                            Tranquilidad total. Transportamos cada pieza, lo posicionamos con precisión y nos encargamos del retiro en el horario pactado.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Galería Minimal (Wide gaps, floating feeling) --}}
        <section id="galeria" class="py-32">
            <div class="max-w-[120rem] mx-auto px-0 md:px-12 text-center">
                <p class="font-hand text-3xl text-nordic-taupe mb-2">nuestro arte</p>
                <h2 class="font-display font-light text-4xl lg:text-5xl text-nordic-dark mb-20">Instantes Visuales</h2>
                
                <div class="swiper galeriaSwiper overflow-visible px-6">
                    <div class="swiper-wrapper py-6">
                        @foreach(range(1, 10) as $i)
                        <div class="swiper-slide px-2 md:px-0">
                            <div class="relative w-full aspect-[3/4] shape-balloon-tall overflow-hidden group">
                                <img src="{{ asset('img/gallery/' . $i . '.jpg') }}" loading="lazy" class="w-full h-full object-cover grayscale-[15%] group-hover:grayscale-0 transform group-hover:scale-105 transition-all duration-[2s] ease-in-out">
                                <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination mt-10"></div>
                </div>
            </div>
        </section>

        {{-- Testimonios (Airy & Clean) --}}
        <section id="testimonios" class="py-32 bg-[#FAFAFA] border-y border-gray-100/60">
            <div class="max-w-5xl mx-auto px-6 lg:px-8 text-center">
                <p class="font-hand text-3xl text-nordic-stone mb-2">palabras lindas</p>
                <h2 class="font-display font-light text-4xl lg:text-5xl text-nordic-dark mb-20 text-center">Historias Limpias</h2>
                
                <div class="swiper testimoSwiper">
                    <div class="swiper-wrapper pb-10">
                        @php
                        $reviews = [
                            ['name' => 'Carolina M.', 'event' => 'Cumpleaños 15', 'text' => 'El Candy Bar quedó tal cual lo soñamos. Minimalista, hermoso. Súper puntuales con el horario de armado en el salón y la estructura impecable. Recomendadísimos.'],
                            ['name' => 'Florencia T.', 'event' => 'Bautismo', 'text' => 'Excelente presentación del mobiliario, todos nos preguntaron de dónde era. Ya los estamos recomendando para el bautismo de mi sobrino.'],
                            ['name' => 'Valeria S.', 'event' => 'Fiesta', 'text' => 'Me resolvieron todo. Los cilindros le dieron un toque súper moderno, puro y limpio al cumple de mi nena. Son unos genios.'],
                        ];
                        @endphp
                        @foreach($reviews as $review)
                        <div class="swiper-slide px-4">
                            <div class="bg-white rounded-3xl p-12 shadow-[0_10px_40px_rgba(0,0,0,0.02)] border border-gray-50 h-full">
                                <svg class="w-8 h-8 text-nordic-taupe opacity-40 mx-auto mb-8" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                                
                                <p class="text-gray-500 font-light leading-loose text-lg mb-8">
                                    {{ $review['text'] }}
                                </p>
                                
                                <p class="font-display font-medium text-nordic-dark tracking-wide">{{ $review['name'] }}</p>
                                <p class="font-hand text-xl text-gray-400 mt-1">{{ $review['event'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        {{-- Minimal Footer CTA --}}
        <section id="contacto" class="py-32 text-center bg-white">
            <div class="max-w-2xl mx-auto px-6">
                <h2 class="font-display font-light text-4xl md:text-5xl text-nordic-dark mb-8">Reserva tu fecha.</h2>
                <p class="text-gray-400 font-light mb-12 leading-relaxed">Hablemos por mensaje sobre las ideas que tienes en mente. Minimalismo, calidez y puntualidad para tu día soñado.</p>
                <a href="https://wa.me/5493517482565" target="_blank" class="inline-block border border-gray-200 text-nordic-dark px-12 py-4 rounded-full text-xs uppercase tracking-widest font-medium hover:border-nordic-taupe hover:text-nordic-taupe hover:shadow-sm transition-all">
                    Escribir por WhatsApp
                </a>
            </div>
        </section>
    </main>

    {{-- Footer Extremely Simple --}}
    <footer class="py-12 bg-white text-center border-t border-gray-50">
        <img src="{{ asset('img/logo-misino.png') }}" class="h-6 w-auto mx-auto opacity-40 grayscale mb-6">
        <p class="text-[10px] uppercase tracking-[0.2em] text-gray-400 font-light">
            &copy; {{ date('Y') }} Misino. Espacios en calma.
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
                slidesPerView: 1.3,
                spaceBetween: 30,
                grabCursor: true,
                centeredSlides: true,
                loop: true,
                pagination: { el: ".galeriaSwiper .swiper-pagination", clickable: true },
                breakpoints: {
                    640: { slidesPerView: 2.5 },
                    1024: { slidesPerView: 4.5, spaceBetween: 50 }
                }
            });

            const swiper2 = new Swiper('.testimoSwiper', {
                slidesPerView: 1,
                spaceBetween: 20,
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
