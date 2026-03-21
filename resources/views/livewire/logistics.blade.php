<div>
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
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

    <div class="space-y-6">
        @forelse($events as $event)
            <div class="premium-card overflow-hidden group">
                <div class="flex flex-col lg:flex-row divide-y lg:divide-y-0 lg:divide-x divide-gray-100 dark:divide-gray-800">
                    {{-- Left Column: Time, Status & Client Info --}}
                    <div class="p-8 lg:w-72 bg-gray-50/50 dark:bg-gray-800/30 flex flex-col items-center text-center">
                        {{-- Time Hero --}}
                        <div class="relative group/time mb-6">
                            <div class="w-14 h-14 bg-white dark:bg-gray-800 rounded-2xl flex items-center justify-center text-primary-600 shadow-sm mb-3 mx-auto transition-all duration-500 group-hover:scale-110 group-hover:shadow-lg group-hover:shadow-primary-500/10">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="text-3xl font-display font-bold text-gray-800 dark:text-white leading-none tracking-tight">
                                {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}
                            </div>
                            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mt-2">
                                Fin: {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                            </div>
                        </div>
                        
                        {{-- Event Type Badge --}}
                        <div class="mb-8">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest border" 
                                  style="border-color: {{ $event->eventType->color ?? '#6366f1' }}40; color: {{ $event->eventType->color ?? '#6366f1' }}; background-color: {{ $event->eventType->color ?? '#6366f1' }}10;">
                                {{ $event->eventType->name ?? 'General' }}
                            </span>
                        </div>

                        {{-- Divider --}}
                        <div class="w-full h-px bg-gray-100 dark:bg-gray-700/50 mb-8"></div>

                        {{-- Client Info & Maps --}}
                        <div class="space-y-4 w-full">
                            <div class="px-2">
                                <h3 class="text-lg font-display font-bold text-primary-600 dark:text-primary-400 leading-tight">
                                    {{ $event->client->name ?? 'Sin Cliente' }}
                                </h3>
                                
                                {{-- WhatsApp Contacts --}}
                                <div class="flex flex-col space-y-2 mt-3">
                                    {{-- Primary Client WhatsApp --}}
                                    @if($event->client->phone)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $event->client->phone) }}" target="_blank" 
                                           class="inline-flex items-center justify-center py-1.5 px-3 bg-white dark:bg-gray-800 border border-emerald-100 dark:border-emerald-900/30 rounded-xl text-emerald-600 dark:text-emerald-400 text-[10px] font-bold uppercase tracking-wider hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-all shadow-sm group/wa">
                                            <svg class="w-3.5 h-3.5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 .004 5.411.002 12.048c0 2.12.54 4.19 1.563 6.04L0 24l6.082-1.594a11.819 11.819 0 005.96 1.604h.005c6.636 0 12.048-5.411 12.051-12.049a11.829 11.829 0 00-3.626-8.53z"/></svg>
                                            <span>WhatsApp Cliente</span>
                                        </a>
                                    @endif

                                    {{-- Additional Contact WhatsApp --}}
                                    @if($event->client->contact_phone)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $event->client->contact_phone) }}" target="_blank" 
                                           class="inline-flex items-center justify-center py-1.5 px-3 bg-white dark:bg-gray-800 border border-primary-100 dark:border-primary-900/30 rounded-xl text-primary-600 dark:text-primary-400 text-[9px] font-bold uppercase tracking-wider hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-all shadow-sm">
                                            <div class="flex flex-col items-center">
                                                <div class="flex items-center">
                                                    <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 .004 5.411.002 12.048c0 2.12.54 4.19 1.563 6.04L0 24l6.082-1.594a11.819 11.819 0 005.96 1.604h.005c6.636 0 12.048-5.411 12.051-12.049a11.829 11.829 0 00-3.626-8.53z"/></svg>
                                                    <span>Extra: {{ $event->client->contact_name ?? 'Contacto' }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                </div>

                                @if($event->address)
                                    <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-4 leading-relaxed font-medium">
                                        {{ $event->address }}
                                    </p>
                                @endif
                            </div>

                            @if($event->address)
                                <div class="pt-2">
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->address) }}" target="_blank" 
                                       class="w-full inline-flex items-center justify-center py-2.5 px-4 bg-emerald-500 hover:bg-emerald-600 text-white text-[10px] font-bold uppercase tracking-widest rounded-xl transition-all duration-300 shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/30 active:scale-95 group/map">
                                        <svg class="w-3.5 h-3.5 mr-2 transition-transform group-hover/map:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                                        Maps
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Main Column: Materials & Notes --}}
                    <div class="p-8 flex-1 space-y-8">
                        {{-- Items Section --}}
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-1.5 h-7 bg-primary-500 rounded-full"></div>
                                <h4 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em]">Materiales y Equipamiento</h4>
                            </div>
                            
                            @if($event->items && $event->items->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($event->items as $item)
                                        <div class="group/item flex items-center p-4 bg-gray-50/50 dark:bg-gray-900/40 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-primary-200 dark:hover:border-primary-900/30 transition-all duration-300">
                                            <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center text-primary-600 font-display font-bold text-sm mr-4 group-hover/item:scale-110 transition-transform">
                                                {{ $item->quantity ?? 1 }}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-bold text-gray-800 dark:text-gray-200 group-hover/item:text-primary-600 transition-colors">
                                                    {{ $item->product_name ?? optional($item->product)->name ?? 'Producto' }}
                                                </p>
                                                @if(!empty($item->description))
                                                    <p class="text-[11px] text-gray-400 mt-0.5 italic">{{ $item->description }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="p-8 bg-gray-50/50 dark:bg-gray-900/40 rounded-2xl border border-dashed border-gray-200 dark:border-gray-800 text-center">
                                    <p class="text-xs text-gray-400 font-medium italic">No se han registrado artículos para este transporte.</p>
                                </div>
                            @endif
                        </div>

                        {{-- Details & Internal Link --}}
                        <div class="flex flex-col md:flex-row gap-6 items-end">
                            <div class="flex-1 w-full">
                                @if($event->detail)
                                    <div class="p-5 bg-amber-50 dark:bg-amber-900/10 rounded-2xl border border-amber-100 dark:border-amber-900/20 relative overflow-hidden group/notes">
                                        <div class="absolute top-0 right-0 p-3 text-amber-500/20 transform translate-x-1 -translate-y-1">
                                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                        </div>
                                        <p class="text-[10px] font-bold text-amber-600 dark:text-amber-500 uppercase tracking-[0.2em] mb-2 flex items-center">
                                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-2"></span>
                                            Instrucciones Especiales
                                        </p>
                                        <p class="text-[13px] text-gray-600 dark:text-gray-300 leading-relaxed font-medium">{{ $event->detail }}</p>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex-shrink-0">
                                <a href="{{ route('events.show', $event) }}" class="inline-flex items-center px-6 py-2.5 bg-gray-100 dark:bg-gray-800 hover:bg-primary-600 dark:hover:bg-primary-600 text-[10px] font-bold text-gray-500 dark:text-gray-400 hover:text-white dark:hover:text-white uppercase tracking-widest rounded-xl transition-all duration-300">
                                    Ficha del Evento
                                    <svg class="w-3.5 h-3.5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
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
