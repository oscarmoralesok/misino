<nav x-data="{ open: false }" class="md:hidden bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 sticky top-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="px-6 py-4">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}" class="group">
                    <x-application-logo class="block h-9 w-auto text-primary-600 transition-transform group-hover:scale-105 duration-300" />
                </a>
            </div>

            <!-- Mobile Controls -->
            <div class="flex items-center space-x-4">
                <!-- Hamburger -->
                <button @click="open = ! open" class="p-2.5 rounded-2xl bg-gray-50 dark:bg-gray-800 text-gray-500 hover:text-primary-600 transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12H10M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block animate-fade-in': open, 'hidden': ! open}" class="hidden lg:hidden border-t border-gray-50 dark:border-gray-800">
        <div class="px-6 py-8 space-y-8 max-h-[calc(100vh-80px)] overflow-y-auto">
            
            <!-- Menu Principal -->
            <div class="space-y-4">
                <div class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] px-2">Menu Principal</div>
                <div class="grid grid-cols-1 gap-2">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center p-4 rounded-2xl {{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-600 border-none' : 'text-gray-600 dark:text-gray-300 border-none hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span class="font-bold text-sm">{{ __('Dashboard') }}</span>
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')" class="flex items-center p-4 rounded-2xl {{ request()->routeIs('transactions.*') ? 'bg-primary-50 text-primary-600 border-none' : 'text-gray-600 dark:text-gray-300 border-none hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-bold text-sm">{{ __('Movimientos') }}</span>
                    </x-responsive-nav-link>
                </div>
            </div>

            <!-- Eventos & Agenda -->
            <div class="space-y-4">
                <div class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] px-2">Eventos & Agenda</div>
                <div class="grid grid-cols-1 gap-2">
                    <x-responsive-nav-link :href="route('events.index', ['status' => 'pending'])" :active="request()->fullUrlIs(route('events.index', ['status' => 'pending']))" class="flex items-center p-4 rounded-2xl {{ request()->fullUrlIs(route('events.index', ['status' => 'pending'])) ? 'bg-orange-50 text-orange-600 border-none' : 'text-gray-600 dark:text-gray-300 border-none hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-bold text-sm">{{ __('Pendientes') }}</span>
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('events.index', ['status' => 'confirmed'])" :active="request()->fullUrlIs(route('events.index', ['status' => 'confirmed']))" class="flex items-center p-4 rounded-2xl {{ request()->fullUrlIs(route('events.index', ['status' => 'confirmed'])) ? 'bg-green-50 text-green-600 border-none' : 'text-gray-600 dark:text-gray-300 border-none hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-bold text-sm">{{ __('Confirmados') }}</span>
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('calendar.index')" :active="request()->routeIs('calendar.*')" class="flex items-center p-4 rounded-2xl {{ request()->routeIs('calendar.*') ? 'bg-primary-50 text-primary-600 border-none' : 'text-gray-600 dark:text-gray-300 border-none hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z"></path></svg>
                        <span class="font-bold text-sm">{{ __('Calendario') }}</span>
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('logistics.index')" :active="request()->routeIs('logistics.*')" class="flex items-center p-4 rounded-2xl {{ request()->routeIs('logistics.*') ? 'bg-primary-50 text-primary-600 border-none' : 'text-gray-600 dark:text-gray-300 border-none hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        <span class="font-bold text-sm">{{ __('Logística') }}</span>
                    </x-responsive-nav-link>
                </div>
            </div>

            <!-- Administración -->
            <div class="space-y-4 pb-12">
                <div class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] px-2">Administración</div>
                <div class="grid grid-cols-1 gap-2">
                    <x-responsive-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')" class="flex items-center p-4 rounded-2xl {{ request()->routeIs('clients.*') ? 'bg-primary-50 text-primary-600 border-none' : 'text-gray-600 dark:text-gray-300 border-none hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span class="font-bold text-sm">{{ __('Clientes') }}</span>
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" class="flex items-center p-4 rounded-2xl {{ request()->routeIs('products.*') ? 'bg-primary-50 text-primary-600 border-none' : 'text-gray-600 dark:text-gray-300 border-none hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        <span class="font-bold text-sm">{{ __('Catálogo') }}</span>
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('event-types.index')" :active="request()->routeIs('event-types.*')" class="flex items-center p-4 rounded-2xl {{ request()->routeIs('event-types.*') ? 'bg-primary-50 text-primary-600 border-none' : 'text-gray-600 dark:text-gray-300 border-none hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        <span class="font-bold text-sm">{{ __('Tipos de Evento') }}</span>
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" class="flex items-center p-4 rounded-2xl {{ request()->routeIs('users.*') ? 'bg-primary-50 text-primary-600 border-none' : 'text-gray-600 dark:text-gray-300 border-none hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <span class="font-bold text-sm">{{ __('Usuarios') }}</span>
                    </x-responsive-nav-link>
                </div>
            </div>
        </div>

        <!-- Responsive Settings Options -->
        <div class="px-6 py-6 border-t border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-900/50">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 rounded-2xl bg-primary-600 flex items-center justify-center text-white font-display font-bold shadow-soft">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="text-sm font-bold text-gray-800 dark:text-gray-100 leading-none">{{ Auth::user()->name }}</div>
                    <div class="text-[10px] text-gray-400 font-medium uppercase mt-1">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-2">
                <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center p-4 rounded-2xl text-gray-600 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-800 border-none transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span class="font-bold text-sm">{{ __('Mi Perfil') }}</span>
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center p-4 rounded-2xl text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10 border-none transition-all">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span class="font-bold text-sm">{{ __('Cerrar Sesión') }}</span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
