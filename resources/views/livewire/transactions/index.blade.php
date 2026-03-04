<div>
    <div class="space-y-8">
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-end gap-6">
            <div>
                <h2 class="font-display font-bold text-3xl text-gray-800 dark:text-white leading-tight">Movimientos</h2>
                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1 font-medium">Control detallado de tus finanzas y flujo de caja.</p>
            </div>
            <button wire:click="openCreateModal" 
                    class="btn-primary w-full md:w-auto flex items-center justify-center shadow-soft">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Nuevo Movimiento
            </button>
        </div>

        <div class="space-y-8">
        {{-- Success Message --}}
        @if (session()->has('success'))
            <div class="animate-fade-in p-4 bg-emerald-50 border border-emerald-100 dark:bg-emerald-900/20 dark:border-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-2xl text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- Totals Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="premium-card p-8 border-l-4 border-emerald-500">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 text-emerald-600/70">Ingresos Totales</p>
                <div class="flex items-end justify-between">
                    <div class="text-3xl font-display font-bold text-gray-800 dark:text-white">${{ number_format($totalIncome, 2) }}</div>
                    <div class="p-2 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl text-emerald-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                </div>
            </div>
            <div class="premium-card p-8 border-l-4 border-accent-500">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 text-accent-600/70">Gastos Totales</p>
                <div class="flex items-end justify-between">
                    <div class="text-3xl font-display font-bold text-gray-800 dark:text-white">${{ number_format($totalExpense, 2) }}</div>
                    <div class="p-2 bg-accent-50 dark:bg-accent-900/20 rounded-xl text-accent-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path></svg>
                    </div>
                </div>
            </div>
            <div class="premium-card p-8 border-l-4 {{ ($totalIncome - $totalExpense) >= 0 ? 'border-primary-500' : 'border-accent-500' }}">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 text-primary-600/70">Balance de Caja</p>
                <div class="flex items-end justify-between">
                    <div class="text-3xl font-display font-bold {{ ($totalIncome - $totalExpense) >= 0 ? 'text-gray-800 dark:text-white' : 'text-accent-600' }}">
                        ${{ number_format($totalIncome - $totalExpense, 2) }}
                    </div>
                    <div class="p-2 bg-primary-50 dark:bg-primary-900/20 rounded-xl text-primary-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filters Section --}}
        <div class="premium-card p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest pl-1">Mes</label>
                    <select wire:model.live="filterMonth" class="input-plain w-full text-sm">
                        <option value="">Todos los meses</option>
                        @foreach(range(1, 12) as $m)
                            <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest pl-1">Año</label>
                    <select wire:model.live="filterYear" class="input-plain w-full text-sm">
                        <option value="">Cualquier año</option>
                        @foreach(range(date('Y'), date('Y') - 5) as $y)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest pl-1">Categoría</label>
                    <select wire:model.live="filterCategoryId" class="input-plain w-full text-sm">
                        <option value="">Todas las categorías</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest pl-1">Tipo</label>
                    <select wire:model.live="filterType" class="input-plain w-full text-sm">
                        <option value="">Todos los tipos</option>
                        <option value="income">Ingresos</option>
                        <option value="expense">Gastos</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button wire:click="$refresh" class="w-full h-[42px] border border-gray-100 dark:border-gray-700 rounded-xl text-xs font-bold text-gray-400 hover:text-primary-600 hover:bg-primary-50 transition-all uppercase tracking-widest">
                        Refrescar
                    </button>
                </div>
            </div>
        </div>

        {{-- Transactions Table Container --}}
        <div class="premium-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700">
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Fecha</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Descripción</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Categoría / Método</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] text-right">Monto</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-sm font-medium">
                        @forelse($transactions as $transaction)
                        <tr wire:key="transaction-{{ $transaction->id }}" class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col">
                                    <span class="text-gray-800 dark:text-gray-100 font-bold uppercase tracking-wider text-[11px]">
                                        {{ \Carbon\Carbon::parse($transaction->date)->translatedFormat('d M, Y') }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-gray-800 dark:text-gray-100">{{ $transaction->description }}</span>
                                    @if($transaction->event)
                                        <div class="flex items-center mt-1">
                                            <span class="text-[10px] text-primary-500 font-bold uppercase tracking-widest bg-primary-50 dark:bg-primary-900/20 px-1.5 py-0.5 rounded">
                                                Evento: {{ $transaction->event->client->name ?? 'S/C' }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-gray-500 dark:text-gray-400 text-xs">{{ $transaction->category->name ?? '-' }}</span>
                                    <span class="text-[10px] text-gray-400 dark:text-gray-500 font-bold uppercase tracking-widest">{{ $transaction->payment_method ?: 'N/A' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <span class="text-base font-display font-bold {{ $transaction->type === 'income' ? 'text-emerald-500' : 'text-accent-500' }}">
                                    {{ $transaction->type === 'income' ? '+' : '-' }}${{ number_format($transaction->amount, 2) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center space-x-1">
                                    @if($transaction->type === 'income' && $transaction->event_id)
                                        <a href="{{ route('transactions.receipt', $transaction) }}" 
                                           class="p-2 text-primary-400 hover:text-emerald-500 hover:bg-emerald-50 dark:hover:bg-emerald-900/10 rounded-xl transition-all"
                                           title="Descargar Recibo">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                        </a>
                                    @endif
                                    <button wire:click="edit({{ $transaction->id }})" 
                                            class="p-2 text-primary-400 hover:text-primary-600 hover:bg-primary-50 dark:hover:bg-primary-900/10 rounded-xl transition-all"
                                            title="Editar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button onclick="confirm('¿Estás seguro de eliminar este movimiento?') || event.stopImmediatePropagation()" 
                                            wire:click="delete({{ $transaction->id }})"
                                            class="p-2 text-accent-400 hover:text-accent-600 hover:bg-accent-50 dark:hover:bg-accent-900/10 rounded-xl transition-all"
                                            title="Eliminar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="p-4 bg-gray-50 dark:bg-gray-800/50 rounded-full mb-4">
                                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"></path></svg>
                                    </div>
                                    <p class="text-gray-400 font-medium">No se encontraron movimientos.</p>
                                    <p class="text-xs text-gray-300 mt-1">Registra tus primeros ingresos o gastos para ver los datos aquí.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($transactions->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50/30">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Modal --}}
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" wire:click="closeModal"></div>
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-3xl bg-white dark:bg-gray-800 text-left shadow-premium transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-gray-100 dark:border-gray-700 animate-translate-up">
                    <livewire:transactions.create-edit 
                        :transactionId="$editingId" 
                        :eventId="$initialEventId"
                        :type="$initialType"
                        :key="$editingId ? 'edit-'.$editingId : 'create-'.($initialEventId ?? 'general').'-'.($initialType ?? 'expense')" 
                    />
                </div>
            </div>
        </div>
    @endif
    </div>
</div>
