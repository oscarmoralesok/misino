<div class="space-y-8 animate-translate-up pb-12">
    {{-- Unified Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <h2 class="font-display font-bold text-3xl text-gray-800 dark:text-white leading-tight">
                {{ $eventId ? 'Editar Evento' : 'Nuevo Evento' }}
            </h2>
            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1 font-medium">Gestiona los detalles y el presupuesto de tu reserva.</p>
        </div>
        <div class="flex items-center space-x-3 w-full md:w-auto">
            <a href="{{ route('events.index') }}" class="btn-secondary flex-1 md:flex-none justify-center">Cancelar</a>
            <button wire:click="save" class="btn-primary flex-1 md:flex-none justify-center shadow-lg shadow-primary-500/25" wire:loading.attr="disabled">
                <span wire:loading.remove>Guardar Evento</span>
                <span wire:loading>Guardando...</span>
            </button>
        </div>
    </div>

    <div class="space-y-8">
        {{-- Section: Information General --}}
        <div class="premium-card p-6 md:p-8">
            <div class="flex items-center space-x-3 mb-8 border-b border-gray-100 dark:border-gray-700 pb-5">
                <div class="p-2.5 bg-primary-100 dark:bg-primary-900/30 rounded-xl text-primary-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="font-display font-bold text-lg text-gray-800 dark:text-white uppercase tracking-widest">Información General</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Cliente --}}
                <div class="col-span-1 md:col-span-2 lg:col-span-1">
                    <div class="flex justify-between items-center mb-3">
                        <label for="client_id" class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em]">Cliente</label>
                        <a href="{{ route('clients.index') }}" class="text-[10px] font-bold text-primary-500 hover:text-primary-600 uppercase tracking-widest bg-primary-50 dark:bg-primary-900/20 px-2 py-1 rounded-md transition-colors">Nuevo Cliente</a>
                    </div>
                    <select wire:model="client_id" id="client_id" class="input-plain w-full py-3">
                        <option value="">-- Seleccionar Cliente --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                    @error('client_id') <span class="text-accent-500 text-[11px] font-bold mt-2 block">{{ $message }}</span> @enderror
                </div>

                {{-- Event Type --}}
                <div>
                    <label for="event_type_id" class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-3 block">Tipo de Evento</label>
                    <select wire:model="event_type_id" id="event_type_id" class="input-plain w-full py-3">
                        <option value="">-- Seleccionar --</option>
                        @foreach($eventTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('event_type_id') <span class="text-accent-500 text-[11px] font-bold mt-2 block">{{ $message }}</span> @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-3 block">Estado</label>
                    <div class="relative">
                        <select wire:model="status" id="status" class="input-plain w-full py-3 appearance-none">
                            <option value="draft">Borrador</option>
                            <option value="sent">Enviado</option>
                            <option value="pending">Pendiente Confirmar</option>
                            <option value="confirmed">Confirmado</option>
                            <option value="completed">Completado</option>
                            <option value="cancelled">Cancelado</option>
                        </select>
                    </div>
                    @error('status') <span class="text-accent-500 text-[11px] font-bold mt-2 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        {{-- Section: Date & Location --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="premium-card p-6 md:p-8">
                <div class="flex items-center space-x-3 mb-8 border-b border-gray-100 dark:border-gray-700 pb-5">
                    <div class="p-2.5 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl text-emerald-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="font-display font-bold text-lg text-gray-800 dark:text-white uppercase tracking-widest">Fecha y Horario</h3>
                </div>

                <div class="space-y-6">
                    <div>
                        <label for="event_date" class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-3 block">Fecha del Evento</label>
                        <input type="date" wire:model="event_date" id="event_date" class="input-plain w-full py-3">
                        @error('event_date') <span class="text-accent-500 text-[11px] font-bold mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label for="start_time" class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-3 block">Hora Inicio</label>
                            <input type="time" wire:model="start_time" id="start_time" class="input-plain w-full py-3">
                            @error('start_time') <span class="text-accent-500 text-[11px] font-bold mt-2 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="end_time" class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] mb-3 block">Hora Fin</label>
                            <input type="time" wire:model="end_time" id="end_time" class="input-plain w-full py-3">
                            @error('end_time') <span class="text-accent-500 text-[11px] font-bold mt-2 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="premium-card p-6 md:p-8">
                <div class="flex items-center justify-between mb-8 border-b border-gray-100 dark:border-gray-700 pb-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2.5 bg-blue-100 dark:bg-blue-900/30 rounded-xl text-blue-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <h3 class="font-display font-bold text-lg text-gray-800 dark:text-white uppercase tracking-widest">Ubicación</h3>
                    </div>
                    <button type="button" onclick="calculateTransport()" class="text-[10px] font-bold bg-blue-50 dark:bg-blue-900/20 text-blue-600 px-3 py-2 rounded-xl uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-all transform active:scale-95">
                        Calcular Envío
                    </button>
                </div>

                <div class="space-y-4" wire:ignore>
                    <div class="relative">
                        <input type="text" id="address" value="{{ $address }}" class="input-plain w-full py-3 pl-10" placeholder="Buscar dirección o lugar...">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <div id="map" class="w-full h-48 rounded-2xl border border-gray-100 dark:border-gray-700 overflow-hidden shadow-inner bg-gray-50 dark:bg-gray-900/50"></div>
                </div>
                @error('address') <span class="text-accent-500 text-[11px] font-bold mt-2 block">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Section: Items Builder --}}
        <div class="premium-card overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="flex items-center justify-between mb-8 border-b border-gray-100 dark:border-gray-700 pb-5">
                    <div class="flex items-center space-x-3">
                        <div class="p-2.5 bg-amber-100 dark:bg-amber-900/30 rounded-xl text-amber-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                        <h3 class="font-display font-bold text-lg text-gray-800 dark:text-white uppercase tracking-widest">Presupuesto Detallado</h3>
                    </div>
                </div>

                {{-- Desktop View --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em]">
                                <th class="pb-4 w-1/4">Producto / Servicio</th>
                                <th class="pb-4 w-1/3">Descripción Detallada</th>
                                <th class="pb-4 text-center w-20">Cant.</th>
                                <th class="pb-4 text-right w-32">Precio Unit.</th>
                                <th class="pb-4 text-right w-32">Total</th>
                                <th class="pb-4 w-12 text-center"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-gray-800/50">
                            @php $grandTotal = 0; @endphp
                            @foreach($items as $index => $item)
                                @php 
                                    $rowTotal = ((float)($item['quantity'] ?? 0)) * ((float)($item['unit_price'] ?? 0));
                                    $grandTotal += $rowTotal;
                                @endphp
                                <tr wire:key="item-desktop-{{ $index }}" class="group/row hover:bg-gray-50/50 dark:hover:bg-gray-800/20 transition-colors">
                                    <td class="py-5 align-top">
                                        <select wire:model.live="items.{{ $index }}.product_id" class="input-plain w-full py-2.5 text-sm">
                                            <option value="">-- Personalizado --</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="py-5 align-top px-4">
                                        @if($items[$index]['product_id'])
                                            <input type="text" wire:model="items.{{ $index }}.description" class="input-plain w-full py-2.5 text-sm" placeholder="Detalle extra del servicio...">
                                        @else
                                            <div class="space-y-2">
                                                <input type="text" wire:model="items.{{ $index }}.product_name" class="input-plain w-full py-2.5 text-sm font-bold border-primary-200 dark:border-primary-900/40" placeholder="Nombre del ítem (ej: Decoración Especial)">
                                                <input type="text" wire:model="items.{{ $index }}.description" class="input-plain w-full py-2.5 text-xs italic" placeholder="Descripción breve...">
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-5 align-top">
                                        <input type="number" wire:model.live="items.{{ $index }}.quantity" class="input-plain py-2.5 text-sm text-center w-full">
                                    </td>
                                    <td class="py-5 align-top">
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs">$</span>
                                            <input type="number" wire:model.live="items.{{ $index }}.unit_price" class="input-plain py-2.5 pl-7 text-sm text-right w-full">
                                        </div>
                                    </td>
                                    <td class="py-5 align-top text-right pr-4">
                                        <span class="text-sm font-display font-bold text-gray-800 dark:text-gray-200 leading-[44px]">${{ number_format($rowTotal, 2) }}</span>
                                    </td>
                                    <td class="py-5 align-top text-center">
                                        <button type="button" wire:click="removeItem({{ $index }})" class="p-2.5 text-gray-300 hover:text-accent-500 hover:bg-accent-50 dark:hover:bg-accent-900/10 rounded-xl transition-all mt-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile View --}}
                <div class="md:hidden space-y-6">
                    @php $grandTotal = 0; @endphp
                    @foreach($items as $index => $item)
                        @php 
                            $rowTotal = ((float)($item['quantity'] ?? 0)) * ((float)($item['unit_price'] ?? 0));
                            $grandTotal += $rowTotal;
                        @endphp
                        <div wire:key="item-mobile-{{ $index }}" class="p-5 border border-gray-100 dark:border-gray-700/50 rounded-2xl bg-gray-50/50 dark:bg-gray-800/30 space-y-4 relative">
                            <button type="button" wire:click="removeItem({{ $index }})" class="absolute top-4 right-4 p-2 text-accent-300 hover:text-accent-500 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>

                            <div class="space-y-3 pt-2">
                                <div>
                                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest pl-1 mb-1 block">Producto / Servicio</label>
                                    <select wire:model.live="items.{{ $index }}.product_id" class="input-plain w-full py-2.5 text-sm">
                                        <option value="">-- Personalizado --</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest pl-1 mb-1 block">Detalle</label>
                                    @if($items[$index]['product_id'])
                                        <input type="text" wire:model="items.{{ $index }}.description" class="input-plain w-full py-2.5 text-sm" placeholder="Detalle extra...">
                                    @else
                                        <div class="space-y-2">
                                            <input type="text" wire:model="items.{{ $index }}.product_name" class="input-plain w-full py-2.5 text-sm font-bold border-primary-200 dark:border-primary-900/40" placeholder="Nombre del ítem">
                                            <input type="text" wire:model="items.{{ $index }}.description" class="input-plain w-full py-2.5 text-xs" placeholder="Descripción breve...">
                                        </div>
                                    @endif
                                </div>

                                <div class="grid grid-cols-2 gap-4 pt-2">
                                    <div>
                                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest pl-1 mb-1 block text-center">Cantidad</label>
                                        <input type="number" wire:model.live="items.{{ $index }}.quantity" class="input-plain py-2.5 text-sm text-center w-full">
                                    </div>
                                    <div>
                                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest pl-1 mb-1 block text-right">Precio Unit.</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs">$</span>
                                            <input type="number" wire:model.live="items.{{ $index }}.unit_price" class="input-plain py-2.5 pl-7 text-sm text-right w-full">
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-2 flex justify-between items-center border-t border-gray-100 dark:border-gray-700/50 mt-2">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Subtotal Ítem</span>
                                    <span class="text-lg font-display font-bold text-primary-600 dark:text-primary-400">${{ number_format($rowTotal, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 flex justify-center md:justify-start">
                    <button type="button" wire:click="addItem" class="text-[11px] font-bold bg-primary-50 dark:bg-primary-900/20 text-primary-600 dark:text-primary-400 border border-primary-100 dark:border-primary-900/30 px-5 py-2 rounded-2xl uppercase tracking-widest hover:bg-primary-600 hover:text-white transition-all shadow-sm active:scale-95 flex items-center group">
                        <div class="w-5 h-5 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center mr-3 group-hover:bg-white/20 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        Añadir ítem
                    </button>
                </div>

                {{-- Grand Total Section --}}
                <div class="mt-8 bg-gray-50 dark:bg-gray-900/50 -mx-6 md:-mx-8 p-6 md:p-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="text-center md:text-left">
                        <span class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] block mb-1">Inversión Final del Evento</span>
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium italic">Incluye todos los servicios e ítems seleccionados.</p>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="h-12 w-px bg-gray-200 dark:bg-gray-700 hidden md:block"></div>
                        <div class="text-right">
                             <span class="text-4xl font-display font-bold text-primary-600 dark:text-primary-400">
                                <span class="text-xl mr-1 text-primary-400/50">$</span>{{ number_format($grandTotal, 2) }}
                             </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section: Detail & Notes --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="premium-card p-6 md:p-8">
                <div class="flex items-center space-x-2 mb-5">
                    <label for="detail" class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] block">Detalles del Evento</label>
                    <span class="text-[10px] text-primary-500 font-bold bg-primary-50 dark:bg-primary-900/20 px-1.5 py-0.5 rounded uppercase tracking-tighter">Visible para Cliente</span>
                </div>
                <textarea wire:model="detail" id="detail" rows="4" class="input-plain w-full text-sm resize-none" placeholder="Agrega aquí lo que el cliente debe saber, condiciones o reglamentos..."></textarea>
            </div>
            <div class="premium-card p-6 md:p-8">
                <div class="flex items-center space-x-2 mb-5">
                    <label for="notes" class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] block">Notas Internas</label>
                    <span class="text-[10px] text-orange-500 font-bold bg-orange-50 dark:bg-orange-900/20 px-1.5 py-0.5 rounded uppercase tracking-tighter">Solo Uso Interno</span>
                </div>
                <textarea wire:model="notes" id="notes" rows="4" class="input-plain w-full text-sm resize-none" placeholder="Anotaciones para el equipo, logísitca o pendientes..."></textarea>
            </div>
        </div>

        {{-- Section: Images --}}
        <div class="premium-card p-6 md:p-8">
            <div class="flex items-center space-x-3 mb-8 border-b border-gray-100 dark:border-gray-700 pb-5">
                <div class="p-2.5 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl text-indigo-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="font-display font-bold text-lg text-gray-800 dark:text-white uppercase tracking-widest">Galería de Referencia</h3>
            </div>

            <div class="space-y-8">
                {{-- Existing Images Grid --}}
                @if(!empty($existingImages))
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                        @foreach($existingImages as $img)
                            <div class="relative group aspect-square rounded-2xl overflow-hidden shadow-soft ring-1 ring-gray-100 dark:ring-gray-800">
                                <img src="{{ route('storage.serve', ['path' => $img['image_path']]) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute inset-x-0 bottom-0 top-1/2 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-center pb-4">
                                    <button type="button" wire:click="deleteExistingImage({{ $img['id'] }})" class="p-2.5 bg-white text-accent-500 rounded-xl hover:bg-accent-50 transition-colors shadow-xl transform group-hover:translate-y-0 translate-y-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Dropzone --}}
                <div class="relative group">
                    <input type="file" wire:model="newImages" multiple accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div class="border-2 border-dashed border-gray-200 dark:border-gray-700/50 rounded-2xl p-12 text-center group-hover:border-primary-400 group-hover:bg-primary-50/10 transition-all duration-300">
                        <div class="space-y-4">
                            <div class="w-16 h-16 bg-gray-50 dark:bg-gray-800 rounded-2xl flex items-center justify-center mx-auto transition-transform group-hover:scale-110 duration-300">
                                <svg class="w-8 h-8 text-gray-300 group-hover:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-gray-500 uppercase tracking-[0.2em] leading-normal">Subir Referencias Visuales</p>
                                <p class="text-[10px] text-gray-400 font-medium mt-1">Arrastra aquí tus archivos o haz clic para subir</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Uploading Previews --}}
                @if ($newImages)
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 animate-fade-in">
                        @foreach($newImages as $newImg)
                            <div class="relative aspect-square rounded-2xl overflow-hidden shadow-lg ring-2 ring-primary-500/20">
                                <img src="{{ $newImg->temporaryUrl() }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/20 flex items-center justify-center backdrop-blur-[2px]">
                                    <div class="w-12 h-1 bg-white/30 rounded-full overflow-hidden">
                                        <div class="h-full bg-primary-500 animate-pulse w-full"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                @error('newImages.*') <span class="text-accent-500 text-[11px] font-bold block">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Sticky/Float footer actions in mobile if needed, or just normal end --}}
        <div class="flex items-center justify-end space-x-6 pt-6 border-t border-gray-100 dark:border-gray-800">
            <a href="{{ route('events.index') }}" class="text-xs font-bold text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 uppercase tracking-widest transition-colors">Cancelar Cambios</a>
            <button wire:click="save" class="btn-primary shadow-xl shadow-primary-500/25 px-10">
                <span wire:loading.remove>Finalizar Evento</span>
                <span wire:loading>Guardando Datos...</span>
            </button>
        </div>
    </div>

    {{-- Google Maps Script --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDifDBJbSl3yI9WeNoqorVNCmwVunHLVwg&libraries=places&callback=initMap" async defer></script>
    <script>
        let map;
        let marker;
        let autocomplete;

        const originLat = {{ $originLat }};
        const originLng = {{ $originLng }};

        window.initMap = function() {
            const addressInput = document.getElementById('address');
            if(!addressInput) return;

            autocomplete = new google.maps.places.Autocomplete(addressInput, {
                componentRestrictions: { country: 'ar' },
                fields: ['formatted_address', 'geometry']
            });

            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                if (!place.geometry) return;

                const lat = place.geometry.location.lat();
                const lng = place.geometry.location.lng();

                setTimeout(() => {
                    const finalAddress = addressInput.value;
                    @this.set('address', finalAddress);
                    @this.set('latitude', lat);
                    @this.set('longitude', lng);
                }, 50);

                showMap(lat, lng);
            });

            addressInput.addEventListener('input', function(e) {
                @this.set('address', e.target.value);
            });

            const lat = {{ $latitude ?: 'null' }};
            const lng = {{ $longitude ?: 'null' }};
            
            if(lat && lng) {
                showMap(Number(lat), Number(lng));
            }
        }

        function showMap(lat, lng) {
            const mapDiv = document.getElementById('map');
            if(!mapDiv) return;
            
            const location = { lat, lng };
            if (!map) {
                map = new google.maps.Map(mapDiv, {
                    center: location,
                    zoom: 15,
                });
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            } else {
                map.setCenter(location);
                marker.setPosition(location);
            }
        }

        function calculateTransport() {
            const destLat = @this.get('latitude');
            const destLng = @this.get('longitude');

            if (!destLat || !destLng) {
                alert('Por favor, selecciona una dirección válida en el mapa primero.');
                return;
            }

            const origin = new google.maps.LatLng(originLat, originLng);
            const destination = new google.maps.LatLng(destLat, destLng);

            const service = new google.maps.DistanceMatrixService();
            service.getDistanceMatrix(
                {
                    origins: [origin],
                    destinations: [destination],
                    travelMode: google.maps.TravelMode.DRIVING,
                    unitSystem: google.maps.UnitSystem.METRIC,
                }, 
                (response, status) => {
                    if (status !== "OK") {
                        alert("Error al calcular la distancia: " + status);
                        return;
                    }

                    const element = response.rows[0].elements[0];
                    
                    if (element.status === "OK") {
                        const distanceInMeters = element.distance.value;
                        const distanceInKm = distanceInMeters / 1000;
                        @this.call('addTransportCost', distanceInKm);
                    } else {
                        alert("No se pudo calcular la ruta: " + element.status);
                    }
                }
            );
        }

        if (typeof google !== 'undefined' && typeof google.maps !== 'undefined') {
            window.initMap();
        }
    </script>
</div>
