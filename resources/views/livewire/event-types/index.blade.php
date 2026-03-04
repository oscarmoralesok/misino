@php
    $layout = 'layouts.app';
@endphp

<div>
    <div class="space-y-8">
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-end gap-6">
            <div>
                <h2 class="font-display font-bold text-3xl text-gray-800 dark:text-white leading-tight">Tipos de Evento</h2>
                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1 font-medium">Define las categorías principales de tus celebraciones.</p>
            </div>
            <button wire:click="create" 
                    class="btn-primary w-full md:w-auto flex items-center justify-center shadow-soft">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Nuevo Tipo
            </button>
        </div>

        <div class="space-y-6">

        {{-- Success Message --}}
        @if (session()->has('success'))
            <div class="animate-fade-in p-4 bg-emerald-50 border border-emerald-100 dark:bg-emerald-900/20 dark:border-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-2xl text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- Event Types Table Container --}}
        <div class="premium-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700">
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Nombre de la Categoría</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse($eventTypes as $type)
                        <tr wire:key="event-type-{{ $type->id }}" class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-gray-800 dark:text-gray-100 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                                    {{ $type->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center space-x-1">
                                    <button wire:click="edit({{ $type->id }})" 
                                            class="p-2 text-primary-400 hover:text-primary-600 hover:bg-primary-50 dark:hover:bg-primary-900/10 rounded-xl transition-all"
                                            title="Editar categoría">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button onclick="confirm('¿Estás seguro de eliminar este tipo de evento?') || event.stopImmediatePropagation()" 
                                            wire:click="delete({{ $type->id }})"
                                            class="p-2 text-accent-400 hover:text-accent-600 hover:bg-accent-50 dark:hover:bg-accent-900/10 rounded-xl transition-all"
                                            title="Eliminar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="p-4 bg-gray-50 dark:bg-gray-800/50 rounded-full mb-4">
                                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                    </div>
                                    <p class="text-gray-400 font-medium">No hay tipos de eventos registrados.</p>
                                    <p class="text-xs text-gray-300 mt-1">Comienza agregando categorías como "Boda" o "XV Años".</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" wire:click="closeModal"></div>
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-3xl bg-white dark:bg-gray-800 text-left shadow-premium transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-100 dark:border-gray-700 animate-translate-up">
                    <livewire:event-types.create-edit :eventTypeId="$editingId" :key="$editingId ?? 'new'" />
                </div>
            </div>
        </div>
    @endif
    </div>
</div>
