<div class="p-8">
    <div class="flex items-center space-x-3 mb-8 border-b border-gray-100 dark:border-gray-700 pb-4">
        <div class="p-2 bg-primary-100 dark:bg-primary-900/20 rounded-lg text-primary-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
        </div>
        <h3 class="font-display font-bold text-xl text-gray-800 dark:text-white leading-tight">
            {{ $eventTypeId ? 'Editar Tipo de Evento' : 'Nuevo Tipo de Evento' }}
        </h3>
    </div>
    
    <form wire:submit="save" class="space-y-6">
        <div>
            <label for="name" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                Nombre de la Categoría <span class="text-accent-500">*</span>
            </label>
            <input type="text" 
                   wire:model="name" 
                   id="name"
                   class="input-plain w-full"
                   placeholder="Ej: Boda, Cumpleaños, Corporativo...">
            @error('name') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col sm:flex-row-reverse items-center gap-3 pt-6 border-t border-gray-100 dark:border-gray-700 mt-8">
            <button type="submit" class="btn-primary w-full sm:w-auto shadow-lg shadow-primary-500/20">
                <span wire:loading.remove>{{ $eventTypeId ? 'Guardar Cambios' : 'Crear Categoría' }}</span>
                <span wire:loading>Procesando...</span>
            </button>
            <button type="button" 
                    wire:click="$dispatch('close-modal')"
                    class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors px-6">
                Cancelar
            </button>
        </div>
    </form>
</div>
