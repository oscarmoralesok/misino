<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $event->detail ? Str::limit($event->detail, 30) : 'Detalle del Evento' }}
        </h2>
        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            {{ $event->event_date->format('d F, Y') }} 
            @if($event->start_time)
                | {{ $event->start_time->format('H:i') }} - {{ $event->end_time ? $event->end_time->format('H:i') : '' }}
            @endif
            @if($event->eventType)
                <span class="ml-2 px-2 py-0.5 rounded text-xs bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                    {{ $event->eventType->name }}
                </span>
            @endif
            @if($event->service_type)
                <span class="ml-2 px-2 py-0.5 rounded text-xs bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                    {{ $event->service_type == 'rental' ? 'Alquiler' : 'Decoración' }}
                </span>
            @endif
        </div>
        
        @if($event->status !== 'confirmed' && $event->status !== 'completed' && $event->status !== 'paid')
            <div class="mt-4 flex gap-3">
                <form action="{{ route('events.confirm', $event) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow">
                        ✓ Confirmar Evento
                    </button>
                </form>
                <a href="{{ route('events.edit', $event) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow inline-block">
                    ✏️ Editar
                </a>
            </div>
        @else
            <div class="mt-4">
                <a href="{{ route('events.edit', $event) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow inline-block">
                    ✏️ Editar
                </a>
            </div>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Event & Client Details -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">Información del Cliente</h3>
                        <p class="text-gray-600 dark:text-gray-400"><span class="font-semibold">Nombre:</span> {{ $event->client->name }}</p>
                        <p class="text-gray-600 dark:text-gray-400"><span class="font-semibold">Teléfono:</span> {{ $event->client->phone }}</p>
                        @if($event->client->email)
                            <p class="text-gray-600 dark:text-gray-400"><span class="font-semibold">Email:</span> {{ $event->client->email }}</p>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">Detalles del Evento</h3>
                        <p class="text-gray-600 dark:text-gray-400 whitespace-pre-wrap">{{ $event->detail }}</p>
                        
                        <!-- Status Badge in details -->
                        <div class="mt-4">
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-semibold dark:bg-gray-700 dark:text-gray-200">
                                Estado: {{ ucfirst($event->status) }}
                            </span>
                        </div>

                        @if($event->notes)
                            <div class="mt-4">
                                <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Notas Privadas / Condiciones:</h4>
                                <p class="text-gray-600 dark:text-gray-400 text-sm whitespace-pre-wrap bg-gray-50 dark:bg-gray-700 p-3 rounded">{{ $event->notes }}</p>
                            </div>
                        @endif

                        @if($event->address)
                            <div class="mt-4">
                                <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Dirección:</h4>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $event->address }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                @if($event->latitude && $event->longitude)
                    <div class="mt-6">
                        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Ubicación del Evento:</h4>
                        <div id="map" class="rounded-lg border border-gray-300 dark:border-gray-600" style="height: 400px; width: 100%;"></div>
                    </div>
                @endif


                @if($event->images->count() > 0)
                    <div class="mt-6">
                        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Imágenes de Referencia:</h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($event->images as $image)
                                <div class="relative group">
                                    <a href="{{ asset('storage/' . $image->image_path) }}" 
                                       data-fancybox="gallery" 
                                       data-caption="{{ $image->original_name }}"
                                       class="block">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                                             alt="{{ $image->original_name }}"
                                             class="w-full object-contain rounded border border-gray-300 dark:border-gray-600 hover:opacity-75 transition cursor-pointer">
                                    </a>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 truncate">{{ $image->original_name }}</p>
                                    
                                    <!-- Delete Button -->
                                    <form action="{{ route('events.images.destroy', [$event, $image]) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar esta imagen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Financial Summary for Event -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Income -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm uppercase font-bold mb-2">Total Ingresos</div>
                    <div class="text-3xl font-bold text-green-500">
                        ${{ number_format($income, 2) }}
                    </div>
                </div>

                <!-- Expense -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm uppercase font-bold mb-2">Total Gastos</div>
                    <div class="text-3xl font-bold text-red-500">
                        ${{ number_format($expense, 2) }}
                    </div>
                </div>

                <!-- Balance -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm uppercase font-bold mb-2">Utilidad / Pérdida</div>
                    <div class="text-3xl font-bold {{ $balance >= 0 ? 'text-blue-500' : 'text-red-500' }}">
                        ${{ number_format($balance, 2) }}
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Contracted Services / Presupuesto Items -->
                @if($event->items->isNotEmpty())
                    <div class="md:col-span-1">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Ítems / Presupuesto</h3>
                                <div class="mb-4">
                                    <ul class="space-y-3">
                                        @foreach($event->items as $item)
                                            <li class="flex justify-between items-start text-sm border-b dark:border-gray-700 pb-2">
                                                <div class="flex-1">
                                                    <span class="block text-gray-700 dark:text-gray-300 font-medium">{{ $item->product_name }}</span>
                                                    @if($item->description)
                                                        <span class="block text-xs text-gray-500 italic">{{ $item->description }}</span>
                                                    @endif
                                                    <span class="text-xs text-gray-500">{{ $item->quantity }} x ${{ number_format($item->unit_price, 2) }}</span>
                                                </div>
                                                <span class="font-bold text-gray-900 dark:text-gray-100 ml-2">${{ number_format($item->total, 2) }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="flex justify-between items-center pt-2 mt-2">
                                        <span class="font-bold text-gray-700 dark:text-gray-300">Total:</span>
                                        <span class="font-bold text-indigo-600 dark:text-indigo-400 text-lg">${{ number_format($event->total_amount, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Transactions for this Event -->
                @if($event->items->isNotEmpty())
                    <div class="md:col-span-2">
                @else
                    <div class="md:col-span-3">
                @endif
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                                <h3 class="text-lg font-bold">Movimientos del Evento</h3>
                                <div class="flex gap-2">
                                    <a href="{{ route('transactions.index', ['create' => true, 'event_id' => $event->id, 'type' => 'income']) }}" 
                                    class="bg-green-600 hover:bg-green-700 text-white text-sm font-bold py-2 px-4 rounded inline-flex items-center">
                                        + Registrar Ingreso
                                    </a>
                                    <a href="{{ route('transactions.index', ['create' => true, 'event_id' => $event->id, 'type' => 'expense']) }}" 
                                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded inline-flex items-center">
                                        - Registrar Gasto
                                    </a>
                                </div>
                            </div>
                            
                            @if($transactions->isEmpty())
                                <p class="text-center text-gray-500 py-4">No hay movimientos registrados en este evento.</p>
                            @else
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Descripción</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Categoría</th>
                                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Monto</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach($transactions as $transaction)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                        {{ $transaction->date->format('d/m/Y') }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                        {{ $transaction->description }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" 
                                                            style="background-color: {{ $transaction->category->color }}20; color: {{ $transaction->category->color }}">
                                                            {{ $transaction->category->name }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-bold {{ $transaction->type === 'income' ? 'text-green-500' : 'text-red-500' }}">
                                                        {{ $transaction->type === 'income' ? '+' : '-' }} ${{ number_format($transaction->amount, 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    @if($event->latitude && $event->longitude)
        <script>
            // Define initMap BEFORE loading Google Maps API
            function initMap() {
                // Small delay to ensure DOM is fully loaded
                setTimeout(() => {
                    const location = {
                        lat: {{ $event->latitude }},
                        lng: {{ $event->longitude }}
                    };
                    
                    const map = new google.maps.Map(document.getElementById('map'), {
                        center: location,
                        zoom: 15,
                        mapTypeControl: true,
                        streetViewControl: true
                    });
                    
                    new google.maps.Marker({
                        position: location,
                        map: map,
                        title: 'Ubicación del Evento',
                        animation: google.maps.Animation.DROP
                    });
                }, 100);
            }
        </script>
        
        <!-- Google Maps Script - loads AFTER initMap is defined -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDifDBJbSl3yI9WeNoqorVNCmwVunHLVwg&callback=initMap" async defer></script>
    @endif

    <!-- Fancybox JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        // Initialize Fancybox
        Fancybox.bind("[data-fancybox='gallery']", {
            // Options
            Toolbar: {
                display: {
                    left: ["infobar"],
                    middle: [],
                    right: ["slideshow", "thumbs", "close"],
                },
            },
        });
    </script>
</x-app-layout>

