<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if($status === 'confirmed')
                {{ __('Eventos Confirmados') }}
            @else
                {{ __('Presupuestos / Pendientes') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <a href="{{ route('events.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Nuevo Evento / Presupuesto
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($events->isEmpty())
                        <div class="text-center py-10">
                            <p class="text-gray-500 mb-4">No hay registros en esta sección.</p>
                            @if($status !== 'confirmed')
                                <a href="{{ route('events.create') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Crear tu primer presupuesto</a>
                            @endif
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Cliente</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estado</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($events as $event)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $event->event_date->format('d/m/Y') }}
                                                <div class="text-xs text-gray-400">
                                                    @if($event->start_time)
                                                        {{ $event->start_time->format('H:i') }}
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $event->client->name }}
                                                <div class="text-xs text-gray-500 font-normal">{{ $event->eventType?->name ?? 'General' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($event->status === 'confirmed') bg-green-100 text-green-800 
                                                    @elseif($event->status === 'completed') bg-blue-100 text-blue-800 
                                                    @elseif($event->status === 'cancelled') bg-red-100 text-red-800 
                                                    @elseif($event->status === 'sent') bg-yellow-100 text-yellow-800 
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst($event->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-900 dark:text-gray-100 font-bold">
                                                ${{ number_format($event->total_amount, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                @if($event->status !== 'confirmed' && $event->status !== 'completed' && $event->status !== 'paid')
                                                    <form action="{{ route('events.confirm', $event) }}" method="POST" class="inline-block mr-2">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-600 font-bold" title="Confirmar Evento">✓ Confirmar</button>
                                                    </form>
                                                @endif
                                                <a href="{{ route('events.show', $event) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600 mr-3">Ver</a>
                                                <a href="{{ route('events.edit', $event) }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-600">Editar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $events->appends(['status' => $status])->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
