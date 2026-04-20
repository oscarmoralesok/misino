    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h2 class="font-display font-bold text-3xl text-gray-800 dark:text-white leading-tight">Gestión de Eventos</h2>
                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Organiza y supervisa todos tus compromisos.</p>
            </div>
            <a href="{{ route('events.create') }}" 
               class="btn-primary mt-4 md:mt-0 flex items-center shadow-soft">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Nuevo Evento
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        {{-- Success Message --}}
        @if (session()->has('success'))
            <div class="animate-fade-in p-4 bg-emerald-50 border border-emerald-100 dark:bg-emerald-900/20 dark:border-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-2xl text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- Filters Section --}}
        <div class="premium-card p-6">
            <div class="flex flex-col lg:flex-row gap-4 items-center">
                <div class="relative w-full lg:flex-1">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" 
                            wire:model.live.debounce.300ms="search" 
                            placeholder="Buscar por cliente o detalle..."
                            class="input-plain pl-10 w-full text-sm">
                </div>
                
                <div class="flex items-center space-x-4 w-full lg:w-auto">
                    <select wire:model.live="filterStatus" class="input-plain text-sm py-2.5 min-w-[160px]">
                        <option value="pending">Pendientes</option>
                        <option value="confirmed">Confirmados</option>
                        <option value="completed">Completados</option>
                        <option value="cancelled">Cancelados</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Events Table Container --}}
        <div class="premium-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700">
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Fecha y Hora</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Cliente / Detalle</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Tipo</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Estado</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] text-right">Presupuesto</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] text-center">Gestión</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse($events as $event)
                        <tr wire:key="event-{{ $event->id }}" class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="font-bold text-gray-800 dark:text-gray-200">
                                    {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M, Y') }}
                                </div>
                                <div class="text-[11px] text-primary-500 font-medium tracking-wide uppercase mt-0.5">
                                    {{ $event->start_time ? substr($event->start_time, 0, 5) . ' hs' : 'Sin hora' }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-gray-800 dark:text-gray-100">
                                    {{ $event->client->name ?? 'Consumidor Final' }}
                                </div>
                                @if($event->detail)
                                    <div class="text-[11px] text-gray-400 line-clamp-1 mt-0.5">
                                        {{ $event->detail }}
                                    </div>
                                @endif
                                
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest bg-gray-50 dark:bg-gray-800/50 px-1.5 py-0.5 rounded">
                                        {{ now()->diffInDays($event->created_at) }} d
                                    </span>
                                    @if($event->last_follow_up_at)
                                        <span class="text-[9px] font-bold text-primary-500 uppercase tracking-widest flex items-center">
                                            <svg class="w-2.5 h-2.5 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 .004 5.411.002 12.048c0 2.12.54 4.19 1.563 6.04L0 24l6.082-1.594a11.819 11.819 0 005.96 1.604h.005c6.636 0 12.048-5.411 12.051-12.049a11.829 11.829 0 00-3.626-8.53z"/></svg>
                                            Contactado {{ \Carbon\Carbon::parse($event->last_follow_up_at)->diffForHumans() }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                                    {{ $event->eventType->name ?? 'General' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusClasses = [
                                        'confirmed' => 'bg-emerald-50 text-emerald-600 dark:bg-emerald-900/10',
                                        'completed' => 'bg-blue-50 text-blue-600 dark:bg-blue-900/10',
                                        'cancelled' => 'bg-red-50 text-red-600 dark:bg-red-900/10',
                                        'pending'   => 'bg-amber-50 text-amber-600 dark:bg-amber-900/10',
                                    ];
                                    $currentClass = $statusClasses[$event->status] ?? 'bg-gray-50 text-gray-600';
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold tracking-[0.1em] uppercase {{ $currentClass }}">
                                    {{ $event->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-800 dark:text-gray-100">
                                    ${{ number_format($event->total_amount, 0) }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center space-x-1">
                                    <a href="{{ route('events.show', $event) }}" 
                                       class="p-2 text-primary-400 hover:text-primary-600 hover:bg-primary-50 dark:hover:bg-primary-900/10 rounded-xl transition-all"
                                       title="Ver detalles">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('events.edit', $event) }}" 
                                       class="p-2 text-amber-400 hover:text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-900/10 rounded-xl transition-all"
                                       title="Editar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <button onclick="confirm('¿Estás seguro de eliminar este evento?') || event.stopImmediatePropagation()" 
                                            wire:click="delete({{ $event->id }})"
                                            class="p-2 text-accent-400 hover:text-accent-600 hover:bg-accent-50 dark:hover:bg-accent-900/10 rounded-xl transition-all"
                                            title="Eliminar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="p-4 bg-gray-50 dark:bg-gray-800/50 rounded-full mb-4">
                                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <p class="text-gray-400 font-medium">No se encontraron eventos.</p>
                                    <p class="text-xs text-gray-300 mt-1">Intenta ajustando los filtros de búsqueda.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($events->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50/30">
                    {{ $events->links() }}
                </div>
            @endif
        </div>
    </div>
