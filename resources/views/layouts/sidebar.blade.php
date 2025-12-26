<aside class="hidden w-64 overflow-y-auto bg-gray-100 border-r border-gray-100 md:block flex-shrink-0">
    <div class="h-16 flex items-center justify-center border-b border-gray-50 px-6">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-10 w-auto" />
        </a>
    </div>

    <div class="p-4 space-y-2">
        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 px-2">Menu</div>
        
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="w-full flex items-center px-4 py-3 rounded-full transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-white text-teal-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            {{ __('Dashboard') }}
        </x-nav-link>

        <x-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')" class="w-full flex items-center px-4 py-3 rounded-full transition-colors duration-200 {{ request()->routeIs('transactions.*') ? 'bg-white text-teal-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ __('Movimientos') }}
        </x-nav-link>

        <div class="pt-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 px-2">Eventos</div>

        <x-nav-link :href="route('events.index', ['status' => 'pending'])" :active="request()->fullUrlIs(route('events.index', ['status' => 'pending']))" class="w-full flex items-center px-4 py-3 rounded-full transition-colors duration-200 {{ request()->fullUrlIs(route('events.index', ['status' => 'pending'])) ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ __('Pendientes') }}
        </x-nav-link>

        <x-nav-link :href="route('events.index', ['status' => 'confirmed'])" :active="request()->fullUrlIs(route('events.index', ['status' => 'confirmed']))" class="w-full flex items-center px-4 py-3 rounded-full transition-colors duration-200 {{ request()->fullUrlIs(route('events.index', ['status' => 'confirmed'])) ? 'bg-green-50 text-green-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ __('Confirmados') }}
        </x-nav-link>
        
        <x-nav-link :href="route('calendar.index')" :active="request()->routeIs('calendar.*')" class="w-full flex items-center px-4 py-3 rounded-full transition-colors duration-200 {{ request()->routeIs('calendar.*') ? 'bg-white text-teal-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            {{ __('Calendario') }}
        </x-nav-link>

        <div class="pt-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 px-2">Gestión</div>

        <x-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')" class="w-full flex items-center px-4 py-3 rounded-full transition-colors duration-200 {{ request()->routeIs('clients.*') ? 'bg-white text-teal-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            {{ __('Clientes') }}
        </x-nav-link>

        <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" class="w-full flex items-center px-4 py-3 rounded-full transition-colors duration-200 {{ request()->routeIs('products.*') ? 'bg-white text-teal-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            {{ __('Catálogo') }}
        </x-nav-link>
        
        <x-nav-link :href="route('event-types.index')" :active="request()->routeIs('event-types.*')" class="w-full flex items-center px-4 py-3 rounded-full transition-colors duration-200 {{ request()->routeIs('event-types.*') ? 'bg-white text-teal-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
            {{ __('Tipos de Evento') }}
        </x-nav-link>

        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" class="w-full flex items-center px-4 py-3 rounded-full transition-colors duration-200 {{ request()->routeIs('users.*') ? 'bg-white text-teal-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            {{ __('Usuarios') }}
        </x-nav-link>
    </div>

</aside>
