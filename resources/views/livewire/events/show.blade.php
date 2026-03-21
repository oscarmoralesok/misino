<div>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('calendar.index') }}" class="p-2 bg-gray-100 dark:bg-gray-800 rounded-xl text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div>
                    <h2 class="font-display font-bold text-3xl text-gray-800 dark:text-white leading-tight">
                        {{ $event->detail ? Str::limit($event->detail, 40) : 'Detalle del Evento' }}
                    </h2>
                    <div class="flex flex-wrap items-center gap-2 mt-2">
                        <span class="text-gray-400 dark:text-gray-500 text-sm font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $event->event_date->translatedFormat('d F, Y') }}
                        </span>
                        @if($event->start_time)
                            <span class="text-gray-400 dark:text-gray-500 text-sm font-medium flex items-center">
                                <svg class="w-4 h-4 mr-1 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $event->start_time->format('H:i') }} {{ $event->end_time ? '- ' . $event->end_time->format('H:i') : '' }}
                            </span>
                        @endif
                        @if($event->eventType)
                            <span class="px-2 py-0.5 rounded-lg text-[10px] font-bold uppercase tracking-widest bg-primary-50 text-primary-600 dark:bg-primary-900/20 dark:text-primary-400 border border-primary-100 dark:border-primary-900/30">
                                {{ $event->eventType->name }}
                            </span>
                        @endif
                        @if($event->service_type)
                            <span class="px-2 py-0.5 rounded-lg text-[10px] font-bold uppercase tracking-widest bg-gray-50 text-gray-500 dark:bg-gray-800 dark:text-gray-400 border border-gray-100 dark:border-gray-700">
                                {{ $event->service_type == 'rental' ? 'Alquiler' : 'Decoración' }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="flex items-center space-x-3 w-full md:w-auto">
                @if($event->status !== 'confirmed' && $event->status !== 'completed' && $event->status !== 'paid')
                    <button wire:click="confirmEvent" class="flex-1 md:flex-none btn-primary shadow-lg shadow-emerald-500/20 !bg-emerald-500 hover:!bg-emerald-600">
                        Confirmar Evento
                    </button>
                @endif
                <a href="{{ route('events.edit', $event) }}" class="p-2.5 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl text-gray-400 hover:text-primary-600 transition-all shadow-sm" title="Editar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </a>
                <a href="{{ route('events.pdf', $event) }}" target="_blank" class="p-2.5 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl text-gray-400 hover:text-accent-600 transition-all shadow-sm" title="Descargar PDF">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        {{-- Success Message --}}
        @if (session()->has('success'))
            <div class="animate-fade-in p-4 bg-emerald-50 border border-emerald-100 dark:bg-emerald-900/20 dark:border-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-2xl text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- Event & Client Details -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1 space-y-6">
                <!-- Client Card -->
                <div class="premium-card p-8">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-4">Información del Cliente</p>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-primary-50 dark:bg-primary-900/20 rounded-xl flex items-center justify-center text-primary-600 font-bold text-lg">
                                {{ strtoupper(substr($event->client->name, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 dark:text-white">{{ $event->client->name }}</h4>
                                <p class="text-xs text-gray-400 dark:text-gray-500">Cliente Principal</p>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-gray-100 dark:border-gray-700 space-y-3">
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                {{ $event->client->phone }}
                            </div>
                            @if($event->client->email)
                                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                    <svg class="w-4 h-4 mr-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    {{ $event->client->email }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Event Info Card -->
                <div class="premium-card p-8">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-4">Estado y Notas</p>
                    <div class="space-y-4">
                        <div>
                            <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 dark:text-gray-200 text-gray-800 rounded-full text-xs font-bold uppercase tracking-widest border border-gray-200 dark:border-gray-600">
                                {{ ucfirst($event->status) }}
                            </span>
                        </div>
                        @if($event->notes)
                            <div class="mt-4 p-4 bg-gray-50 dark:bg-gray-900/20 rounded-2xl">
                                <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed whitespace-pre-wrap">{{ $event->notes }}</p>
                            </div>
                        @endif
                        @if($event->address)
                            <div class="flex items-start mt-4">
                                <svg class="w-4 h-4 mr-3 mt-0.5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed font-medium">{{ $event->address }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <!-- Event Description Card -->
                <div class="premium-card p-8 h-fit">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-4">Descripción del Evento</p>
                    <div class="prose dark:prose-invert max-w-none">
                        <p class="text-gray-600 dark:text-gray-300 whitespace-pre-wrap leading-relaxed">{{ $event->detail }}</p>
                    </div>

                    @if($event->latitude && $event->longitude)
                        <div class="mt-8 border-t border-gray-100 dark:border-gray-700 pt-8" wire:ignore>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-4">Ubicación</p>
                            <div id="map" class="rounded-3xl border border-gray-100 dark:border-gray-700 shadow-inner overflow-hidden" style="height: 300px; width: 100%;"></div>
                        </div>
                    @endif
                </div>

                <!-- Reference Images -->
                @if($event->images->count() > 0)
                    <div class="premium-card p-8">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-4">Imágenes de Referencia</p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach($event->images as $image)
                                <div class="relative group aspect-square" wire:key="image-{{ $image->id }}">
                                    <a href="{{ route('storage.serve', ['path' => $image->image_path]) }}" 
                                       data-fancybox="gallery" 
                                       data-caption="{{ $image->original_name }}"
                                       class="block w-full h-full">
                                        <img src="{{ route('storage.serve', ['path' => $image->image_path]) }}" 
                                             alt="{{ $image->original_name }}"
                                             class="w-full h-full object-cover rounded-2xl border border-gray-100 dark:border-gray-700 hover:scale-[1.02] transition-transform shadow-sm">
                                    </a>
                                    
                                    <!-- Delete Button -->
                                    <button wire:click="deleteImage({{ $image->id }})" 
                                            onclick="confirm('¿Estás seguro de eliminar esta imagen?') || event.stopImmediatePropagation()"
                                            class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity translate-y-1 group-hover:translate-y-0 duration-300 bg-accent-500 text-white rounded-lg p-1.5 shadow-lg hover:bg-accent-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Financial Summary -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="premium-card p-8 border-l-4 border-emerald-500">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 text-emerald-600/70">Total Ingresos</p>
                <div class="flex items-end justify-between">
                    <div class="text-2xl font-display font-bold text-gray-800 dark:text-white">${{ number_format($income, 2) }}</div>
                    <div class="p-2 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl text-emerald-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                </div>
            </div>
            <div class="premium-card p-8 border-l-4 border-accent-500">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 text-accent-600/70">Total Gastos</p>
                <div class="flex items-end justify-between">
                    <div class="text-2xl font-display font-bold text-gray-800 dark:text-white">${{ number_format($expense, 2) }}</div>
                    <div class="p-2 bg-accent-50 dark:bg-accent-900/20 rounded-xl text-accent-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path></svg>
                    </div>
                </div>
            </div>
            <div class="premium-card p-8 border-l-4 {{ $balance >= 0 ? 'border-primary-500' : 'border-accent-500' }}">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 text-primary-600/70">Utilidad Estimada</p>
                <div class="flex items-end justify-between">
                    <div class="text-2xl font-display font-bold {{ $balance >= 0 ? 'text-gray-800 dark:text-white' : 'text-accent-600' }}">
                        ${{ number_format($balance, 2) }}
                    </div>
                    <div class="p-2 bg-primary-50 dark:bg-primary-900/20 rounded-xl text-primary-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2-2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                </div>
            </div>
            <div class="premium-card p-8 border-l-4 {{ $pendingBalance > 0 ? 'border-amber-500' : 'border-emerald-500' }}">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 {{ $pendingBalance > 0 ? 'text-amber-600/70' : 'text-emerald-600/70' }}">Saldo Pendiente</p>
                <div class="flex items-end justify-between">
                    <div class="text-2xl font-display font-bold {{ $pendingBalance > 0 ? 'text-amber-600' : 'text-emerald-600' }}">
                        ${{ number_format($pendingBalance, 2) }}
                    </div>
                    <div class="p-2 {{ $pendingBalance > 0 ? 'bg-amber-50 dark:bg-amber-900/20 text-amber-600' : 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600' }} rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <!-- Contracted Services / Presupuesto Items -->
            <div class="xl:col-span-1">
                <div class="premium-card h-full">
                    <div class="p-8 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                        <h3 class="font-display font-bold text-lg text-gray-800 dark:text-white">Ítems / Presupuesto</h3>
                        <span class="text-[10px] font-bold text-primary-500 uppercase tracking-widest bg-primary-50 dark:bg-primary-900/20 px-2 py-1 rounded-lg">
                            {{ $event->items->count() }} Ítems
                        </span>
                    </div>
                    <div class="p-8">
                        @if($event->items->isEmpty())
                            <p class="text-xs text-gray-400 text-center py-4 italic">No se han definido ítems para este presupuesto.</p>
                        @else
                            <ul class="space-y-6">
                                @foreach($event->items as $item)
                                    <li class="flex justify-between items-start group" wire:key="item-{{ $item->id }}">
                                        <div class="space-y-1">
                                            <span class="block text-sm font-bold text-gray-800 dark:text-gray-100">{{ $item->product_name }}</span>
                                            @if($item->description)
                                                <span class="block text-[11px] text-gray-400 italic leading-snug">{{ $item->description }}</span>
                                            @endif
                                            <span class="block text-[10px] text-gray-400 font-bold uppercase tracking-widest">
                                                {{ $item->quantity }} x ${{ number_format($item->unit_price, 2) }}
                                            </span>
                                        </div>
                                        <span class="font-display font-bold text-gray-800 dark:text-white">${{ number_format($item->total, 2) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-between items-center">
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Presupuestado</span>
                                <span class="text-2xl font-display font-bold text-primary-600">${{ number_format($event->total_amount, 2) }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Transactions for this Event -->
            <div class="xl:col-span-2">
                <div class="premium-card overflow-hidden h-full">
                    <div class="p-8 border-b border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <h3 class="font-display font-bold text-lg text-gray-800 dark:text-white">Movimientos del Evento</h3>
                        <div class="flex flex-wrap gap-2">
                            <button wire:click="openCreateTransaction('income')" 
                               class="btn-primary !text-[10px] !py-2 !px-3 !bg-emerald-500 hover:!bg-emerald-600 shadow-emerald-500/10 whitespace-nowrap">
                                + Registrar Ingreso
                            </button>
                            <button wire:click="openCreateTransaction('expense')" 
                               class="btn-primary !text-[10px] !py-2 !px-3 !bg-accent-500 hover:!bg-accent-600 shadow-accent-500/10 whitespace-nowrap">
                                - Registrar Gasto
                            </button>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        @if($transactions->isEmpty())
                            <div class="p-12 text-center">
                                <p class="text-sm text-gray-400 font-medium italic">No hay movimientos registrados en este evento.</p>
                            </div>
                        @else
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50/50 dark:bg-gray-800/50">
                                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Fecha</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Descripción</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Categoría</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] text-right">Monto</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-sm font-medium">
                                    @foreach($transactions as $transaction)
                                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors group" wire:key="transaction-{{ $transaction->id }}">
                                            <td class="px-6 py-4 whitespace-nowrap text-[11px] text-gray-500 dark:text-gray-400 uppercase font-bold tracking-widest">
                                                {{ $transaction->date->format('d M, Y') }}
                                            </td>
                                            <td class="px-6 py-4 text-gray-800 dark:text-gray-200">
                                                {{ $transaction->description }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="px-2 py-0.5 rounded-lg text-[10px] font-bold uppercase tracking-widest" 
                                                      style="background-color: {{ $transaction->category->color }}15; color: {{ $transaction->category->color }}">
                                                    {{ $transaction->category->name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right font-display font-bold {{ $transaction->type === 'income' ? 'text-emerald-500' : 'text-accent-500' }}">
                                                {{ $transaction->type === 'income' ? '+' : '-' }} ${{ number_format($transaction->amount, 2) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex justify-center items-center space-x-1">
                                                    <button wire:click="editTransaction({{ $transaction->id }})" 
                                                            class="p-2 text-primary-400 hover:text-primary-600 hover:bg-primary-50 dark:hover:bg-primary-900/10 rounded-xl transition-all"
                                                            title="Editar">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                    </button>
                                                    <button onclick="confirm('¿Estás seguro de eliminar este movimiento?') || event.stopImmediatePropagation()" 
                                                            wire:click="deleteTransaction({{ $transaction->id }})"
                                                            class="p-2 text-accent-400 hover:text-accent-600 hover:bg-accent-50 dark:hover:bg-accent-900/10 rounded-xl transition-all"
                                                            title="Eliminar">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Transaction Modal --}}
    @if($showTransactionModal)
        <div class="fixed inset-0 z-[60] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" wire:click="$set('showTransactionModal', false)"></div>
                <div class="relative bg-white dark:bg-gray-900 rounded-[2.5rem] shadow-2xl w-full max-w-lg transform transition-all overflow-hidden border border-gray-100 dark:border-gray-800">
                    <livewire:transactions.create-edit 
                        :transactionId="$editingTransactionId" 
                        :eventId="$event->id"
                        :type="$transactionType"
                        :key="$editingTransactionId ? 'edit-'.$editingTransactionId : 'create-'.$event->id.'-'.$transactionType" 
                    />
                </div>
            </div>
        </div>
    @endif

    <!-- Additional Contact Modal -->
    @if($showContactModal)
        <div class="fixed inset-0 z-[60] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
                <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" wire:click="$set('showContactModal', false)"></div>
                
                <div class="relative inline-block align-bottom bg-white dark:bg-gray-900 rounded-[2.5rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100 dark:border-gray-800">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h3 class="font-display font-bold text-2xl text-gray-800 dark:text-white">Contacto Adicional</h3>
                                <p class="text-gray-400 text-xs mt-1">Requerido para la confirmación del presupuesto.</p>
                            </div>
                            <button wire:click="$set('showContactModal', false)" class="p-2.5 rounded-2xl bg-gray-50 dark:bg-gray-800 text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        <form wire:submit.prevent="saveContactAndConfirm" class="space-y-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] pl-1">Nombre de Contacto</label>
                                <input type="text" wire:model.defer="contact_name" class="input-plain w-full" placeholder="Ej: Maria Gomez">
                                @error('contact_name') <span class="text-accent-500 text-[10px] font-bold uppercase mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] pl-1">Vínculo / Relación</label>
                                <input type="text" wire:model.defer="contact_relationship" class="input-plain w-full" placeholder="Ej: Esposa, Hermano, etc.">
                                @error('contact_relationship') <span class="text-accent-500 text-[10px] font-bold uppercase mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] pl-1">Teléfono de Contacto</label>
                                <input type="text" wire:model.defer="contact_phone" class="input-plain w-full" placeholder="Ej: 3511234567">
                                @error('contact_phone') <span class="text-accent-500 text-[10px] font-bold uppercase mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="pt-6 border-t border-gray-100 dark:border-gray-800">
                                <button type="submit" class="btn-primary w-full shadow-soft flex items-center justify-center group">
                                    <span>Guardar y Confirmar Evento</span>
                                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    @if($event->latitude && $event->longitude)
        <script>
            function initMap() {
                const mapEl = document.getElementById('map');
                if (!mapEl) return;
                
                const location = {
                    lat: {{ $event->latitude }},
                    lng: {{ $event->longitude }}
                };
                
                const map = new google.maps.Map(mapEl, {
                    center: location,
                    zoom: 15,
                    mapTypeControl: false,
                    streetViewControl: false,
                    styles: [
                        {
                            "featureType": "administrative",
                            "elementType": "geometry",
                            "stylers": [{"visibility": "off"}]
                        },
                        {
                            "featureType": "poi",
                            "stylers": [{"visibility": "off"}]
                        },
                        {
                            "featureType": "road",
                            "elementType": "labels.icon",
                            "stylers": [{"visibility": "off"}]
                        }
                    ]
                });
                
                new google.maps.Marker({
                    position: location,
                    map: map,
                    title: 'Ubicación del Evento',
                    animation: google.maps.Animation.DROP
                });
            }
            
            // Re-init map on livewire refresh
            document.addEventListener('livewire:initialized', () => {
                initMap();
                Livewire.on('transaction-saved', () => {
                   setTimeout(initMap, 100);
                });
            });
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDifDBJbSl3yI9WeNoqorVNCmwVunHLVwg&callback=initMap" async defer></script>
    @endif

    <!-- Fancybox JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        document.addEventListener('livewire:navigated', () => {
            Fancybox.bind("[data-fancybox='gallery']", {
                Toolbar: {
                    display: {
                        left: ["infobar"],
                        middle: [],
                        right: ["slideshow", "thumbs", "close"],
                    },
                },
            });
        });
        
        Fancybox.bind("[data-fancybox='gallery']", {
            Toolbar: {
                display: {
                    left: ["infobar"],
                    middle: [],
                    right: ["slideshow", "thumbs", "close"],
                },
            },
        });
    </script>
</div>
