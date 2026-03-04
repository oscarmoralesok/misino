<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <a href="{{ route('users.index') }}" class="p-2 bg-gray-100 dark:bg-gray-800 rounded-xl text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="font-display font-bold text-3xl text-gray-800 dark:text-white leading-tight">Nuevo Usuario</h2>
                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Registra un nuevo perfil con acceso al sistema.</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="premium-card p-10">
            <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                        Nombre Completo <span class="text-accent-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                           class="input-plain w-full" 
                           placeholder="Ej: Juan Pérez"
                           required>
                    @error('name') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="email" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                        Correo Electrónico <span class="text-accent-500">*</span>
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" 
                           class="input-plain w-full" 
                           placeholder="usuario@ejemplo.com"
                           required>
                    @error('email') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                            Contraseña <span class="text-accent-500">*</span>
                        </label>
                        <input type="password" name="password" id="password" 
                               class="input-plain w-full" 
                               required>
                        @error('password') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                            Confirmar Contraseña <span class="text-accent-500">*</span>
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                               class="input-plain w-full" 
                               required>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row-reverse items-center gap-3 pt-8 border-t border-gray-100 dark:border-gray-700 mt-8">
                    <button type="submit" class="btn-primary w-full sm:w-auto shadow-lg shadow-primary-500/20">
                        Crear Usuario
                    </button>
                    <a href="{{ route('users.index') }}" 
                       class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors px-6">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
