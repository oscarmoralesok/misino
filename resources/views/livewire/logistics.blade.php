<div>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h2 class="font-display font-bold text-3xl text-gray-800 dark:text-white leading-tight">
                    {{ __('Logística Diaria') }}
                </h2>
                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    Hoja de ruta para el personal de campo y depósitos.
                </p>
            </div>
            
            <div class="flex items-center space-x-2 w-full md:w-auto">
                <input type="date" wire:model.live="date" id="date" class="input-plain !py-2 !px-4 min-w-[200px] shadow-sm">
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        @forelse($events as $event)
            <div class="premium-card overflow-hidden group">
                <div class="flex flex-col lg:flex-row divide-y lg:divide-y-0 lg:divide-x divide-gray-100 dark:divide-gray-800">
                    {{-- Time & Status --}}
                    <div class="p-8 lg:w-64 bg-gray-50/50 dark:bg-gray-800/30 flex flex-col justify-center items-center text-center">
                        <div class="w-12 h-12 bg-white dark:bg-gray-800 rounded-2xl flex items-center justify-center text-primary-600 shadow-sm mb-3 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="text-2xl font-display font-bold text-gray-800 dark:text-white leading-none">
                            {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}
                        </div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">
                            Fin: {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                        </div>
                        
                        <div class="mt-4">
                            <span class="px-2 py-0.5 rounded-lg text-[10px] font-bold uppercase tracking-widest border" 
                                  style="border-color: {{ $event->eventType->color ?? '#6366f1' }}40; color: {{ $event->eventType->color ?? '#6366f1' }}; background-color: {{ $event->eventType->color ?? '#6366f1' }}10;">
                                {{ $event->eventType->name ?? 'General' }}
                            </span>
                        </div>
                    </div>

                    {{-- Main Info --}}
                    <div class="p-8 flex-1 space-y-6">
                        <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                            <div>
                                <h3 class="text-xl font-display font-bold text-gray-800 dark:text-white group-hover:text-primary-600 transition-colors">
                                    {{ $event->client->name ?? 'Sin Cliente' }}
                                </h3>
                                @if($event->address)
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        <svg class="w-4 h-4 mr-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $event->address }}
                                    </div>
                                @endif
                            </div>

                            @if($event->address)
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->address) }}" target="_blank" 
                                   class="btn-primary !text-[10px] !py-2 !px-4 !bg-emerald-500 hover:!bg-emerald-600 shadow-emerald-500/10 flex items-center uppercase tracking-widest font-bold">
                                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                                    Ver en Maps
                                </a>
                            @endif
                        </div>

                        <div class="space-y-4">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Materiales y Artículos</p>
                            @if($event->items && $event->items->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach($event->items as $item)
                                        <div class="flex items-center p-3 bg-gray-50/50 dark:bg-gray-900/40 rounded-xl border border-gray-100 dark:border-gray-800">
                                            <div class="w-8 h-8 bg-primary-50 dark:bg-primary-900/20 rounded-lg flex items-center justify-center text-primary-600 font-bold text-xs mr-3">
                                                {{ $item->quantity ?? 1 }}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-bold text-gray-800 dark:text-gray-200 truncate">
                                                    {{ $item->product_name ?? optional($item->product)->name ?? 'Producto' }}
                                                </p>
                                                @if(!empty($item->description))
                                                    <p class="text-[10px] text-gray-400 italic truncate">{{ $item->description }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-xs text-gray-400 italic">No hay artículos registrados para este transporte.</p>
                            @endif
                        </div>

                        @if($event->detail)
                            <div class="p-4 bg-amber-50 dark:bg-amber-900/10 rounded-2xl border border-amber-100 dark:border-amber-900/20">
                                <p class="text-[10px] font-bold text-amber-600 dark:text-amber-500 uppercase tracking-widest mb-1">Notas de Logística:</p>
                                <p class="text-xs text-gray-600 dark:text-gray-300 leading-relaxed">{{ $event->detail }}</p>
                            </div>
                        @endif
                        
                        <div class="flex justify-end pt-4">
                            <a href="{{ route('events.show', $event) }}" class="text-[10px] font-bold text-primary-600 uppercase tracking-widest hover:underline flex items-center">
                                Ver Detalles Completos
                                <svg class="w-3 h-3 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="premium-card p-20 text-center">
                <div class="w-20 h-20 bg-gray-50 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-display font-bold text-gray-800 dark:text-white">Día libre</h3>
                <p class="text-gray-400 text-sm mt-2 max-w-xs mx-auto">No hay eventos ni transportes programados para la fecha seleccionada.</p>
            </div>
        @endforelse
    </div>
</div>
