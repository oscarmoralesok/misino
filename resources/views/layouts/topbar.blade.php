<header class="py-4 px-8 hidden md:flex justify-between items-center sticky top-0 z-30 transition-all duration-300">
    <!-- Left: Welcome Search or Page Title -->
    <div>
        <h2 class="text-sm font-medium text-gray-400 dark:text-gray-500 uppercase tracking-widest">{{ now()->translatedFormat('l, d F') }}</h2>
    </div>

    <!-- Right: Actions -->
    <div class="flex items-center space-x-6">
        <!-- Theme Switcher Refined -->
        <div x-data="{ 
            theme: localStorage.theme || 'system',
            setTheme(val) {
                this.theme = val;
                localStorage.theme = val;
                if (val === 'dark' || (val === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }
        }" x-init="$watch('theme', val => setTheme(val)); setTheme(theme)" class="flex items-center bg-gray-100/50 dark:bg-gray-800/50 backdrop-blur-sm rounded-2xl p-1 border border-gray-200/50 dark:border-gray-700/50">
            <button @click="setTheme('light')" :class="{ 'bg-white text-primary-600 shadow-soft': theme === 'light', 'text-gray-400 hover:text-gray-600': theme !== 'light' }" class="p-1.5 rounded-xl transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </button>
            <button @click="setTheme('system')" :class="{ 'bg-white text-primary-600 shadow-soft': theme === 'system', 'text-gray-400 hover:text-gray-600': theme !== 'system' }" class="p-1.5 rounded-xl transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </button>
            <button @click="setTheme('dark')" :class="{ 'bg-white text-primary-600 shadow-soft': theme === 'dark', 'text-gray-400 hover:text-gray-600': theme !== 'dark' }" class="p-1.5 rounded-xl transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            </button>
        </div>

        <!-- Notification Refined -->
        <button class="relative p-2.5 text-gray-400 hover:text-primary-500 transition-all duration-200 group">
            <span class="absolute top-2.5 right-2.5 h-2 w-2 rounded-full bg-accent-500 border-2 border-white dark:border-gray-900 group-hover:scale-110 transition-transform"></span>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
        </button>

        <!-- User Dropdown Premium -->
        <x-dropdown align="right" width="56">
            <x-slot name="trigger">
                <button class="flex items-center space-x-3 p-1 rounded-2xl border border-transparent hover:border-gray-200 dark:hover:border-gray-700 transition-all duration-200 focus:outline-none">
                    <div class="w-10 h-10 rounded-2xl bg-primary-600 flex items-center justify-center text-white font-display font-bold shadow-soft">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="hidden md:block text-left">
                        <div class="text-sm font-bold text-gray-800 dark:text-gray-100 leading-none">{{ Auth::user()->name }}</div>
                        <div class="text-[10px] text-gray-400 font-medium uppercase mt-1">{{ Auth::user()->email }}</div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Cuenta</p>
                    <p class="text-sm font-bold text-gray-800 dark:text-gray-100 truncate">{{ Auth::user()->name }}</p>
                </div>
                
                <x-dropdown-link :href="route('profile.edit')" class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    {{ __('Mi Perfil') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                            class="flex items-center px-4 py-3 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        {{ __('Cerrar Sesión') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</header>
