<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Logística Diaria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Date Filter --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 p-6">
                <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 font-bold mb-2">Seleccionar Fecha</label>
                <input type="date" wire:model.live="date" id="date" class="block w-full md:w-1/3 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
            </div>

            {{-- Events List --}}
            <div class="space-y-6">
                @forelse($events as $event)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-indigo-500">
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $event->client->name ?? 'Sin Cliente' }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $event->eventType->name ?? 'General' }} | 
                                        {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                                    </p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 mt-1">
                                        {{ strtoupper($event->status) }}
                                    </span>
                                </div>
                                <div class="mt-4 md:mt-0 text-right">
                                    @if($event->address)
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-1 max-w-xs truncate">{{ $event->address }}</p>
                                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->address) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            Ver Mapa
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs italic">Sin dirección</span>
                                    @endif
                                </div>
                            </div>

                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="font-bold text-gray-800 dark:text-gray-200 mb-2">Artículos / Logística:</h4>
                                @if($event->items && $event->items->count() > 0)
                                    <ul class="list-disc list-inside space-y-1">
                                        @foreach($event->items as $item)
                                            <li class="text-gray-700 dark:text-gray-300 text-sm">
                                                <span class="font-bold text-indigo-600 dark:text-indigo-400">{{ $item->quantity ?? 1 }}x</span> 
                                                {{ $item->product_name ?? optional($item->product)->name ?? ('Producto #' . ($item->product_id ?? '?')) }}
                                                @if(!empty($item->description))
                                                    <span class="text-gray-500 italic">({{ $item->description }})</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-sm text-gray-500 italic">No hay ítems registrados para este evento.</p>
                                @endif
                            </div>
                            
                            @if($event->detail)
                                <div class="mt-4 bg-yellow-50 dark:bg-gray-700 p-3 rounded-md">
                                    <p class="text-xs font-bold text-yellow-800 dark:text-yellow-300 uppercase mb-1">Detalles:</p>
                                    <p class="text-sm text-gray-700 dark:text-gray-300">{{ $event->detail }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                        <p class="text-xl">No hay eventos para este día.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
