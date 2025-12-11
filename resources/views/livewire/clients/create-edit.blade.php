<div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
    <div class="sm:flex sm:items-start">
        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100 mb-4">
                {{ $clientId ? 'Editar Cliente' : 'Nuevo Cliente' }}
            </h3>
            
            <form wire:submit="save">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Name --}}
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nombre del Cliente *
                        </label>
                        <input type="text" 
                               wire:model="name" 
                               id="name"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                               placeholder="Nombre completo o empresa">
                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Teléfono *
                        </label>
                        <input type="tel" 
                               wire:model="phone" 
                               id="phone"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                               placeholder="+54 9 11 1234-5678">
                        @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Email
                        </label>
                        <input type="email" 
                               wire:model="email" 
                               id="email"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                               placeholder="cliente@ejemplo.com">
                        @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Instagram --}}
                    <div class="md:col-span-2">
                        <label for="instagram" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Instagram
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 dark:text-gray-400">@</span>
                            <input type="text" 
                                   wire:model="instagram" 
                                   id="instagram"
                                   class="mt-1 block w-full pl-7 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                   placeholder="usuario_instagram">
                        </div>
                        @error('instagram') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Contact Section --}}
                    <div class="md:col-span-2 border-t border-gray-200 dark:border-gray-600 pt-4 mt-2">
                        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Contacto Adicional (Opcional)</h4>
                    </div>

                    {{-- Contact Name --}}
                    <div>
                        <label for="contact_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nombre de Contacto
                        </label>
                        <input type="text" 
                               wire:model="contact_name" 
                               id="contact_name"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                               placeholder="Ej: María López">
                        @error('contact_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Contact Relationship --}}
                    <div>
                        <label for="contact_relationship" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Relación
                        </label>
                        <input type="text" 
                               wire:model="contact_relationship" 
                               id="contact_relationship"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                               placeholder="Ej: Madre, Esposo, Asistente">
                        @error('contact_relationship') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Contact Phone --}}
                    <div class="md:col-span-2">
                        <label for="contact_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Teléfono de Contacto
                        </label>
                        <input type="tel" 
                               wire:model="contact_phone" 
                               id="contact_phone"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                               placeholder="+54 9 11 1234-5678">
                        @error('contact_phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        {{ $clientId ? 'Actualizar' : 'Crear' }}
                    </button>
                    @if(!$clientId)
                    <button type="button"
                            wire:click="saveAndCreateEvent"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Guardar y Crear Evento
                    </button>
                    @endif
                    <button type="button"
                            wire:click="$dispatch('close-modal')"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
