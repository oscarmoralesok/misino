<div class="space-y-8 animate-translate-up pb-12">
    {{-- Unified Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <h2 class="font-display font-bold text-3xl text-gray-800 dark:text-white leading-tight">
                Seguimiento de Presupuestos
            </h2>
            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1 font-medium">Contacta a los clientes que aún no han respondido (3 a 7 días).</p>
        </div>
    </div>

    <div class="premium-card overflow-hidden">
        <div class="p-0">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] border-b border-gray-100 dark:border-gray-800">
                            <th class="px-8 py-5">Cliente</th>
                            <th class="px-8 py-5">Estado</th>
                            <th class="px-8 py-5">Días sin Respuesta</th>
                            <th class="px-8 py-5">Último Seguimiento</th>
                            <th class="px-8 py-5 text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-800/50">
                        @forelse($events as $event)
                            @php
                                $daysAgo = now()->diffInDays($event->updated_at);
                                $clientName = $event->client->name ?? 'Cliente';
                                $phone = preg_replace('/[^0-9]/', '', $event->client->phone ?? '');
                                
                                // Ensure number has country code (Argentina logic)
                                if (strlen($phone) === 10) {
                                    $phone = '549' . $phone;
                                }
                                
                                $message = "Hola {$clientName}! 😊 ¿Cómo estás?\n\nQuería consultarte si pudiste ver el presupuesto y si te surgió alguna duda o hay algo que te gustaría ajustar. Si querés, también podemos evaluar otras opciones que se adapten mejor.\n\nRecordá que podés pagarlo con tarjeta a través de Mercado Pago, por si eso te resulta más cómodo.\n\nQuedo atenta a tu respuesta. ¡Que tengas un lindo día! ✨";
                                $waLink = "https://wa.me/{$phone}?text=" . urlencode($message);
                            @endphp
                            <tr class="group hover:bg-gray-50/50 dark:hover:bg-gray-800/20 transition-all">
                                <td class="px-8 py-6">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-xl bg-primary-100 dark:bg-primary-900/30 text-primary-600 flex items-center justify-center font-bold text-sm mr-4">
                                            {{ substr($clientName, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-800 dark:text-white">{{ $clientName }}</p>
                                            <p class="text-[11px] text-gray-400 font-medium">{{ $event->client->phone }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                        {{ $event->status === 'sent' ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-900/20' : 'bg-orange-50 text-orange-600 dark:bg-orange-900/20' }}">
                                        {{ $event->status === 'sent' ? 'Enviado' : 'Pendiente' }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm font-bold {{ $daysAgo >= 5 ? 'text-accent-500' : 'text-gray-700 dark:text-gray-300' }}">
                                            {{ $daysAgo }} días
                                        </span>
                                        @if($daysAgo >= 5)
                                            <span class="w-2 h-2 rounded-full bg-accent-500 animate-pulse"></span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    @if($event->last_follow_up_at)
                                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">
                                            {{ \Carbon\Carbon::parse($event->last_follow_up_at)->diffForHumans() }}
                                        </p>
                                    @else
                                        <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">Sin contacto</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <a href="{{ $waLink }}" 
                                       target="_blank"
                                       wire:click="recordFollowUp({{ $event->id }})"
                                       class="inline-flex items-center px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-[11px] font-bold rounded-xl transition-all shadow-lg shadow-emerald-500/20 group/wa">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 .004 5.411.002 12.048c0 2.12.54 4.19 1.563 6.04L0 24l6.082-1.594a11.819 11.819 0 005.96 1.604h.005c6.636 0 12.048-5.411 12.051-12.049a11.829 11.829 0 00-3.626-8.53z"/></svg>
                                        Enviar WhatsApp
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-20 text-center">
                                    <div class="max-w-xs mx-auto">
                                        <div class="w-16 h-16 bg-gray-50 dark:bg-gray-900 rounded-2xl flex items-center justify-center mx-auto mb-4 text-gray-300">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <p class="text-sm font-bold text-gray-800 dark:text-white">¡Todo al día!</p>
                                        <p class="text-xs text-gray-400 mt-1">No hay presupuestos pendientes de seguimiento en este rango.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($events->hasPages())
                <div class="px-8 py-6 border-t border-gray-100 dark:border-gray-800">
                    {{ $events->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
