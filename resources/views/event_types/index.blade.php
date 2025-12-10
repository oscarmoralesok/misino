<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tipos de Evento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Crear Nuevo Tipo de Evento</h3>
                <form action="{{ route('event-types.store') }}" method="POST" class="flex gap-4 items-end">
                    @csrf
                    <div class="flex-grow">
                        <x-input-label for="name" :value="__('Nombre del Tipo (ej. Cumpleaños, Boda)')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <x-primary-button>
                        {{ __('Agregar') }}
                    </x-primary-button>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Listado de Tipos</h3>
                    
                    @if($eventTypes->isEmpty())
                        <p class="text-gray-500">No hay tipos de eventos registrados aún.</p>
                    @else
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($eventTypes as $type)
                                <li class="py-4 flex justify-between items-center group">
                                    <form action="{{ route('event-types.update', $type) }}" method="POST" class="flex-grow mr-4">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="name" value="{{ $type->name }}" 
                                               class="w-full bg-transparent border-none focus:ring-0 text-gray-900 dark:text-gray-100 p-0 font-medium" />
                                    </form>

                                    <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <form action="{{ route('event-types.destroy', $type) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este tipo?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Eliminar</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
