<div class="p-8">
    <div class="flex items-center space-x-3 mb-8 border-b border-gray-100 dark:border-gray-700 pb-4">
        <div class="p-2 bg-primary-100 dark:bg-primary-900/20 rounded-lg text-primary-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h3 class="font-display font-bold text-xl text-gray-800 dark:text-white leading-tight">
            {{ $transactionId ? 'Editar Movimiento' : 'Nuevo Movimiento' }}
        </h3>
    </div>
    
    <form wire:submit="save" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Type --}}
            <div>
                <label for="type" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                    Tipo de Movimiento <span class="text-accent-500">*</span>
                </label>
                <select wire:model="type" id="type" class="input-plain w-full">
                    <option value="income">Ingreso</option>
                    <option value="expense">Gasto</option>
                </select>
                @error('type') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Amount --}}
            <div>
                <label for="amount" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                    Monto <span class="text-accent-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 font-bold">$</span>
                    <input type="number" 
                           wire:model="amount" 
                           id="amount"
                           step="0.01"
                           min="0.01"
                           class="input-plain w-full pl-8 font-display font-bold text-lg"
                           placeholder="0.00">
                </div>
                @error('amount') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Date --}}
            <div>
                <label for="date" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                    Fecha <span class="text-accent-500">*</span>
                </label>
                <input type="date" wire:model="date" id="date" class="input-plain w-full">
                @error('date') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Category --}}
            <div>
                <label for="category_id" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                    Categoría <span class="text-accent-500">*</span>
                </label>
                <select wire:model="category_id" id="category_id" class="input-plain w-full">
                    <option value="">Seleccionar categoría</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Description --}}
            <div class="md:col-span-2">
                <label for="description" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                    Descripción / Concepto <span class="text-accent-500">*</span>
                </label>
                <input type="text" 
                       wire:model="description" 
                       id="description"
                       class="input-plain w-full"
                       placeholder="Ej: Pago de seña, Compra de insumos, etc.">
                @error('description') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Event (Optional) --}}
            <div>
                <label for="event_id" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                    Evento Relacionado (Opcional)
                </label>
                <select wire:model="event_id" id="event_id" class="input-plain w-full">
                    <option value="">Ningún evento específico</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">
                            {{ $event->client?->name ?: 'S/C' }} - {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}
                        </option>
                    @endforeach
                </select>
                @error('event_id') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Payment Method --}}
            <div>
                <label for="payment_method" class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 block">
                    Método de Pago
                </label>
                <select wire:model="payment_method" id="payment_method" class="input-plain w-full">
                    <option value="">Seleccionar método</option>
                    <option value="Efectivo">Efectivo</option>
                    <option value="Transferencia">Transferencia</option>
                    <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
                    <option value="Tarjeta de Débito">Tarjeta de Débito</option>
                    <option value="Cheque">Cheque</option>
                    <option value="Otro">Otro</option>
                </select>
                @error('payment_method') <span class="text-accent-500 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex flex-col sm:flex-row-reverse items-center gap-3 pt-6 border-t border-gray-100 dark:border-gray-700 mt-8">
            <button type="submit" class="btn-primary w-full sm:w-auto shadow-lg shadow-primary-500/20">
                <span wire:loading.remove>{{ $transactionId ? 'Guardar Cambios' : 'Registrar Movimiento' }}</span>
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
