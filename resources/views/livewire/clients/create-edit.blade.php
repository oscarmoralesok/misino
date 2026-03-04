<div class="p-8">
    <div class="flex items-center space-x-3 mb-8 border-b border-gray-100 dark:border-gray-700 pb-4">
        <div class="p-2 bg-primary-100 dark:bg-primary-900/20 rounded-lg text-primary-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
        </div>
        <h3 class="font-display font-bold text-xl text-gray-800 dark:text-white leading-tight">
            {{ $clientId ? 'Editar Cliente' : 'Nuevo Cliente' }}
        </h3>
    </div>
    
    <form wire:submit="save" class="space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Name --}}
            <div class="md:col-span-2">
                <label for="name" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                    Nombre del Cliente / Empresa <span class="text-accent-500">*</span>
                </label>
                <input type="text" 
                       wire:model="name" 
                       id="name"
                       class="input-plain w-full"
                       placeholder="Nombre completo o razón social">
                @error('name') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Phone --}}
            <div>
                <label for="phone" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                    Teléfono <span class="text-accent-500">*</span>
                </label>
                <input type="tel" 
                       wire:model="phone" 
                       id="phone"
                       class="input-plain w-full"
                       placeholder="+54 9 11 ...">
                @error('phone') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                    Email
                </label>
                <input type="email" 
                       wire:model="email" 
                       id="email"
                       class="input-plain w-full"
                       placeholder="ejemplo@correo.com">
                @error('email') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Instagram --}}
            <div class="md:col-span-2">
                <label for="instagram" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                    Instagram
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 font-bold">@</span>
                    <input type="text" 
                           wire:model="instagram" 
                           id="instagram"
                           class="input-plain w-full pl-9"
                           placeholder="usuario_instagram">
                </div>
                @error('instagram') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Contact Section Header --}}
            <div class="md:col-span-2 pt-4 flex items-center space-x-3 mb-2">
                <div class="h-px bg-gray-100 dark:bg-gray-700 flex-1"></div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] whitespace-nowrap">Contacto Adicional (Opcional)</span>
                <div class="h-px bg-gray-100 dark:bg-gray-700 flex-1"></div>
            </div>

            {{-- Contact Name --}}
            <div>
                <label for="contact_name" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                    Nombre Referido
                </label>
                <input type="text" 
                       wire:model="contact_name" 
                       id="contact_name"
                       class="input-plain w-full"
                       placeholder="Nombre de contacto alternativo">
                @error('contact_name') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Contact Relationship --}}
            <div>
                <label for="contact_relationship" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                    Vínculo / Relación
                </label>
                <input type="text" 
                       wire:model="contact_relationship" 
                       id="contact_relationship"
                       class="input-plain w-full"
                       placeholder="Padre, Asistente, Amigo...">
                @error('contact_relationship') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Contact Phone --}}
            <div class="md:col-span-2">
                <label for="contact_phone" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                    Teléfono Alternativo
                </label>
                <input type="tel" 
                       wire:model="contact_phone" 
                       id="contact_phone"
                       class="input-plain w-full"
                       placeholder="Segundo número de contacto">
                @error('contact_phone') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex flex-col sm:flex-row-reverse items-center gap-3 pt-6 border-t border-gray-100 dark:border-gray-700">
            <button type="submit" class="btn-primary w-full sm:w-auto shadow-lg shadow-primary-500/20">
                <span wire:loading.remove>{{ $clientId ? 'Guardar Cambios' : 'Crear Cliente' }}</span>
                <span wire:loading>Procesando...</span>
            </button>
            
            @if(!$clientId)
                <button type="button" 
                        wire:click="saveAndCreateEvent"
                        class="btn-secondary w-full sm:w-auto text-emerald-600 dark:text-emerald-400 border-emerald-100 dark:border-emerald-900/30 hover:bg-emerald-50 dark:hover:bg-emerald-900/20">
                    Guardar y Nuevo Evento
                </button>
            @endif

            <button type="button" 
                    wire:click="$dispatch('close-modal')"
                    class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors px-6">
                Cancelar
            </button>
        </div>
    </form>
</div>
