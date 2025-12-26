<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form wire:submit="save">
                    
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">{{ $eventId ? 'Editar Evento' : 'Nuevo Evento' }}</h2>
                    </div>

                    {{-- Header --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        {{-- Cliente --}}
                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <label for="client_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cliente</label>
                                <a href="{{ route('clients.index') }}" class="text-xs text-indigo-600 hover:text-indigo-500">Crear Nuevo Cliente</a>
                            </div>
                            <select wire:model="client_id" id="client_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                <option value="">-- Seleccionar Cliente --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                            @error('client_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        {{-- Estado --}}
                         <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
                            <select wire:model="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                <option value="draft">Borrador</option>
                                <option value="sent">Enviado</option>
                                <option value="pending">Pendiente Confirmar</option>
                                <option value="confirmed">Confirmado</option>
                                <option value="completed">Completado</option>
                                <option value="cancelled">Cancelado</option>
                            </select>
                            @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                         {{-- Event Date --}}
                        <div>
                            <label for="event_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha del Evento</label>
                            <input type="date" wire:model="event_date" id="event_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('event_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        {{-- Service Type --}}
                        <div>
                            <label for="service_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de Servicio</label>
                            <select wire:model="service_type" id="service_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                <option value="">-- Seleccionar --</option>
                                <option value="rental">Alquiler</option>
                                <option value="decoration">Decoración</option>
                            </select>
                            @error('service_type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                         {{-- Event Type --}}
                        <div>
                            <label for="event_type_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de Evento</label>
                            <select wire:model="event_type_id" id="event_type_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                <option value="">-- Seleccionar --</option>
                                @foreach($eventTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('event_type_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Time Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hora Inicio</label>
                            <input type="time" wire:model="start_time" id="start_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('start_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hora Fin</label>
                            <input type="time" wire:model="end_time" id="end_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            @error('end_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Address with Google Maps Integration (via Alpine/Wire) --}}
                    <div class="mb-6" wire:ignore>
                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dirección del Evento</label>
                        <input type="text" 
                               id="address" 
                               wire:model="address"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                               placeholder="Buscar dirección...">
                        @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        
                        <div id="map" class="mt-3 rounded-lg border border-gray-300 dark:border-gray-600" style="height: 300px;"></div>
                    </div>

                    {{-- Items Builder --}}
                    <div class="mb-6">
                        <h3 class="text-lg font-bold mb-4">Ítems / Presupuesto</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase w-1/4">Producto</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase w-1/3">Detalle</th>
                                        <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase w-24">Cant.</th>
                                        <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase w-32">Precio Unit.</th>
                                        <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase w-32">Total</th>
                                        <th class="px-3 py-2 w-10"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @php $grandTotal = 0; @endphp
                                    @foreach($items as $index => $item)
                                        @php 
                                            $rowTotal = ((float)($item['quantity'] ?? 0)) * ((float)($item['unit_price'] ?? 0));
                                            $grandTotal += $rowTotal;
                                        @endphp
                                        <tr wire:key="item-{{ $index }}">
                                            <td class="px-3 py-2">
                                                <select wire:model.live="items.{{ $index }}.product_id" class="block w-full text-sm rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                                    <option value="">-- Personalizado --</option>
                                                    @foreach($products as $product)
                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="px-3 py-2">
                                                @if($items[$index]['product_id'])
                                                    {{-- If product selected, show readonly name or just imply it --}}
                                                    {{-- User said: "el nombre del producto siempre tiene q aparecer basándose en la relación" --}}
                                                    {{-- The Select already shows the name. So here we just need the Detail input. --}}
                                                    <input type="text" wire:model="items.{{ $index }}.description" class="block w-full text-sm rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" placeholder="Detalle adicional (Opcional)">
                                                @else
                                                    {{-- Custom Item: Need Name AND Detail? Or just Name acts as main desc? --}}
                                                    {{-- Let's give them both if they want, but Product Name is required for custom items. --}}
                                                    <input type="text" wire:model="items.{{ $index }}.product_name" class="block w-full text-sm mb-1 rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 placeholder-indigo-300" placeholder="Nombre del Ítem (Requerido)">
                                                    @error("items.{$index}.product_name") <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                                                    
                                                    <input type="text" wire:model="items.{{ $index }}.description" class="block w-full text-sm rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" placeholder="Detalle adicional">
                                                @endif
                                            </td>
                                            <td class="px-3 py-2">
                                                <input type="number" wire:model.live="items.{{ $index }}.quantity" min="1" class="block w-full text-sm text-right rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                            </td>
                                            <td class="px-3 py-2">
                                                <input type="number" wire:model.live="items.{{ $index }}.unit_price" step="0.01" min="0" class="block w-full text-sm text-right rounded-md border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                            </td>
                                            <td class="px-3 py-2 text-right font-bold dark:text-gray-300">
                                                ${{ number_format($rowTotal, 2) }}
                                            </td>
                                            <td class="px-3 py-2 text-center">
                                                <button type="button" wire:click="removeItem({{ $index }})" class="text-red-500 hover:text-red-700 font-bold">X</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gray-50 dark:bg-gray-700 font-bold">
                                        <td colspan="4" class="px-3 py-4 text-right">Total Evento:</td>
                                        <td class="px-3 py-4 text-right text-indigo-600 dark:text-indigo-400">${{ number_format($grandTotal, 2) }}</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <button type="button" wire:click="addItem" class="mt-2 text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-bold">
                                + Agregar Ítem
                            </button>
                        </div>
                    </div>

                    {{-- Detail & Notes --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="detail" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Detalle del Evento</label>
                            <textarea wire:model="detail" id="detail" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"></textarea>
                            @error('detail') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notas Privadas / Condiciones</label>
                            <textarea wire:model="notes" id="notes" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"></textarea>
                        </div>
                    </div>

                    {{-- Images --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Imágenes de Referencia</label>
                        
                        {{-- Existing --}}
                        @if(!empty($existingImages))
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                                @foreach($existingImages as $img)
                                    <div class="relative group">
                                        <img src="{{ route('storage.serve', ['path' => $img['image_path']]) }}" class="w-full h-32 object-cover rounded border border-gray-300 dark:border-gray-600">
                                        <button type="button" 
                                                wire:click="deleteExistingImage({{ $img['id'] }})"
                                                class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 opacity-0 group-hover:opacity-100 transition-opacity">
                                            X
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- New Uploads --}}
                        <input type="file" wire:model="newImages" multiple accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900 dark:file:text-indigo-300">
                        @error('newImages.*') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        @if ($newImages)
                            <div class="mt-2 grid grid-cols-2 md:grid-cols-4 gap-3">
                                @foreach($newImages as $newImg)
                                    <div class="relative">
                                        <img src="{{ $newImg->temporaryUrl() }}" class="w-full h-32 object-cover rounded border">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('events.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 mr-4">Cancelar</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded" wire:loading.attr="disabled">
                            <span wire:loading.remove>Guardar Evento</span>
                            <span wire:loading>Guardando...</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- Google Maps Script --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDifDBJbSl3yI9WeNoqorVNCmwVunHLVwg&libraries=places&callback=initMap" async defer></script>
    <script>
        let map;
        let marker;
        let autocomplete;

        function initMap() {
            const addressInput = document.getElementById('address');
            if(!addressInput) return;

            // Setup Autocomplete
            autocomplete = new google.maps.places.Autocomplete(addressInput, {
                componentRestrictions: { country: 'ar' },
                fields: ['formatted_address', 'geometry']
            });

            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                if (!place.geometry) return;

                const lat = place.geometry.location.lat();
                const lng = place.geometry.location.lng();

                // Update Livewire
                @this.set('address', place.formatted_address);
                @this.set('latitude', lat);
                @this.set('longitude', lng);

                showMap(lat, lng);
            });

            // Check existing coordinates
            const lat = @this.get('latitude');
            const lng = @this.get('longitude');
            if(lat && lng) {
                showMap(parseFloat(lat), parseFloat(lng));
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
    </script>
</div>
