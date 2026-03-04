<div class="p-8">
    <div class="flex items-center space-x-3 mb-8 border-b border-gray-100 dark:border-gray-700 pb-4">
        <div class="p-2 bg-primary-100 dark:bg-primary-900/20 rounded-lg text-primary-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
        </div>
        <h3 class="font-display font-bold text-xl text-gray-800 dark:text-white leading-tight">
            {{ $productId ? 'Editar Producto' : 'Nuevo Producto' }}
        </h3>
    </div>
    
    <form wire:submit="save" class="space-y-6">
        {{-- Name --}}
        <div>
            <label for="name" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                Nombre del Producto <span class="text-accent-500">*</span>
            </label>
            <input type="text" 
                   wire:model="name" 
                   id="name"
                   class="input-plain w-full"
                   placeholder="Ej: Decoración de Mesa Temática">
            @error('name') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                Descripción
            </label>
            <textarea wire:model="description" 
                      id="description"
                      rows="3"
                      class="input-plain w-full"
                      placeholder="Detalla las características del producto o servicio..."></textarea>
            @error('description') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
        </div>

        {{-- Base Price --}}
        <div>
            <label for="base_price" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                Precio Base <span class="text-accent-500">*</span>
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 font-bold">$</span>
                <input type="number" 
                       wire:model="base_price" 
                       id="base_price"
                       step="0.01"
                       min="0"
                       class="input-plain w-full pl-8 font-display font-bold text-lg"
                       placeholder="0.00">
            </div>
            @error('base_price') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col sm:flex-row-reverse items-center gap-3 pt-6 border-t border-gray-100 dark:border-gray-700 mt-8">
            <button type="submit" class="btn-primary w-full sm:w-auto shadow-lg shadow-primary-500/20">
                <span wire:loading.remove>{{ $productId ? 'Guardar Cambios' : 'Crear Producto' }}</span>
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
