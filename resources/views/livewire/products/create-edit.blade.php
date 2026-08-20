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
        {{-- Image Upload --}}
        <div>
            <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                Foto de Muestra
            </label>
            <div class="flex items-start gap-4">
                {{-- Preview --}}
                <div class="w-24 h-24 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700 flex items-center justify-center overflow-hidden bg-gray-50 dark:bg-gray-900/30 flex-shrink-0">
                    @if($photo)
                        <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-cover rounded-2xl">
                    @elseif($existingImage)
                        <img src="{{ $existingImage }}" class="w-full h-full object-cover rounded-2xl">
                    @else
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    @endif
                </div>

                <div class="flex-1 space-y-2">
                    <label for="photo-upload-{{ $productId ?? 'new' }}" class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 text-xs font-bold rounded-xl hover:bg-gray-200 dark:hover:bg-gray-700 transition-all cursor-pointer">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        Subir Foto
                    </label>
                    <input type="file" wire:model="photo" id="photo-upload-{{ $productId ?? 'new' }}" class="hidden" accept="image/*">
                    
                    @if($existingImage || $photo)
                        <button type="button" wire:click="removeImage" class="text-[11px] font-bold text-accent-500 hover:text-accent-600 transition-colors">
                            Eliminar foto
                        </button>
                    @endif

                    <div wire:loading wire:target="photo" class="text-[11px] text-primary-500 font-bold">
                        Subiendo...
                    </div>
                </div>
            </div>
            @error('photo') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
        </div>

        {{-- SVG Upload --}}
        <div>
            <label class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                Forma Vectorial (SVG)
            </label>
            <div class="flex items-start gap-4">
                {{-- Preview --}}
                <div class="w-24 h-24 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700 flex items-center justify-center overflow-hidden bg-gray-50 dark:bg-gray-900/30 flex-shrink-0">
                    @if($svg_file)
                        <img src="{{ $svg_file->temporaryUrl() }}" class="w-full h-full object-contain p-2">
                    @elseif($existingSvg)
                        <img src="{{ $existingSvg }}" class="w-full h-full object-contain p-2">
                    @else
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    @endif
                </div>

                <div class="flex-1 space-y-2">
                    <label for="svg-upload-{{ $productId ?? 'new' }}" class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 text-xs font-bold rounded-xl hover:bg-gray-200 dark:hover:bg-gray-700 transition-all cursor-pointer">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        Subir SVG
                    </label>
                    <input type="file" wire:model="svg_file" id="svg-upload-{{ $productId ?? 'new' }}" class="hidden" accept=".svg, image/svg+xml">
                    
                    @if($existingSvg || $svg_file)
                        <button type="button" wire:click="removeSvg" class="text-[11px] font-bold text-accent-500 hover:text-accent-600 transition-colors">
                            Eliminar forma
                        </button>
                    @endif

                    <div wire:loading wire:target="svg_file" class="text-[11px] text-primary-500 font-bold">
                        Subiendo...
                    </div>
                </div>
            </div>
            @error('svg_file') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
        </div>

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

        {{-- Show in Web Toggle --}}
        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-900/30 rounded-2xl border border-gray-100 dark:border-gray-800">
            <div>
                <p class="text-sm font-bold text-gray-800 dark:text-white">Mostrar en la Web</p>
                <p class="text-[11px] text-gray-400 mt-0.5">Los clientes podrán ver este producto en el catálogo público.</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" wire:model="show_in_web" class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-500"></div>
            </label>
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
