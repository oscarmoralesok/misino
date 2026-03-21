<div>
    <x-slot name="header">
        <h2 class="font-display font-bold text-3xl text-gray-800 dark:text-white leading-tight">
            Configuración del Sistema
        </h2>
        <p class="text-gray-400 dark:text-gray-500 text-sm mt-1 font-medium">Gestiona los parámetros globales para cálculos y logística.</p>
    </x-slot>

    <div class="max-w-4xl">
        <div class="space-y-8">
            {{-- Success Message --}}
            @if (session()->has('success'))
                <div class="animate-fade-in p-4 bg-emerald-50 border border-emerald-100 dark:bg-emerald-900/20 dark:border-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-2xl text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="premium-card overflow-hidden">
                <div class="p-8 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="font-display font-bold text-lg text-gray-800 dark:text-white">Cálculo de Transporte</h3>
                    <p class="text-gray-400 text-xs mt-1">Estos valores se utilizan para calcular automáticamente el costo de transporte en el presupuesto de los eventos.</p>
                </div>

                <form wire:submit.prevent="save" class="p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] pl-1">Precio del Combustible (por litro)</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary-500 transition-colors">
                                    <span class="text-sm font-bold">$</span>
                                </div>
                                <input type="number" step="0.01" wire:model="fuel_price" 
                                    class="input-plain w-full !pl-8" placeholder="Ej: 1950.00">
                            </div>
                            @error('fuel_price') <span class="text-accent-500 text-[10px] font-bold uppercase mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] pl-1">Rendimiento (KM por litro)</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary-500 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <input type="number" step="0.1" wire:model="km_per_liter" 
                                    class="input-plain w-full !pl-10" placeholder="Ej: 14.0">
                            </div>
                            @error('km_per_liter') <span class="text-accent-500 text-[10px] font-bold uppercase mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-end">
                        <button type="submit" class="btn-primary shadow-soft flex items-center group">
                            <span>Guardar Cambios</span>
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Info Card --}}
            <div class="p-6 bg-primary-50/50 dark:bg-primary-900/10 rounded-3xl border border-primary-100 dark:border-primary-900/20 flex items-start space-x-4">
                <div class="p-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm">
                    <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-primary-900 dark:text-primary-100 uppercase tracking-wider">Fórmula de Cálculo</h4>
                    <p class="text-xs text-primary-700/70 dark:text-primary-400/70 mt-1 leading-relaxed">
                        El sistema calcula el costo de transporte usando: <code class="bg-white/50 dark:bg-black/20 px-1 rounded font-bold">(Distancia KM / KM por Litro) * Precio Combustible</code>. 
                        Este valor se sugiere automáticamente al añadir el concepto "Transporte" en el presupuesto del evento.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
