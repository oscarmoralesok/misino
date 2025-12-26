<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Eventos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- Success Message --}}
        @if (session()->has('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                
                {{-- Header with Filters and Create Button --}}
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <h3 class="text-lg font-bold">Gestión de Eventos</h3>
                    
                    <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                        {{-- Status Filter --}}
                        <select wire:model.live="filterStatus" 
                                class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                            <option value="pending">Pendientes</option>
                            <option value="confirmed">Confirmados</option>
                        </select>

                        {{-- Search --}}
                        <input type="text" 
                                wire:model.live.debounce.300ms="search" 
                                placeholder="Buscar eventos..."
                                class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                        
                        {{-- Create Button --}}
                        <a href="{{ route('events.create') }}" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded whitespace-nowrap text-center">
                            + Nuevo Evento
                        </a>
                    </div>
                </div>

                {{-- Events Table --}}
                @if($events->isEmpty())
                    <p class="text-gray-500 text-center py-8">
                        @if($search)
                            No se encontraron eventos que coincidan con "{{ $search }}".
                        @else
                            No hay eventos {{ $filterStatus === 'confirmed' ? 'confirmados' : 'pendientes' }}.
                        @endif
                    </p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Fecha
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Cliente
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Tipo
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Estado
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Total
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($events as $event)
                                    <tr wire:key="event-{{ $event->id }}" class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}
                                            </div>
                                            @if($event->start_time)
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ substr($event->start_time, 0, 5) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $event->client->name ?? 'Sin cliente' }}
                                            </div>
                                            @if($event->detail)
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ Str::limit($event->detail, 40) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $event->eventType->name ?? '-' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($event->status === 'confirmed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                @elseif($event->status === 'completed') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                                @elseif($event->status === 'paid') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                                                @elseif($event->status === 'cancelled') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                                @else bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                @endif">
                                                {{ ucfirst($event->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <div class="text-sm font-bold text-gray-900 dark:text-gray-100">
                                                ${{ number_format($event->total_amount, 2) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('events.show', $event) }}" 
                                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400 mr-3">
                                                Ver
                                            </a>
                                            <a href="{{ route('events.edit', $event) }}" 
                                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 mr-3">
                                                Editar
                                            </a>
                                            <button onclick="confirm('¿Estás seguro de eliminar este evento?') || event.stopImmediatePropagation()" 
                                                    wire:click="delete({{ $event->id }})"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $events->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
