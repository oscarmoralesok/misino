<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('transactions.index', ['create' => true]) }}" class="bg-gray-600 hover:bg-gray-700 text-white text-sm font-bold py-2 px-4 rounded">
                    + Movimiento General
                </a>
                <a href="{{ route('events.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold py-2 px-4 rounded">
                    + Nuevo Evento
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Income -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm uppercase font-bold mb-2">Ingresos (Mes)</div>
                    <div class="text-3xl font-bold text-green-500">
                        ${{ number_format($income, 2) }}
                    </div>
                </div>

                <!-- Expense -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm uppercase font-bold mb-2">Gastos (Mes)</div>
                    <div class="text-3xl font-bold text-red-500">
                        ${{ number_format($expense, 2) }}
                    </div>
                </div>

                <!-- Balance -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 dark:text-gray-400 text-sm uppercase font-bold mb-2">Balance (Mes)</div>
                    <div class="text-3xl font-bold {{ $balance >= 0 ? 'text-blue-500' : 'text-red-500' }}">
                        ${{ number_format($balance, 2) }}
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Movimientos Recientes</h3>
                        <a href="{{ route('transactions.index') }}" class="text-sm text-indigo-500 hover:text-indigo-400">Ver todos</a>
                    </div>
                    
                    @if($recentTransactions->isEmpty())
                        <p class="text-gray-500 text-center py-4">No hay movimientos recientes.</p>
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
                                    @foreach($recentTransactions as $transaction)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                {{ $transaction->date->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $transaction->description }}
                                                @if($transaction->event)
                                                    <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        {{ $transaction->event->client?->name ?? 'Cliente desconocido' }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full" 
                                                      style="background-color: {{ $transaction->category->color ?? '#CCCCCC' }}20; color: {{ $transaction->category->color ?? '#666666' }}">
                                                    {{ $transaction->category->name ?? 'Sin categoría' }}
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
