<aside class="hidden w-72 overflow-y-auto bg-gray-50/50 dark:bg-gray-900 border-r border-gray-100 dark:border-gray-800 md:block flex-shrink-0 transition-all duration-300">
    <div class="h-24 flex items-center justify-center px-8 mb-4">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
            <x-application-logo class="block h-10 w-auto text-primary-600 transition-transform group-hover:scale-105 duration-300" />
        </a>
    </div>

    <nav class="px-4 pb-8 space-y-6">
        <div>
            <div class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-4 px-4">Menu Principal</div>
            <div class="space-y-1">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                    class="group flex items-center px-4 py-3 rounded-2xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-white text-primary-600 shadow-soft dark:bg-gray-800' : 'text-gray-500 hover:bg-white/50 hover:text-gray-900 dark:hover:bg-gray-800/50 dark:hover:text-gray-100' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-primary-500' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    {{ __('Dashboard') }}
                </x-nav-link>

                <x-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')" 
                    class="group flex items-center px-4 py-3 rounded-2xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('transactions.*') ? 'bg-white text-primary-600 shadow-soft dark:bg-gray-800' : 'text-gray-500 hover:bg-white/50 hover:text-gray-900 dark:hover:bg-gray-800/50 dark:hover:text-gray-100' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('transactions.*') ? 'text-primary-500' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ __('Movimientos') }}
                </x-nav-link>
            </div>
        </div>

        <div>
            <div class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-4 px-4">Eventos & Agenda</div>
            <div class="space-y-1">
                <x-nav-link :href="route('events.create')" :active="request()->routeIs('events.create')" 
                    class="group flex items-center px-4 py-3 rounded-2xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('events.create') ? 'bg-white text-primary-600 shadow-soft dark:bg-gray-800' : 'text-gray-500 hover:bg-white/50 hover:text-gray-900 dark:hover:bg-gray-800/50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('events.create') ? 'text-primary-500' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    {{ __('Nuevo Evento') }}
                </x-nav-link>
                <x-nav-link :href="route('events.index', ['status' => 'pending'])" :active="request()->fullUrlIs(route('events.index', ['status' => 'pending']))" 
                    class="group flex items-center px-4 py-3 rounded-2xl text-sm font-medium transition-all duration-200 {{ request()->fullUrlIs(route('events.index', ['status' => 'pending'])) ? 'bg-orange-50/50 text-orange-600 dark:bg-orange-900/10' : 'text-gray-500 hover:bg-white/50 hover:text-gray-900 dark:hover:bg-gray-800/50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->fullUrlIs(route('events.index', ['status' => 'pending'])) ? 'text-orange-500' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ __('Pendientes') }}
                </x-nav-link>

                <x-nav-link :href="route('events.index', ['status' => 'confirmed'])" :active="request()->fullUrlIs(route('events.index', ['status' => 'confirmed']))" 
                    class="group flex items-center px-4 py-3 rounded-2xl text-sm font-medium transition-all duration-200 {{ request()->fullUrlIs(route('events.index', ['status' => 'confirmed'])) ? 'bg-green-50/50 text-green-600 dark:bg-green-900/10' : 'text-gray-500 hover:bg-white/50 hover:text-gray-900 dark:hover:bg-gray-800/50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->fullUrlIs(route('events.index', ['status' => 'confirmed'])) ? 'text-green-500' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ __('Confirmados') }}
                </x-nav-link>
                
                <x-nav-link :href="route('calendar.index')" :active="request()->routeIs('calendar.*')" 
                    class="group flex items-center px-4 py-3 rounded-2xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('calendar.*') ? 'bg-white text-primary-600 shadow-soft dark:bg-gray-800' : 'text-gray-500 hover:bg-white/50 hover:text-gray-900 dark:hover:bg-gray-800/50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('calendar.*') ? 'text-primary-500' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ __('Calendario') }}
                </x-nav-link>

                <x-nav-link :href="route('logistics.index')" :active="request()->routeIs('logistics.*')" 
                    class="group flex items-center px-4 py-3 rounded-2xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('logistics.*') ? 'bg-white text-primary-600 shadow-soft dark:bg-gray-800' : 'text-gray-500 hover:bg-white/50 hover:text-gray-900 dark:hover:bg-gray-800/50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('logistics.*') ? 'text-primary-500' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    {{ __('Logística') }}
                </x-nav-link>
            </div>
        </div>

        <div>
            <div class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-4 px-4">Administración</div>
            <div class="space-y-1">
                <x-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')" 
                    class="group flex items-center px-4 py-3 rounded-2xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('clients.*') ? 'bg-white text-primary-600 shadow-soft dark:bg-gray-800' : 'text-gray-500 hover:bg-white/50 hover:text-gray-900 dark:hover:bg-gray-800/50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('clients.*') ? 'text-primary-500' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    {{ __('Clientes') }}
                </x-nav-link>

                <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" 
                    class="group flex items-center px-4 py-3 rounded-2xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('products.*') ? 'bg-white text-primary-600 shadow-soft dark:bg-gray-800' : 'text-gray-500 hover:bg-white/50 hover:text-gray-900 dark:hover:bg-gray-800/50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('products.*') ? 'text-primary-500' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    {{ __('Catálogo') }}
                </x-nav-link>
                
                <x-nav-link :href="route('event-types.index')" :active="request()->routeIs('event-types.*')" 
                    class="group flex items-center px-4 py-3 rounded-2xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('event-types.*') ? 'bg-white text-primary-600 shadow-soft dark:bg-gray-800' : 'text-gray-500 hover:bg-white/50 hover:text-gray-900 dark:hover:bg-gray-800/50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('event-types.*') ? 'text-primary-500' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    {{ __('Tipos de Evento') }}
                </x-nav-link>

                <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" 
                    class="group flex items-center px-4 py-3 rounded-2xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('users.*') ? 'bg-white text-primary-600 shadow-soft dark:bg-gray-800' : 'text-gray-500 hover:bg-white/50 hover:text-gray-900 dark:hover:bg-gray-800/50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('users.*') ? 'text-primary-500' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    {{ __('Usuarios') }}
                </x-nav-link>

                <x-nav-link :href="route('settings.index')" :active="request()->routeIs('settings.*')" 
                    class="group flex items-center px-4 py-3 rounded-2xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('settings.*') ? 'bg-white text-primary-600 shadow-soft dark:bg-gray-800' : 'text-gray-500 hover:bg-white/50 hover:text-gray-900 dark:hover:bg-gray-800/50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('settings.*') ? 'text-primary-500' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    {{ __('Configuración') }}
                </x-nav-link>
            </div>
        </div>
    </nav>
</aside>
